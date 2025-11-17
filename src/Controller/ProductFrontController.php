<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductFrontController extends AbstractController
{
    #[Route('/product/{id}', name: 'app_front_product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('home/product_show.html.twig', [
            'product' => $product,
        ]);
    }
}
