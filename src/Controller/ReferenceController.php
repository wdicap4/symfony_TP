<?php

namespace App\Controller;

use App\Entity\Services;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

class ReferenceController extends AbstractController
{
    /**
     * @Route("/reference", name="reference")
     */
    public function reference(): Response
    {
        return $this->render('reference/reference.html.twig');
    }
}