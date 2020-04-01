<?php


namespace App\Controller\admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_users")
     */
    public function users() {

        return $this->render('admin/users/users.html.twig');
    }

    /**
     * @Route("/admin/user/{id]", name="admin_user")
     */
    public function user() {

        return $this->render('admin/users/profile.html.twig');
    }

    /**
     * @Route("/admin/user/insert", name="admin_insert_user")
     */
    public function insertUser() {

        return $this->render('admin/users/insert_user.html.twig');
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