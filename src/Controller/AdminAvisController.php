<?php


namespace App\Controller;


use App\Entity\Avis;
use App\Entity\Contact;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminAvisController extends AbstractController
{
    /**
     * @var AvisRepository
     */
    private $repos;

    private $manager;

    public function __construct(AvisRepository $repository,EntityManagerInterface $manager)
    {
        $this->repos = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/admin_avis",name="avis")
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public  function  index(Request $request)
    {

        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);
        $avi = $this->repos->findAll();
        if($form->isSubmitted() && $form->isValid())
        {
            $this->manager->persist($avis);
            $this->manager->flush();
            $this->addFlash('info','Ajouter avec success');
            return  $this->redirectToRoute('admin');
        }
        return  $this->render('admin/avis/new.html.twig',[
            'form' => $form->createView(),
            'avis' => $avi,
        ]);
    }
    /**
     * @Route("/admin_avis_delete_{id}",name="admin_avis_delete")
     * @return RedirectResponse
     */
    public function delete($id, Request $request)
    {
        $avis = $this->repos->findOneBy(['id' => $id ]);
        $this->manager->remove($avis);
        $this->manager->flush();
        return $this->redirectToRoute('admin');
    }
    /**
     * @Route("/admin_avis_{id}",name="admin_avis_update")
     * @param Request $request
     */
    public function update($id,Request $request)
    {
        $avis = $this->repos->findOneBy(['id' => $id ]);
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->manager->persist($avis);
            $this->manager->flush();
            $this->addFlash('info','Ajouter avec success');
            return  $this->redirectToRoute('admin');
        }
        return $this->render('admin/avis/new.html.twig',[
            'form'=> $form->CreateView(),
            'avis' => $this->repos->findAll(),
        ]);
    }
}