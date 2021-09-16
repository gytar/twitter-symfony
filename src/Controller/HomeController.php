<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(Request $request, PostRepository $postRepo): Response
    {
        $post = new Post();
        $postForm = $this->createForm(PostType::class, $post);
        $postForm->handleRequest($request);

        if ($postForm->isSubmitted() && $postForm->isValid()) {
            $post->setAuthor($this->getUser());
            $post->setCreatedAt(new \DateTime());
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($post);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig', [
            'post' => $post,
            'postform' => $postForm->createView(),
            'posts' => $postRepo->getAllOrderByDate(),
            'user' => $this->getUser(),
            'controller_name' => 'HomeController',
        ]);
    }
}
