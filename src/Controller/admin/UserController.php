<?php


namespace App\Controller\admin;


use App\Repository\UserRepository;
use Couchbase\UserSettings;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/admin/user/update", name="admin_update_user")
     */
    public function updateUser() {

        return $this->render('admin/users/update_user.html.twig');
    }

    /**
     * @Route("/admin/user/delete", name="admin_delete_user")
     */
    public function deleteUser() {

        return $this->render('admin/users/delete_user.html.twig');
    }

}