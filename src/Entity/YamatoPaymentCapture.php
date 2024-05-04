<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
class YamatoPaymentCapture extends PaymentCapture
{
    #[ORM\Column(type: Types::INTEGER)]
    private int $amount;
}
