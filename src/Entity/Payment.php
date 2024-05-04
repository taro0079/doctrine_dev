<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Payment
{

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 255)]
    private string $paymentId;

    public function __construct(
        string $paymentId,
    ) {
        $this->paymentId = $paymentId;
    }
}
