<?php

namespace App\Controller;

use App\Entity\Payment;
use App\Entity\PaymentCapture;
use App\Entity\YuseiPaymentCapture;
use App\Form\PaymentCaptureFormType;
use App\Form\PaymentFormType;
use App\Form\PaymentRegisterForm;
use App\Form\YuseiPaymentCaptureFormType;
use App\Repository\PaymentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;

class PaymentController extends AbstractController
{
    public function __construct(
        private readonly PaymentRepository $paymentRepository
    ) {
    }


    #[Route('/payment/create', name: 'payment_create')]
    public function create(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $amount = $request->get('amount');
            $payment = new Payment(Uuid::v4());
            $yuseiPaymentCapture = new YuseiPaymentCapture(Uuid::v4());
            $yuseiPaymentCapture->setAmount($amount);
            $payment->setAmount($amount);
            $payment->setPaymentCapture($yuseiPaymentCapture);
            $this->paymentRepository->savePayment($payment);
        }




        return $this->render('payment/create.html.twig', []);
    }

    #[Route('/payment', name: 'payment_index')]
    public function index(): Response
    {
        $payments = $this->paymentRepository->findAll();
        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
            'payments' => $payments,
        ]);
    }
}
