<?php

declare(strict_types=1);

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("DISALLOW_ADMINS")
 */
class UnavailableForAdmins
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
        return new Response('Should not be visible to admins either');
    }
}
