<?php

namespace App\Controller;

use Aws\S3\S3Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AwsController extends AbstractController
{
    #[Route('/aws', name: 'aws_index')]
    public function index(): Response
    {
        return $this->render('aws/index.html.twig', [
            'controller_name' => 'AwsController',
        ]);
    }

    #[Route('/aws/create', name: 'aws_create')]
    public function create(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $s3 = new S3Client([
                'version' => 'latest',
                'region' => 'us-east-1',
                'credentials' => [
                    'key' => $_ENV['AWS_KEY'],
                    'secret' => $_ENV['AWS_SECRET'],
                ],
                'endpoint' => 'http://localhost:9000',
                'use_path_style_endpoint' => true

            ]);
            $s3->putObject([
                'Bucket' => 'develop',
                'Key' => 'test',
                'Body' => 'Hello World!'
            ]);
        }

        return $this->render('aws/create.html.twig');

    }
}
