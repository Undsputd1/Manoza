<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Fetch latest 6 products
        $featuredProducts = $entityManager->getRepository(Product::class)
            ->findBy([], ['id' => 'DESC'], 6);

        // Fetch all categories
        $categories = $entityManager->getRepository(Category::class)->findAll();

        return $this->render('home/index.html.twig', [
            'featuredProducts' => $featuredProducts,
            'categories' => $categories,
        ]);
    }
}
