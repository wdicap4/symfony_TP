<?php

namespace App\Controller;

use App\Entity\Services;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

class ActualiteController extends AbstractController
{
    /**
     * @Route("/actualite", name="actualite")
     */
    public function actualite(): Response
    {
        return $this->render('actualite/actualite.html.twig');
    }
}