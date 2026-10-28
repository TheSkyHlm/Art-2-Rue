<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class MenuController extends AbstractController
{
    // Ce contrôleur affiche le menu du site (appelé depuis base.html.twig).
    public function _menu(): Response
    {
        return $this->render('menu/_menu.html.twig');
    }
}
