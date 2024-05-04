<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Payment
{

    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $paymentId;

    #[ORM\Column(type: Types::INTEGER)]
    private int $amount;

    #[ORM\OneToOne(inversedBy: 'payment', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'payment_capture_id', referencedColumnName: 'payment_capture_id')]
    private PaymentCapture $paymentCapture;

    public function __construct(
        string $paymentId,
    ) {
        $this->paymentId = $paymentId;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getPaymentId(): string
    {
        return $this->paymentId;
    }

    public function setPaymentCapture(PaymentCapture $paymentCapture): self
    {
        $this->paymentCapture = $paymentCapture;
        return $this;
    }
}
