<?php

namespace App\Security\Voter;

use App\Entity\Customer;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CustomerVoter extends Voter
{
    protected function supports(string $attribute, $subject): bool
    {
        return in_array($attribute, ['USER_VIEW', 'USER_DELETE', 'USER_INDEX', 'USER_CREATE'])
            && $subject instanceof User || $subject instanceof Customer;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case 'USER_VIEW':
            case 'USER_DELETE':

                return $user === $subject->getCustomer();
            case 'USER_INDEX':
            case 'USER_CREATE':
                return $user === $subject;
        }

        return false;
    }
}
