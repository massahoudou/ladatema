<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\AdminRepository;
use App\Repository\ServiceRepository;
use App\Repository\UserRepository;
use Cassandra\Date;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminServiceController  extends AbstractController
{
    private $repos;
    private $manager;
    private $security;
    /**
     * @var UserRepository
     */
    private $userrepos;

    public function __construct(EntityManagerInterface $manager,ServiceRepository $serviceRepository,AdminRepository $userRepository )
    {
        $this->manager = $manager;
        $this->repos = $serviceRepository;
        $this->userrepos = $userRepository;
    }

    /**
     * @Route("/admin_service",name="service")
     */
    public function index( Request $request ,UserInterface $user)
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isvalid())
        {
            $admin = $this->userrepos->findOneBy(['email' => $user->getUsername()]);
            $service->setMisajour(new DateTime());
            $service->setAdmin($admin);
            $this->manager->persist($service);
            $this->manager->flush();
            $this->addFlash('new' , 'enregistrer avec success');
           return  $this->redirectToRoute('service');
        }
        $form =$this->createForm(ServiceType::class , $service);
        return $this->render('admin/service/index.html.twig',[
            'form'=> $form->createView(),
            'services' => $this->repos->findAll(),
        ]);
    }


    /**
     * @Route("admin_service_update_{id}",name="service_update")
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update($id , Request $request,Service  $service): \Symfony\Component\HttpFoundation\Response
    {

        $service= $this->repos->findOneBy(['id'=>$id ]);
        $form = $this->createForm(ServiceType::class , $service);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->manager->persist($service);
            $this->manager->flush();
            $this->addFlash('update' , 'modifier avec success');
            return $this->redirectToRoute('service');
        }
        return $this->render('admin/service/index.html.twig',[
            'form' => $form->createView(),
            'services' => $this->repos->findAll(),
        ]);
    }

    /**
     * @Route("/admin_service_delete_{id}",name="service_delete" )
     * @param $id
     * @param Service $service
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $service = $this->repos->findOneBy(['id' => $id]);
        $this->manager->remove($service);
        $this->manager->flush();
        $this->addFlash('delete' , 'supprimer avec success');
        return $this->redirectToRoute('service');
    }


}