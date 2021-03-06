<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;
use Symfony\Component\Security\Core\User\User;

class ForbiddenForAdminsVoter extends Voter
{
    /**
     * @var RoleHierarchyInterface
     */
    private $roleHierarchy;

    public function __construct(RoleHierarchyInterface $roleHierarchy)
    {
        $this->roleHierarchy = $roleHierarchy;
    }

    protected function supports($attribute, $subject)
    {
        return $attribute === 'SECRET_CAKE';
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        // (!) not real check because of using symfony core user
        if (!($user instanceof User)) {
            // user is anon, but that's ok
            return true;
        }

        return !in_array(
            'DISALLOW_ADMINS',
            $this->roleHierarchy->getReachableRoleNames($user->getRoles()),
            true
        );
    }
}
