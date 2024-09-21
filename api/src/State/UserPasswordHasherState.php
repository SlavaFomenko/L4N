<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserPasswordHasherState implements ProcessorInterface
{
    /**
     * @param ProcessorInterface $processor
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(
        protected ProcessorInterface $processor,
        protected UserPasswordHasherInterface $passwordHasher
    )
    {}

    /**
     * @param mixed $data
     * @param Operation $operation
     * @param array $uriVariables
     * @param array $context
     * @return User
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): User
    {
        if (!$data->getPassword()) {
            return $this->processor->process($data, $operation, $uriVariables, $context);
        }

        $hashedPassword = $this->passwordHasher->hashPassword(
            $data,
            $data->getPassword()
        );
        $data->setPassword($hashedPassword);

        return $this->processor->process($data, $operation, $uriVariables, $context);
    }
}