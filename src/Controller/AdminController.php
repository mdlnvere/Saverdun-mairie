<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(PostRepository $postRepository): Response
    {
      

        return $this->render('admin/dashboard.html.twig', [
            'controller_name' => 'AdminController',
            
        ]);
    }
}
