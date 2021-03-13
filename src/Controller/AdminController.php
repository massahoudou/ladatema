<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\AvisRepository;
use App\Repository\ContactRepository;
use App\Repository\OffreRepository;
use App\Repository\RecruteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminController  extends AbstractController
{

    /**
     * @Route("/admin" ,name="admin")
     */
    public function index(ContactRepository $contactRepository,AvisRepository $avisRepository,OffreRepository $offreRepository,RecruteurRepository  $recruteurRepository)
    {
        $contact = $contactRepository->findAll();
        $avis  =    $avisRepository->findAll();
        return $this->render('admin/index.html.twig',[
            'contact' => $contact,
            'avis' => $avis,
            'countoffre' => $offreRepository->counter(),
            'entreprise' => $recruteurRepository->counter(),
        ]);
    }

    /**@Route("/admin_contact_delete_{id}",name="contact_delete")
     * @param $id
     * @param Contact $contact
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function contact($id)
    {

      return   $this->redirectToRoute('admin');
    }

    /**
     * @Route("/admin_contact_delete_{id}" , name="ct_delete")
     * @return Response
     */
    public function delete($id,ContactRepository $contactRepository ,EntityManagerInterface $manager)
    {
        $contact = $contactRepository->findOneBy(['id'=>$id]);
        $manager->remove($contact);
        $manager->flush();
        return $this->render('admin/index.html.twig');
    }
}

