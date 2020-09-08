<?php


namespace App\Controller\front;


use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route ("/category/show/{id}", name="category")
     * @param $id
     * @param CategoryRepository $categoryRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryFront($id, CategoryRepository $categoryRepository) {
        $category = $categoryRepository->find($id);

        return $this->render('front/categories/category.html.twig', [
            'category'=>$category
        ]);
    }
}