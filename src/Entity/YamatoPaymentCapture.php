<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
class YamatoPaymentCapture extends PaymentCapture
{
    // private PaymentCapture $paymentCapture;
}
