<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Payment;
use App\Entity\YamatoPaymentCapture;
use App\Entity\YuseiPaymentCapture;
use App\Repository\PaymentRepository;
use Symfony\Component\Uid\Uuid;


class PaymentRegisterService
{
    public function __construct(
        private readonly PaymentRepository $paymentRepository

    ) {
    }
    public function execute(int $amount, string $paymentCaptureType): void
    {
        $payment = new Payment(Uuid::v4()->__toString());
        $payment->setAmount($amount);

        $paymentCapture = match ($paymentCaptureType) {
            YuseiPaymentCapture::class => new YuseiPaymentCapture(Uuid::v4()->__toString()),
            YamatoPaymentCapture::class => new YamatoPaymentCapture(Uuid::v4()->__toString()),
        };

        $paymentCapture->setAmount($amount);
        $payment->setPaymentCapture($paymentCapture);
        $this->paymentRepository->savePayment($payment);
    }
}
