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
        $lastArticles = $articleRepository->findBy([], ['date'=>'DESC'], 3, 0);

        return $this->render('front/home/home.html.twig', [
            'healthcare'=>$healthcare,
            'lastarticles'=>$lastArticles
        ]);

    }
}