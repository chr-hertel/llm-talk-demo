<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HelloWorldController extends AbstractController
{
    #[Route('/hello', name: 'hello_world', methods: ['GET'])]
    public function index(): Response
    {
        return new Response('Hello World!');
    }
}