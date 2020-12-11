<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_DISALLOW_ADMINS")
 */
class UnavailableForAdmins extends AbstractController
{
    /**
     * @Route("/test")
     */
    public function testVoter(): Response
    {
        return new Response('Should not be visible to admins');
    }

    /**
     * @Route("/test-action")
     */
    public function testInAction(): Response
    {
//        if ($this->isGranted("ROLE_ADMIN")) {
//            throw new AccessDeniedHttpException('Admins are not welcomed here');
//        }

        return new Response('Should not be visible to admins either');
    }
}
