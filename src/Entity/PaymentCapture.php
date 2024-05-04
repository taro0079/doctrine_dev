<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;

#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[DiscriminatorColumn(name: 'payment_capture_type', type: 'string')]
#[DiscriminatorMap(['yusei' => YuseiPaymentCapture::class, 'yamato' => YamatoPaymentCapture::class])]
class PaymentCapture
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 255)]
    private string $paymentCaptureId;

    #[ORM\OneToOne(mappedBy: 'paymentCapture')]
    private Payment $payment;

    #[ORM\OneToOne(mappedBy: 'paymentCapture')]
    private ?YamatoPaymentCapture $yamatoPaymentCapture;

    public function __construct(
        string $paymentCaptureId,
    ) {
        $this->paymentCaptureId = $paymentCaptureId;
    }

    public function setYamatoPaymentCapture(YamatoPaymentCapture $yamatoPaymentCapture): void
    {
        $this->yamatoPaymentCapture = $yamatoPaymentCapture;
    }

    public function getPaymentCaptureId(): string
    {
        return $this->paymentCaptureId;
    }

    public function setPaymentCaptureId(string $paymentCaptureId): void
    {
        $this->paymentCaptureId = $paymentCaptureId;
    }

    public function getPayment(): Payment
    {
        return $this->payment;
    }

    public function setPayment(Payment $payment): void
    {
        $this->payment = $payment;
    }
}
