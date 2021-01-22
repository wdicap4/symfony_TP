<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
   /* public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->$passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/registration", name="register")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(

                $this->passwordEncoder->encodePassword($user, $form->get("password")->getData())
            );
            
           dd($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $this->addFlash("success" ,"Inscription reussie");

        }


        return $this->render('registration/index.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
