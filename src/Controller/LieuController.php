<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Form\LieuSupprimerType;
use App\Form\LieuType;
use App\Repository\LieuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LieuController extends AbstractController
{
    #[Route('/lieux', name: 'app_lieu')]
    public function index(LieuRepository $lieuRepository): Response
    {
        // je vais chercher tous les lieux (select *)
        $lieux = $lieuRepository->findAll();

        return $this->render('lieu/index.html.twig', [
            "lieux" => $lieux,
        ]);
    }

    #[Route('/ajouter-lieu', name: 'app_ajouter_lieu')]
    public function ajouter(Request $request, EntityManagerInterface $em): Response
    {
        // 1 je crée un lieu vide
        $lieu = new Lieu();
        // je crée le formulaire
        $form = $this->createForm(LieuType::class, $lieu);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($lieu); // je veux faire un insert
            $em->flush();        // je déclenche l'insert

            return $this->redirectToRoute('app_lieu');
        }

        return $this->render('lieu/ajouter.html.twig', [
            "formulaire" => $form->createView(),
        ]);
    }

    #[Route('/modifier-lieu/{id}', name: 'app_modifier_lieu')]
    public function modifier(Request $request, LieuRepository $lieuRepository, EntityManagerInterface $em, $id): Response
    {
        // 1 je vais chercher le lieu à modifier
        $lieu = $lieuRepository->find($id);
        // je crée le formulaire
        $form = $this->createForm(LieuType::class, $lieu);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($lieu); // je veux faire un update
            $em->flush();        // je déclenche l'update

            return $this->redirectToRoute('app_lieu');
        }

        return $this->render('lieu/modifier.html.twig', [
            "formulaire" => $form->createView(),
        ]);
    }

    #[Route('/supprimer-lieu/{id}', name: 'app_supprimer_lieu')]
    public function supprimer(Request $request, LieuRepository $lieuRepository, EntityManagerInterface $em, $id): Response
    {
        // 1 je vais chercher le lieu à supprimer
        $lieu = $lieuRepository->find($id);
        // je crée le formulaire de confirmation
        $form = $this->createForm(LieuSupprimerType::class, $lieu);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->remove($lieu); // je veux faire un delete
            $em->flush();       // je déclenche le delete

            return $this->redirectToRoute('app_lieu');
        }

        return $this->render('lieu/supprimer.html.twig', [
            "lieu" => $lieu,
            "formulaire" => $form->createView(),
        ]);
    }
}
