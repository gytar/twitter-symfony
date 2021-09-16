<?php

namespace App\Controller;

use App\Entity\Like;
use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LikeController extends AbstractController
{
    /**
     * @Route("/like", name="like",methods={"POST"}, options={"expose"=true})
     */
    public function index()
    {
        return $this->render('like/index.html');
    }

    /**
     * @Route("/addlike/{id}", name="add_like", methods={"GET", "POST"})
     */
    public function addLike(string $id, Request $request, PostRepository $postRepository): Response
    {
        if ($request->isXMLHttpRequest()) {
            $post = $postRepository->find(intval($id));
            // creates the like
            $like = new Like();
            $like->setPost($post);
            $like->setLikedBy($this->getUser());

            $this->getUser()->addLike($like);
            // Persists in database
            $em = $this->getDoctrine()->getManager();
            $em->persist($like);
            $em->flush();
            // all good, and redirects to home
            return new Response('');
        }
        return new Response('Didn\'t get it', Response::HTTP_BAD_REQUEST);
    }
}
