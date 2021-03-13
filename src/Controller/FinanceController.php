<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\AproposRepository;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FinanceController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface  $manager)
    {
        $this->em = $manager;
    }

    /**
     * @return Response
     * @Route("/finance" , name="finance_home")
     */
    public  function index(AproposRepository  $aproposRepository)
    {

        return $this->render('finance/index.html.twig', [
            'controller_name' => 'Finance',
            'apropos' => $aproposRepository->cocherfinnace(),
        ]);
    }

    /**
     * @Route("/a_propos",name="finance_propos")
     */
    public function Apropos(AproposRepository $repository)
    {
        return $this->render('finance/Apropos.html.twig',[
            'controller_name' => 'A propos',
            'apropos' => $repository->findAll(),
            ]);
    }
    /**
     * @Route("/service",name="finance_service")
     */
    public function service(ServiceRepository  $serviceRepository)
    {
        $service = $serviceRepository->findByDesc();
        return $this->render('finance/services.html.twig',[
            'controller_name' => 'Nos Service',
            'services' => $service,
        ]);
    }

    /**
     * @Route("/contact",name="finance_contact")
     * @param Contact $contact
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function contact(Request $request )
    {

        $contact = new contact ();
        $form = $this->createForm(ContactType::class , $contact);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $contact->setDateAt(new \DateTime());
            $this->em->persist($contact);
            $this->em->flush();
            $this->addFlash(
                'info',
                'Votre Message a été envoyé avec succes'
            );
            return $this->redirectToRoute('finance_contact');
        }
        return $this->render('finance/contact.html.twig',[
            'controller_name' => 'Nos Service',
            'form'=> $form->Createview(),
        ]);
    }


}