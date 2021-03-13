<?php

namespace App\Controller;


use App\Entity\Partenaire;
use App\Form\PartenaireType;
use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPartenaireController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var PartenaireRepository
     */
    private $repos;

    public function __Contrust(EntityManagerInterface $manager, PartenaireRepository  $repository){
        $this->manager = $manager;
        $this->repos = $repository;
    }

    /**
     * @Route("/admin_partenaire" , name="admin_partenaire")
     * @param Request $request
     * @param PartenaireRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index (Request $request,PartenaireRepository  $repository)
    {
        $partenaire = new Partenaire();
        $form = $this->createForm(PartenaireType::class,$partenaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->manager->persist($partenaire);
            $this->manager->flush();
            $this->addFlash('info','Creer avec success');
            $this->redirectToRoute('admin_partenaire');
        }
        return $this->render('admin/partenaire/index.html.twig',[
            'form' => $form->createView(),
            'partenaire' =>   $repository->findAll(),
        ]);
    }

    /**
     * @Route("/admin_partenaire_update{id}",name="admin_partenaire_update")
     * @param $id
     * @param Request $request
     * @param PartenaireRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update($id,Request $request,PartenaireRepository  $repository)
    {
        $partenaire = $repository->findOneBy(['id' => $id] );
        $form = $this->createForm(PartenaireType::class,$partenaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->manager->persist($partenaire);
            $this->manager->flush();
            $this->addFlash('update','modifier avec success');
            $this->redirectToRoute('admin_partenaire');
        }
        return $this->render('admin/partenaire/index.html.twig',[
            'form' => $form->createView(),
            'partenaire' =>   $repository->findAll(),
        ]);
    }

    /**
     * @Route("/admin_partenaire_delete{id}" , name="admin_partenaire_delete")
     * @param PartenaireRepository $repository
     */
    public function delete($id , PartenaireRepository  $repository)
    {
        $partenaire = $repository->findOneBy(['id' => $id] );
        $this->manager->remove($partenaire);
        $this->manager->flush();
        $this->addFlash('delete','supprimer avec success');
       return  $this->redirectToRoute('admin_partenaire');
    }
}