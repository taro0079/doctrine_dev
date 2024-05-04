<?php

namespace App\Repository;

use App\Entity\Payment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payment::class);
    }

    public function savePayment(Payment $payment): void
    {

        $this->getEntityManager()->persist($payment);
        $this->getEntityManager()->flush();
    }

    public function getPayments(): array
    {
        return $this->findAll();
    }
}
