<?php

namespace App\Controller;

use App\Entity\Artiste;
use App\Form\ArtisteSupprimerType;
use App\Form\ArtisteType;
use App\Repository\ArtisteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArtisteController extends AbstractController
{
    #[Route('/', name: 'app_artiste')]
    public function index(ArtisteRepository $artisteRepository): Response
    {
        // je vais chercher tous les artistes (select *)
        $artistes = $artisteRepository->findAll();

        return $this->render('artiste/index.html.twig', [
            "artistes" => $artistes,
        ]);
    }

    #[Route('/ajouter-artiste', name: 'app_ajouter_artiste')]
    public function ajouter(Request $request, EntityManagerInterface $em): Response
    {
        // 1 je crée un artiste vide
        $artiste = new Artiste();
        // je crée le formulaire
        $form = $this->createForm(ArtisteType::class, $artiste);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($artiste); // je veux faire un insert
            $em->flush();           // je déclenche l'insert

            return $this->redirectToRoute('app_artiste');
        }

        return $this->render('artiste/ajouter.html.twig', [
            "formulaire" => $form->createView(),
        ]);
    }

    #[Route('/modifier-artiste/{id}', name: 'app_modifier_artiste')]
    public function modifier(Request $request, ArtisteRepository $artisteRepository, EntityManagerInterface $em, $id): Response
    {
        // 1 je vais chercher l'artiste à modifier
        $artiste = $artisteRepository->find($id);
        // je crée le formulaire
        $form = $this->createForm(ArtisteType::class, $artiste);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($artiste); // je veux faire un update
            $em->flush();           // je déclenche l'update

            return $this->redirectToRoute('app_artiste');
        }

        return $this->render('artiste/modifier.html.twig', [
            "formulaire" => $form->createView(),
        ]);
    }

    #[Route('/supprimer-artiste/{id}', name: 'app_supprimer_artiste')]
    public function supprimer(Request $request, ArtisteRepository $artisteRepository, EntityManagerInterface $em, $id): Response
    {
        // 1 je vais chercher l'artiste à supprimer
        $artiste = $artisteRepository->find($id);
        // je crée le formulaire de confirmation
        $form = $this->createForm(ArtisteSupprimerType::class, $artiste);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->remove($artiste); // je veux faire un delete
            $em->flush();          // je déclenche le delete

            return $this->redirectToRoute('app_artiste');
        }

        return $this->render('artiste/supprimer.html.twig', [
            "artiste" => $artiste,
            "formulaire" => $form->createView(),
        ]);
    }
}
