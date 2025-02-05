<?php

namespace App\Controller;

use App\Entity\Counsil;
use App\Form\CounsilType;
use App\Repository\CounsilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/counsil')]
final class CounsilController extends AbstractController
{
    #[Route(name: 'app_counsil_index', methods: ['GET'])]
    public function index(CounsilRepository $counsilRepository): Response
    {
        return $this->render('counsil/index.html.twig', [
            'counsils' => $counsilRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_counsil_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $counsil = new Counsil();
        $form = $this->createForm(CounsilType::class, $counsil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($counsil);
            $entityManager->flush();

            return $this->redirectToRoute('app_counsil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('counsil/new.html.twig', [
            'counsil' => $counsil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_counsil_show', methods: ['GET'])]
    public function show(Counsil $counsil): Response
    {
        return $this->render('counsil/show.html.twig', [
            'counsil' => $counsil,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_counsil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Counsil $counsil, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CounsilType::class, $counsil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_counsil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('counsil/edit.html.twig', [
            'counsil' => $counsil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_counsil_delete', methods: ['POST'])]
    public function delete(Request $request, Counsil $counsil, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$counsil->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($counsil);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_counsil_index', [], Response::HTTP_SEE_OTHER);
    }
}
