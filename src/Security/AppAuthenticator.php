<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class AppAuthenticator extends AbstractGuardAuthenticator
{
    public function supports(Request $request)
    {
        return $request->get('role');
    }

    public function getCredentials(Request $request)
    {
        return $request->get('role');
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return new User(
            'foobar',
        null,
            ['ROLE_USER', $credentials]
        );
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // todo
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        // todo
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new Response('Add get-param role to authenticate as fake user. e.g. ?role=ROLE_ADMIN');
    }

    public function supportsRememberMe()
    {
        // todo
    }
}
