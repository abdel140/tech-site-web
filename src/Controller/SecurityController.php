<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request,UserPasswordEncoderInterface $encoder){
        $user = new User();
        $form = $this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);
        $manager = $this->getDoctrine()->getManager();
        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security_login');
        }
        return $this->render('security/registration.html.twig',
            ["form_registration"=>$form->createView()]);
    }

    /**
     * @Route("/connexion",name="security_login")
     */
    public function login(AuthenticationUtils $authUtils){
        $error = $authUtils->getLastAuthenticationError();
        return $this->render("security/login.html.twig",["error"=>$error]);
    }
    /**
     * @Route("/deconnexion",name="security_logout")
     */
    public function logout(){
        return $this->render("security/logout.html.twig");
    }
}
