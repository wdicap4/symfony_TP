<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use phpDocumentor\Reflection\Types\Context;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @var UserRepository;
     */

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, MailerInterface $mailer, UserRepository $userRepository)
    {
        $this->$passwordEncoder = $passwordEncoder;
        $this->mailer = $mailer;
        
    }
    /**
     * @Route("/registration", name="register")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder): Response

    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        
        

        if($form->isSubmitted() && $form->isValid()) {

            $user->setPassword($encoder->encodePassword($user, $form->get("password")->getData()));
        
        $user->setToken($this->generateToken());
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $this->mailer->sendEmail($user->getEmail(), $user->getToken());
      
        }

        return $this->render('registration/index.html.twig',[
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/confirmer-mon-compte/{token}", name="confirm_account")
     * @param string $token
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function confirmAccount(string $token)
    {
        $user = $this->userRepository->findOneBy(["token" => $token]);

        if($user) {

        $user->setToken(null);
        $user->setEnabled(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $this->addFlash("succes", "compte actif");
        return $this->redirectToRoute("home");

        }else{

            $this->addFlash("error", "ce compte n'existe pas");
            return $this->redirectToRoute('home');

        }

      
    }


private function generateToken()

{
    return rtrim(strtr(base64_encode(random_bytes(32)), '+/','-_'), '=');
}
}