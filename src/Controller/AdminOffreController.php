<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Form\OffreType;
use App\Repository\OffreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminOffreController  extends AbstractController
{
    private $manager;
    private $repos;


    public function __construct(EntityManagerInterface $manager,OffreRepository $offreRepository)
    {
        $this->manager = $manager;
        $this->repos = $offreRepository;

    }

    /**
     * @Route("/admin_offre" ,name="admin_offre")
     */
    public function index()
    {
        $offres = $this->repos->findAll();
        return $this->render('admin/offre/index.html.twig',[
            'offres' => $offres,
        ]);
    }
    /**
     * @Route("/admin_offre_new", name="admin_offre_new")
     */
    public function new(Request $request)
    {
        $offre = new Offre();
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $offre->setUpdateAt(new \DateTime('now'));
            $this->manager->persist($offre);
            $this->manager->flush(); 
            $this->addFlash('new' , 'Creer  avec success');
            return $this->redirectToRoute('admin_offre');
        }


        return $this->render('admin/offre/new.html.twig',[
            'controllerName' => 'Creer une Offre',
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin_offfre_update{id}",name="admin_offre_update")
     */
    public function update($id,Request $request)
    {
        $offre = $this->repos->findOneBy(['id'=> $id]);
        $form = $this->createForm(OffreType::class,$offre);
        $form->handleRequest($request);  

        if ($form->isSubmitted() && $form->isValid()) 
        { 
            $this->manager->persist($offre);
            $this->manager->flush();
            $this->addFlash('update' , 'modifier  avec success');

             return $this->redirectToRoute('admin_offre');
        }

        return $this->render('admin/offre/new.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin_offre_delete{id}",name="admin_offre_delete")
     * @param $id
     * @param Offre $offre
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete ($id,Request $request)
    {
        $offre = $this->repos->findOneBy(['id' => $id ]);
        $this->manager->remove($offre);
        $this->manager->flush();
        $this->addFlash('delete' , 'Supprimer   avec success');
        return  $this->redirectToRoute('admin_offre');
    }


}