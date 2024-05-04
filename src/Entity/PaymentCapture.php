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

    public function __construct(
        string $paymentCaptureId,
    ) {
        $this->paymentCaptureId = $paymentCaptureId;
    }
}
