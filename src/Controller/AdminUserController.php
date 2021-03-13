<?php


namespace App\Controller;


use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminUserController
 * @package App\Controller
 */
class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin_user" , name="utilisateur")
     * @param UserRepository $userRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(UserRepository $userRepository)
    {
        return $this->render('admin/user/utilisateur.html.twig',[
            'users' => $userRepository->findAll(),
    ]);
    }

    /**
     * @Route("/deleteUser_{id}" , name="userdelete")
     */
    public function delete($id , Request $request,EntityManagerInterface $manager,UserRepository $repository)
    {
        $user = $repository->findOneBy(['email'=> $id ]);
        $manager->remove($user);
        $manager->flush();
        $this->addFlash('utilisateur_spp','supprimer avec success');
        return $this->redirectToRoute('utilisateur');
    }
}