<?php


namespace App\Controller\admin;


use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class UserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_users")
     */
    public function users(UserRepository $userRepository) {

        $users = $userRepository->findAll();

        return $this->render('admin/users/users.html.twig', [
            'users'=>$users
        ]);
    }

    /**
     * @Route("/admin/user/show/{id}", name="admin_user")
     */
    public function user($id, UserRepository $userRepository) {

        $user = $userRepository->find($id);

        return $this->render('admin/users/user.html.twig', [
            'user'=>$user
        ]);
    }

    /**
     * @Route("/admin/user/search", name="admin_search_user")
     */
    public function searchUser() {

        return $this->render('admin/users/search_user.html.twig');
    }

    /**
     * @Route("/admin/user/update/{id}", name="admin_update_user")
     * @param UserRepository $userRepository
     * @param $id
     * @param Request $request
     * @param EntityManager $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateUser(UserRepository $userRepository, $id, Request $request, EntityManagerInterface $entityManager) {

        $user = $userRepository->find($id);

        $formUser = $this->createForm(UserType::class, $user);
        $formUser->handleRequest($request);

        if ($formUser->isSubmitted() && $formUser->isValid()) {

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'L\'utilisateur a bien été modifié !');

            return $this->redirectToRoute('admin_user', ['id'=>$user->getId()]);

        }

        return $this->render('admin/users/update_user.html.twig', [
            'formUser'=>$formUser->createView()
        ]);
    }

    /**
     * @Route("/admin/user/delete/{id}", name="admin_delete_user")
     * @param UserRepository $userRepository
     * @param $id
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteUser(UserRepository $userRepository, $id, EntityManagerInterface $entityManager) {

        $user = $userRepository->find($id);

        $entityManager->remove($user);
        $entityManager->flush();

        $this->addFlash('success', 'L\'utilisateur a bien été supprimé !');

        return $this->redirectToRoute('admin_users');

    }

}