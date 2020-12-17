<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
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

    /**
     * @Route("/pseudo/secret")
     */
    public function forAllButAdmins(): Response
    {
        if (!$this->isGranted('SECRET_CAKE')) {
            throw new AccessDeniedHttpException('No admins allowed here by isGranted method');
        }

        return new Response(__METHOD__);
    }
}
