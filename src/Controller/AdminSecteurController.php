<?php 

namespace App\Controller;

use App\Entity\Secteur;
use App\Form\SecteurType;
use App\Repository\SecteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminSecteurController  extends AbstractController
{
    private $repos;
    private $manager;

    public function __construct(SecteurRepository $repos,EntityManagerInterface $entityManager)
    {   
        $this->repos = $repos;
        $this->manager = $entityManager;
        
    }

    /**
     * @Route("/admin_secteur",name="secteur")
     */
    public function index()
    {
        $secteur = new Secteur();
        $form = $this->createForm(SecteurType::class , $secteur);
        return $this->render('admin/secteur/index.html.twig',[
            'form' => $form->createView(),
            'secteurs' => $this->repos->findAll()
        ]);
    }
    /**
     * @Route("/admin_secteur_new",name="secteur_new")
     */
    public function new(Request $request)
    {
        $secteur = new Secteur();
        
        $form = $this->createForm(SecteurType::class , $secteur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->manager->persist($secteur);
            $this->manager->flush();
            $this->addFlash('success' , 'Creer  avec success');
            return $this->redirectToRoute('secteur_new');
        }
        return $this->render('admin/secteur/index.html.twig',[
                'form' => $form->createView(),
                'secteurs' => $this->repos->findAll()
            ]);
    }
    

}