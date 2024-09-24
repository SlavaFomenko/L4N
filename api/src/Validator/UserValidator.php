<?php

namespace App\Validator;

use App\Entity\User;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


class UserValidator
{
    public static function validate(User $user, ExecutionContextInterface $context): void
    {
        if (is_null($user->getEmail()) && is_null($user->getPassword())) {
            return;
        }
        if (!is_null($user->getEmail()) && is_null($user->getPassword())) {
            $context->buildViolation('Password must be provided if email is set.')
                ->atPath('password')
                ->addViolation();
        }
        if (is_null($user->getEmail()) && !is_null($user->getPassword())) {
            $context->buildViolation('Email must be provided if password is set.')
                ->atPath('email')
                ->addViolation();
        }
        if (!is_null($user->getEmail()) && !is_null($user->getPassword())) {
            $validator = $context->getValidator();
            $validator->validateProperty($user, 'email', ['validate_email']);
            $validator->validateProperty($user, 'password', ['validate_password']);
        }
    }
}
