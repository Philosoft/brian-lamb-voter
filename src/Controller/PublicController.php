<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicController
{
    /**
     * @Route("/")
     */
    public function homepage(): Response
    {
        return new Response('Available for all');
    }

    /**
     * @Route("/public/test")
     */
    public function publicTest(): Response
    {
        return new Response('Only common folks are here');
    }
}
