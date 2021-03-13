<?php


namespace App\Controller;


use App\Entity\Apropos;
use App\Form\AproposFormType;
use App\Repository\AproposRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminAproposController extends AbstractController
{
    /**
     * @var AproposRepository
     */
    private $repos;
    /**
     * @var EntityManager
     */
    private $manager;

    public function __construct(EntityManagerInterface $entityManager, AproposRepository $repository)
    {
        $this->repos = $repository;
        $this->manager = $entityManager;
    }
    /**
     * @Route("/admin_propos", name="admin_propos")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request  $request)
    {
        $Apropos = new Apropos();
        $form = $this->createForm(AproposFormType::class , $Apropos);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $Apropos->setMisajour(new \DateTime('now') );
           $this->manager->persist($Apropos);
           $this->manager->flush();
           $this->addFlash('apropos' , 'enregistrer avec success');
          return  $this->redirectToRoute('admin_propos');
        }
        return $this->render('admin/apropos/index.html.twig',[
            'propos' => $this->repos->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin_propos_{id}",name="admin_propos_update")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public  function  update($id , Request $request,Apropos  $apropos)
    {
        $apropos = $this->repos->findOneBy(['id'=> $id ]);
        $form = $this->createForm(AproposFormType::class , $apropos);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $apropos->setMisajour(new \DateTime('now') );
            $this->manager->persist($apropos);
            $this->manager->flush();
            $this->addFlash('apropos' , 'enregistrer avec success');
            return  $this->redirectToRoute('admin_propos');
        }
        return $this->render('admin/apropos/index.html.twig',[
            'propos' => $this->repos->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin_apropos_delete_{id}",name="admin_propos_delete")
     */
    public function delete ($id)
    {
        $apropos = $this->repos->findOneBy(['id' => $id ]);
        $this->manager->remove($apropos);
        $this->manager->flush();
       return  $this->redirectToRoute('admin_propos');
    }
}