<?php 

namespace App\Controller;

use App\Entity\Catcontrat;
use App\Form\CatcontartType;
use App\Repository\CatcontratRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminTypeController  extends AbstractController
{
    private $repos;
    private $manager;

    public function __construct(CatcontratRepository $repos,EntityManagerInterface $entityManager)
    {   
        $this->repos = $repos;
        $this->manager = $entityManager;
        
    }

    /**
     * @Route("/admin_cat",name="categoris_contrat")
     */
    public function index()
    {
        $catcontrat = new Catcontrat();
        $form = $this->createForm(CatcontartType::class , $catcontrat);
        return $this->render('admin/catcontrat/index.html.twig',[
            'form' => $form->createView(),
            'cats' => $this->repos->findAll()
        ]);
    }
    /**
     * @Route("/admin_cat_new",name="categoris_contrat_new")
     */
    public function new(Request $request)
    {
        $catcontrat = new Catcontrat();
        
        $form = $this->createForm(CatcontartType::class , $catcontrat);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->manager->persist($catcontrat);
            $this->manager->flush();
            $this->addFlash('success' , 'Creer  avec success');
            return $this->redirectToRoute('categoris_contrat_new');
        }
        return $this->render('admin/catcontrat/index.html.twig',[
                'form' => $form->createView(),
                'cats' => $this->repos->findAll()
            ]);
    }
    /**
     * @Route("/admin_cat_update{id}", name="categoris_contrat_update")
     */
    public function update($id , Request $request,Catcontrat $catcontrat)
    {        
        $form = $this->createForm(CatcontartType::class , $catcontrat);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->manager->persist($catcontrat);
            $this->manager->flush();
            $this->addFlash('success' , 'Creer  avec success');
            return $this->redirectToRoute('categoris_contrat_new');
        }
        return $this->render('admin/catcontrat/index.html.twig',[
                'form' => $form->createView(),
                'cats' => $this->repos->findAll()
            ]);
    }
    /**
     * @Route("admin_cat_delete_{id}", name="categoris_contrat_delete")
     */
    public function delete(Request $request ,Catcontrat $catcontrat)
    {
        
            $this->manager->remove($catcontrat);
            $this->manager->flush();
       
        return $this->redirectToRoute('categoris_contrat_new');
    }
    

}