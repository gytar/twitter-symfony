<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function dateToLetter(\DateTime $date)
    {
        $now = new \DateTime();
        $interval = $date->diff($now);

        if (
            $this->dateIntervalYearMonthAndDay($interval) &&
            $interval->h === 0 &&
            $interval->i === 0
        ) {
            return $interval->s . 's ago';
        } elseif (
            $this->dateIntervalYearMonthAndDay($interval) &&
            $interval->h === 0
        ) {
            return $interval->i . 'min ago';
        } elseif ($this->dateIntervalYearMonthAndDay($interval)) {
            // dd($date->format('h\h'));
            return $interval->h . 'h ago';
        } else {
            return $date->format('d/M/y');
        }
    }

    private function dateIntervalYearMonthAndDay(\DateInterval $interval): bool
    {
        return $interval->y === 0 && $interval->m === 0 && $interval->d === 0;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('dateToLetter', [$this, 'dateToLetter']),
        ];
    }

    public function getFunctions(): array
    {
        return [new TwigFunction('function_name', [$this, 'doSomething'])];
    }

    public function doSomething($value)
    {
        // ...
    }
}
