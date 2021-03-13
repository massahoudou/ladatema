<?php

namespace App\Controller\candidat;

use App\Entity\Competence;
use App\Entity\Formation;
use App\Form\CompetenceType;
use App\Form\FormationType;
use App\Repository\CandidatRepository;
use App\Repository\CompetenceRepository;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @Route("/profile")
 */
class CandidatController  extends AbstractController 
{
    private $repos ;
    private $manager;
    private $repository;
    /**
     * @var CompetenceRepository
     */
    private $Crepository;

    public function __construct(CandidatRepository $candidatRepository,EntityManagerInterface $manager,FormationRepository $repository,CompetenceRepository $competenceRepository)
    {

        $this->repos = $candidatRepository;
        $this->manager = $manager;
        $this->repository = $repository;
        $this->Crepository = $competenceRepository;
        
    }

    /**
     * @Route("/candidat",name="candidat")
     * @param UserInterface $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(UserInterface $user)
    {
        $candidat = $this->repos->findOneBy(['email'=> $user->getUsername()]);
         $formation = $this->repository->findForCandidat($candidat);
         $competence = $this->Crepository->findForCandidat($candidat);
         return $this->render('user/candidat/index.html.twig',[
            'controllerName' => 'HI',
             'formations' => $formation,
             'competences'=> $competence
        ]);
    }

    /**
     * @Route("/new_formation",name="new_formation")
     */
    public function formation(Request $request,UserInterface $user)
    {

        $formation = new Formation();
        $form = $this->createForm(FormationType::class,$formation);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $candidat = $this->repos->findOneBy(['email'=>$user->getUsername()]);
            $formation->setCandidat($candidat);
            $this->manager->persist($formation);
            $this->manager->flush();
            $this->addFlash('info','Ajouter avec succes');
            return $this->redirectToRoute('candidat');
        }
        return $this->render('user/candidat/newf.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/formation_delete{id}" , name="formation_delete")
      */
    public function formationdelete($id,Request $request)
    {
        $formation = $this->repository->findOneBy(['id' => $id ]);
        $this->manager->remove($formation);
        $this->manager->flush();
        $this->addFlash('info','Suprimer avec success');
      return   $this->redirectToRoute('candidat');
    }

    /**
     * @Route("formation_update_{id}",name="formation_update")
     */
    public function formationUpdate($id ,Request $request,UserInterface $user)
    {
        $formation = $this->repository->findOneBy(['id' => $id]);
        $form = $this->createForm(FormationType::class,$formation);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $candidat = $this->repos->findOneBy(['email'=>$user->getUsername()]);
            $formation->setCandidat($candidat);
            $this->manager->persist($formation);
            $this->manager->flush();
            $this->addFlash('info','Ajouter avec succes');
            return $this->redirectToRoute('candidat');
        }
        return $this->render('user/candidat/newf.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new_competence",name="new_competence")
     * @param Request $request
     * @param UserInterface $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function competence(Request $request,UserInterface $user)
    {
        $candidat = $this->repos->findOneBy(['email'=> $user->getUsername()]);
        $competence = new Competence();
        $form = $this->createForm(CompetenceType::class,$competence);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isSubmitted())
        {
            $competence->setCandidat($candidat);
            $this->manager->persist($competence);
            $this->manager->flush();
            $this->addFlash('info' ,'creer avec success');
         return    $this->redirectToRoute('candidat');
        }
        return $this->render('user/candidat/newc.html.twig',[
            'form' => $form->createView(),
        ]);
    }
    
}
