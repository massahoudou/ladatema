<?php 

namespace App\Controller\recruteur;

use App\Entity\Offre;
use App\Entity\Recruteur;
use App\Form\OffreType;
use App\Form\RecruteurFinalType;
use App\Form\RecruteurFormType;
use App\Repository\OffreRepository;
use App\Repository\RecruteurRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/profile")
 */
class RecruteurController extends AbstractController 
{
    private $repos;
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(RecruteurRepository $recruteurRepository,EntityManagerInterface  $manager)
    {
        $this->repos = $recruteurRepository;
        $this->manager = $manager;
    }

    /**
     * @Route("/recruteur",name="recruteur")
     */
    public function index(UserInterface  $user,OffreRepository $repository)
    {

        $offres = $repository->findOffreRecruteur($user);
         return $this->render('user/recruteur/index.html.twig',[
            'controllerName' => 'Profile',
             'offres'=> $offres,
        ]);
    }

    /**
     * @Route("/recruteur_offre",name="recru_offre")
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function offre( Request $request,UserInterface $user)
    {
        $offre = new Offre();
         $recruteur = $this->repos->findoneBY(['email'=> $user->getUsername()]);
    
        $form = $this->createForm(OffreType::class,$offre);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) 
        { 
            $offre->setRecruteur($recruteur);
            $offre->setUpdateAt(new \DateTime('now'));
            $this->manager->persist($offre);
            $this->manager->flush();
            $this->addFlash('recruteur_offre','Bien enregistrer');
           return  $this->redirectToRoute('recruteur');
        }
        return $this->render('user/recruteur/offre.html.twig',[
            'controllerName' => 'Profile',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/recruteur_edition{id}",name="edtion")
     * @param $id
     * @param Offre $offre
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edition($id,Request $request,OffreRepository $repository)
    {
        $offre = new Offre();
        $offre = $repository->findOneBy(['id'=> $id ]);
        $form = $this->createForm(OffreType::class,$offre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $offre->setUpdateAt(new \DateTime('now'));
            $this->manager->persist($offre);
            $this->manager->flush();
            $this->addFlash('edition', 'Modifier avec success');
           return $this->redirectToRoute('recruteur');
        }
        return $this->render('user/recruteur/edit.html.twig',[
            'form'=> $form->createView(),
        ]);
    }

    /**
     * @Route("/recruteur_delete{id}",name="recruteur_delete")
     */
    public function delete($id,OffreRepository $repository)
    {
        $offre = $repository->findOneBy(['id'=> $id]);
        $this->manager->remove($offre);
        $this->manager->flush();
        $this->addFlash('delete' ,'Offre suppirmer avec sucess');
       return  $this->redirectToRoute('recruteur');
    }

    /**
     * @Route("/infoModi",name="modification")
     * @param UserInterface $user
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function RecruteurModfi(UserInterface $user,Request $request)
    {
        $recruteur = $this->repos->findOneBy(['email' => $user->getUsername()]);
        $form = $this->createForm(RecruteurFinalType::class,$recruteur);
        $form->handleRequest($request );

        if ($form->isSubmitted())
        {
            $this->manager->persist($recruteur);
            $this->manager->flush();
            $this->addFlash('profile','Modifier avec success');
           return  $this->redirectToRoute('recruteur');
        }
        return $this->render('user/recruteur/infomodif.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}
