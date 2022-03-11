<?php

namespace App\Controller;

use App\Entity\Artisty;
use App\Form\ArtistyType;
use App\Repository\ArtistyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/artisty')]
class ArtistyController extends AbstractController
{
    #[Route('/', name: 'app_artisty_index', methods: ['GET'])]
    public function index(ArtistyRepository $artistyRepository): Response
    {
        return $this->render('artisty/index.html.twig', [
            'artisties' => $artistyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_artisty_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ArtistyRepository $artistyRepository): Response
    {
        $artisty = new Artisty();
        $form = $this->createForm(ArtistyType::class, $artisty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artistyRepository->add($artisty);
            return $this->redirectToRoute('app_artisty_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artisty/new.html.twig', [
            'artisty' => $artisty,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_artisty_show', methods: ['GET'])]
    public function show(Artisty $artisty): Response
    {
        return $this->render('artisty/show.html.twig', [
            'artisty' => $artisty,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_artisty_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Artisty $artisty, ArtistyRepository $artistyRepository): Response
    {
        $form = $this->createForm(ArtistyType::class, $artisty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artistyRepository->add($artisty);
            return $this->redirectToRoute('app_artisty_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artisty/edit.html.twig', [
            'artisty' => $artisty,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_artisty_delete', methods: ['POST'])]
    public function delete(Request $request, Artisty $artisty, ArtistyRepository $artistyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artisty->getId(), $request->request->get('_token'))) {
            $artistyRepository->remove($artisty);
        }

        return $this->redirectToRoute('app_artisty_index', [], Response::HTTP_SEE_OTHER);
    }
}
