<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;
use Symfony\Component\Security\Core\Security;
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
        return $attribute === 'ROLE_DISALLOW_ADMINS';
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        // (!) not real check
        if (!($user instanceof User)) {
            return false;
        }

        return !in_array(
            $attribute,
            $this->roleHierarchy->getReachableRoleNames($user->getRoles()),
            true
        );
    }
}
