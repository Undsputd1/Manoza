<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shop')]
class ShopController extends AbstractController
{
    // 🛍️ /shop  -> List all products
    #[Route('/', name: 'app_shop_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        // Fetch all products from the database
        $products = $productRepository->findAll();

        return $this->render('shop/index.html.twig', [
            'products' => $products, // pass products to Twig
        ]);
    }

    // 🔍 /shop/product/{id} -> Product detail page
    #[Route('/product/{id}', name: 'app_front_product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('shop/show.html.twig', [
            'product' => $product, // pass single product to Twig
        ]);
    }
}
