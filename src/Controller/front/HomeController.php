<?php


namespace App\Controller\front;


use App\Repository\AlertMessageRepository;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\HealthcareRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     * @param HealthcareRepository $healthcareRepository
     * @param ArticleRepository $articleRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home(ArticleRepository $articleRepository, CategoryRepository $categoryRepository, AlertMessageRepository $alertMessageRepository) {

        $lastArticles = $articleRepository->findBy([], ['date'=>'DESC'], 3, 0);
        $categories = $categoryRepository->findAll();
        $alertMessage = $alertMessageRepository->findAll();

        return $this->render('front/home/home.html.twig', [
            'lastarticles'=>$lastArticles,
            'categories'=>$categories,
            'alertMessage'=>$alertMessage
        ]);

    }
}