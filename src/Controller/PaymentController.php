<?php

namespace App\Controller;

use App\Entity\YamatoPaymentCapture;
use App\Entity\YuseiPaymentCapture;
use App\Repository\PaymentRepository;
use App\Service\PaymentRegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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
            $service = new PaymentRegisterService($this->paymentRepository);
            $service->execute(
                (int)$request->request->get('amount'),
                $request->request->get('capture_type')
            );
        }

        $captureType = [
            YuseiPaymentCapture::class,
            YamatoPaymentCapture::class
        ];




        return $this->render('payment/create.html.twig', ['capture_types' => $captureType]);
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
