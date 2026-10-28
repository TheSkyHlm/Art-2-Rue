<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'app_connexion')]
    public function connexion(AuthenticationUtils $authenticationUtils): Response
    {
        // S'il y a eu une erreur de connexion, on la récupère pour l'afficher.
        $erreur = $authenticationUtils->getLastAuthenticationError();
        // Dernier email saisi, pour le réafficher dans le formulaire.
        $dernierEmail = $authenticationUtils->getLastUsername();

        return $this->render('security/connexion.html.twig', [
            "dernier_email" => $dernierEmail,
            "erreur" => $erreur,
        ]);
    }

    #[Route('/deconnexion', name: 'app_deconnexion')]
    public function deconnexion(): void
    {
        // Rien à écrire ici : c'est le firewall de Symfony qui gère la déconnexion.
    }
}
