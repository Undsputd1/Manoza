<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Counts for the dashboard cards
        $productsCount = $entityManager->getRepository(Product::class)->count([]);
        $usersCount = $entityManager->getRepository(User::class)->count([]);
        $ordersCount = $entityManager->getRepository(Order::class)->count([]);
        $reviewsCount = 0; // If you have a Review entity, replace 0 with actual count

        // Fetch recent 5 orders
        $recentOrders = $entityManager->getRepository(Order::class)
            ->findBy([], ['createdAt' => 'DESC'], 5);

        return $this->render('admin/index.html.twig', [
            'productsCount' => $productsCount,
            'usersCount' => $usersCount,
            'ordersCount' => $ordersCount,
            'reviewsCount' => $reviewsCount,
            'recentOrders' => $recentOrders,
        ]);
    }
}
