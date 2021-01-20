<?php

namespace App\Controller;

use App\Entity\Services;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $services = new Services();
        $services->setTitle('un titre');
        $services->setDescription('une description');
        $services->setImage('image');
        $services->setPublished(1);
        
        return $this->render('home/index.html.twig',[
            "services" => $services
        ]);
    }

    /**
     * affichage de la page du formulaire connexion
     * @Route("/connexion", name="connexion")
     */
    public function connexion(){

    }
}
