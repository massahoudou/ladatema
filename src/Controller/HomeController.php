<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Repository\AdminRepository;
use App\Repository\AproposRepository;
use App\Repository\AvisRepository;
use App\Repository\OffreRepository;
use App\Repository\RecruteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(OffreRepository $repository,AvisRepository $avisRepository,AproposRepository $aproposRepository,RecruteurRepository  $recruteurRepository, AdminRepository $adminRepository,EntityManagerInterface $entityManagerInterface): Response
    {
        // $mail ='admin@gmail.com';
        // $admin = $adminRepository->findOneBy(['email'=> $mail ]);

        // if (!$admin)
        // {
        //     $adminentiti = new Admin();
        //     $adminentiti->setEmail($mail)->setPassword(123456)->setRoles(["ROLE_ADMIN"]);
        //     $entityManagerInterface->persist($adminentiti);
        //     $entityManagerInterface->flush();   
            
            
        // }
        // $entityManagerInterface->remove($admin);
        // $entityManagerInterface->flush();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'LADATEMAREASERCH',
            'offres' =>  $repository->findLatest(),
            'avis' => $avisRepository->avisthree(),
            'aproposfinance' => $aproposRepository->cocherfinnace(),
            'aproposrh' => $aproposRepository->cocherRh(),
            'countoffre' => $repository->counter(),
            'countentreprise' => $recruteurRepository->counter()
        ]);
    }
}
