<?php


namespace App\Controller\front;


use App\Repository\AlertMessageRepository;
use App\Repository\ArticleRepository;
use App\Repository\BlocOneRepository;
use App\Repository\BlocTwoRepository;
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
    public function home(BlocTwoRepository $blocTwoRepository, BlocOneRepository $blocOneRepository, HealthcareRepository $healthcareRepository, ArticleRepository $articleRepository, CategoryRepository $categoryRepository, AlertMessageRepository $alertMessageRepository) {

        $lastArticles = $articleRepository->findBy([], ['date'=>'DESC'], 3, 0);
        $categories = $categoryRepository->findBy([], ['id'=>'ASC'], 3, 0);
        $alertMessage = $alertMessageRepository->findAll();
        $healthcare = $healthcareRepository->findAll();
        $tarifs = $categoryRepository->findAll();
        $blocOne = $blocOneRepository->find(1);
        $blocTwo = $blocTwoRepository->find(1);


        return $this->render('front/home/home.html.twig', [
            'lastarticles'=>$lastArticles,
            'categories'=>$categories,
            'alertMessage'=>$alertMessage,
            'healthcare'=>$healthcare,
            'tarifs'=>$tarifs,
            'blocOne'=>$blocOne,
            'blocTwo'=>$blocTwo
        ]);

    }
}