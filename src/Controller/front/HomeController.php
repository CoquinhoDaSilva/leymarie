<?php


namespace App\Controller\front;


use App\Repository\ArticleRepository;
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
    public function home(HealthcareRepository $healthcareRepository, ArticleRepository $articleRepository) {

        $healthcare = $healthcareRepository->findAll();
        $articles = $articleRepository->findAll();

        return $this->render('front/home/home.html.twig', [
            'healthcare'=>$healthcare,
            'articles'=>$articles
        ]);

    }
}