<?php

namespace App\Service\Wallet;

use App\Entity\Wallet;
use Doctrine\ORM\EntityManagerInterface;

final class WalletService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createWallet($user)
    {
        $wallet = new Wallet();
        $wallet->setAmount('0');
        $wallet->setOwner($user);
        $wallet->setCreatedAt(new \DateTime());
        $wallet->setUpdatedAt(new \DateTime());
        $wallet->setUpdatedAt(new \DateTime());
        $this->entityManager->persist($wallet);

        $this->entityManager->flush();

        return $wallet;
    }
}