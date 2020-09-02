<?php


namespace App\Controller\admin;


use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryController extends AbstractController
{

    /**
     * @Route("/admin/categories", name="admin_categories")
     * @param CategoryRepository $categoryRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminCategories(CategoryRepository $categoryRepository) {

        $categories = $categoryRepository->findAll();

        return $this->render('admin/categories/categories.html.twig', [
            'categories'=>$categories
        ]);
    }

    /**
     * @Route("/admin/category/show/{id}", name="admin_category")
     * @param CategoryRepository $categoryRepository
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminCategory(CategoryRepository $categoryRepository, $id) {

        $category = $categoryRepository->find($id);

        return $this->render('admin/categories/category.html.twig', [
            'category'=>$category
        ]);
    }


    /**
     * @Route("/admin/category/insert", name="admin_insert_category")
     */
    public function insertCategory(Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager) {

        $category = new Category;

        $formCategory = $this->createForm(CategoryType::class, $category);
        $formCategory->handleRequest(($request));

        if ($formCategory->isSubmitted() && $formCategory->isValid()) {

            $picture = $formCategory->get('picture')->getData();

            if ($picture) {

                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $picture->guessExtension();

                $picture->move(
                    $this->getParameter('pictures_directory'),
                    $newFilename
                );

                $category->setPicture($newFilename);
            }

            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'La catégorie a bien été ajoutée !');
        }


        return $this->render('admin/categories/insert_category.html.twig', [
            'formCategory'=>$formCategory->createView()
        ]);
    }

    /**
     * @Route("/admin/category/update/{id}", name="admin_update_category")
     */
    public function updateCategory($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager, Request $request) {

        $category = $categoryRepository->find($id);

        $formCategory = $this->createForm(CategoryType::class, $category);
        $formCategory->handleRequest($request);

        if ($formCategory->isSubmitted() && $formCategory->isValid()) {

            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'La catégorie a bien été modifiée !');

            return $this->redirectToRoute('admin_category', ['id'=>$category->getId()]);
        }

        return $this->render('admin/categories/update_category.html.twig', [
            'formCategory'=>$formCategory->createView()
        ]);
    }


    /**
     * @Route ("/admin/category/delete/{id}", name="admin_delete_category")
     * @param $id
     * @param EntityManagerInterface $entityManager
     * @param CategoryRepository $categoryRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteCategory($id, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository) {

        $category = $categoryRepository->find($id);

        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('admin_categories');
    }

}