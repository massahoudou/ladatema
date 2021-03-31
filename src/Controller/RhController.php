<?php


namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Offre;
use App\Form\SearchType;
use App\Form\SearchType2;
use App\Repository\OffreRepository;
use App\Repository\RecruteurRepository;
use App\Repository\SecteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RhController
 * @package App\Controller
 */
class RhController extends AbstractController
{
    private $repos ;
    public function __construct( OffreRepository $offreRepository)
    {
        $this->repos = $offreRepository;

    }

    /**
     * @Route("/rh" , name="rh_home")
     * @param SecteurRepository $secteurRepository
     * @param RecruteurRepository $recruteurRepository
     * @param Request $request
     * @return Response
     */
    public function index(SecteurRepository  $secteurRepository,RecruteurRepository $recruteurRepository,Request $request)
    {
        $data = new SearchData();
        $form2 = $this->createForm(SearchType2::class,$data);
        $form2->handleRequest($request);
        if ($form2->isSubmitted() && $form2->isValid())
        {
            $data->page = $request->get('page',1);
            $form = $this->createForm(SearchType::class,$data);
            [$min,$max] = $this->repos->findminmax($data);
            $form->handleRequest($request);
            return $this->render('rh/offre/candidat.html.twig',[
                'Controller_Name' =>'offre d\'emploi',
                'form' => $form->createView(),
                'offres' => $this->repos->findSearch($data),
                'min' => $min,
                'max'=> $max,
                ]);
        }
        return $this->render('rh/index.html.twig',[
            'controller_name' => 'Rh',
            'form' => $form2->createView(),
            'offres' => $this->repos->findAll(),
            'secteurs' => $secteurRepository->findAll(),
            'recruteur' => $recruteurRepository->findAll(),
            //'count' => $secteurRepository->count2()
        ]);
    }

    /**
     * @return Response@
     * @Route("/offre" , name="rh_offre")
     */
    public function offre(Request $request)
    {
        //mis a place du filtrage dynamique coté offre d'emploi
        $data = new SearchData();
        $data->page = $request->get('page',1);
        [$min,$max] = $this->repos->findminmax($data);
        $form = $this->createForm(SearchType::class,$data);
        $form->handleRequest($request);

            return $this->render('rh/offre/candidat.html.twig',[
                'Controller_Name' =>'offre d\'emploi',
                'form' => $form->createView(),
                'offres' => $this->repos->findSearch($data),
                'min' => $min,
                'max'=> $max,
            ]);
    }

    /**
     * @Route("/offre",name="rh_offre2")
     * @param $id
     * @param Request $request
     * @param SecteurRepository $repository
     * @return Response
     */
    public function offreParSecteur($id,Request $request,SecteurRepository $repository)
    {
        $data = new SearchData();
        $data->page = $request->get('page',1);
        [$min,$max] = $this->repos->findminmax($data);
        $form = $this->createForm(SearchType::class,$data);
        $form->handleRequest($request);
        $secteur =  $repository->findOneBy(['id' => $id ]);
        $data->secteur  = $secteur ;
        return $this->render('rh/offre/candidat.html.twig',[
            'Controller_Name' =>'offre d\'emploi',
                'form' => $form->createView(),
                'offres' => $this->repos->findSearch($data),
                'min' => $min,
                'max'=> $max,
        ]);
    }
    /**
     * @return Response
     * @Route("/cvthèque" , name="rh_cv")
     */
    public function cvtheque()
    {
        return $this->render('rh/cv/cvtheque.html.twig',[
            'Controller_Name' =>'cvthèque',
        ]);
    }
    /**
     * @return Response
     * @Route("/candidat" , name="rh_candidat")
     */
    public function candidat()
    {

        return $this->render('rh/offre/candidat.html.twig',[
            'Controller_Name' =>'cvthèque',
            'offres' => $this->repos->findAll(),

        ]);
    }

    /**
     * @Route("/plus_{id}",name="une_offre")
     * @param $id
     * @return Response
     */
    public function show($id,Request $request)
    {
        $offre = $this->repos->OffreRecent();
        $une_offre = $this->repos->findOneBy(['id'=> $id]);
        $offre_relatif = $this->repos->findAll();
        return $this->render('rh/voir.html.twig',[
            'controllerName' => 'Une offre',
            'une_offre' => $une_offre,
             'offre' => $offre,
            'offre_rel' => $offre_relatif,
        ]);
    }

}