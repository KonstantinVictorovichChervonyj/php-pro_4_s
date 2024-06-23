<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MenuExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('main_menu', [$this, 'getMenu'])
        ];
    }

    public function getMenu(): array
    {
        return [
            [
                'label' => 'Головна',
                'path' => '/'
            ],
            [
                'label' => 'Користувачі',
                'path' => '/users'
            ],
            [
            'label' => 'Скорочення',
            'path' => '/s/statistics'
            ]
        ];
    }
}