<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Candidat;
use App\Entity\Recruteur;
use App\Form\CandidatFormType;
use App\Form\RecruteurFormType;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController2 extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/register", name="app_register")
     */
    public function Adminregister(Request $request): Response
    {
        $user = new Admin();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('rh_offre');
        }

        return $this->render('registration2/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    /**
     * @Route("/inscription",name="inscription")
     */
    public function inscription()
    {
        return $this->render('registration2/inscription.html.twig',[
            'ControllerName' => 'inscription',
        ]);
    }
    /**
     * @Route("/register_candidat", name="app_register_candidat")
     */
    public function candidatRegister(Request $request)
    {
        $candidat = new Candidat();
        $form = $this->createForm(CandidatFormType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $candidat->setPassword(
                $this->passwordEncoder->encodePassword(
                    $candidat,
                    $form->get('plainPassword')->getData()
                )
            );
            $candidat->setRoles(['ROLE_USER','ROLE_CAN']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($candidat);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('login');
        }

        return $this->render('registration2/candidat.html.twig', [
            'form' => $form->createView(),
        ]);

    }
    /**
     * @Route("/register_recruteur", name="app_register_recruteur")
     */
    public function recruteurRegister(Request $request)
    {
        $recruteur= new Recruteur();
        $form = $this->createForm(RecruteurFormType::class, $recruteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $recruteur->setPassword(
                $this->passwordEncoder->encodePassword(
                    $recruteur,
                    $form->get('plainPassword')->getData()
                )
            );
            $recruteur->setRoles(['ROLE_USER','ROLE_REC']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recruteur);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('login');
        }

        return $this->render('registration2/recruteur.html.twig', [
            'form' => $form->createView(),
        ]);

    }


}
