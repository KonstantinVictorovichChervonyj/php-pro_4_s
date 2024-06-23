<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FaviconExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_favicon', [$this, 'getFaviconFromUrl'])
        ];
    }

    public function getFaviconFromUrl(string $url): string
    {
        $urlParts = parse_url($url);
        return $urlParts['scheme'] . '://' . $urlParts['host'] . '/favicon.ico';
    }
}