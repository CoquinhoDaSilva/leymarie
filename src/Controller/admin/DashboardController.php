<?php


namespace App\Controller\admin;


use App\Repository\AlertMessageRepository;
use App\Repository\ArticleRepository;
use App\Repository\BlocOneRepository;
use App\Repository\BlocTwoRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentaryRepository;
use App\Repository\HealthcareRepository;
use App\Repository\PriceRepository;
use App\Repository\ProtocolRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{

    /**
     * @Route("/admin", name="admin_dashboard")
     * @param ArticleRepository $articleRepository
     * @param CommentaryRepository $commentaryRepository
     * @param HealthcareRepository $healthcareRepository
     * @param ProtocolRepository $protocolRepository
     * @param UserRepository $userRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminDashboard(BlocTwoRepository $blocTwoRepository, BlocOneRepository $blocOneRepository, CategoryRepository $categoryRepository, AlertMessageRepository $alertMessageRepository, ArticleRepository $articleRepository, HealthcareRepository $healthcareRepository, ProtocolRepository $protocolRepository) {

        $articles = $articleRepository->findAll();
        $healthcare = $healthcareRepository->findAll();
        $protocol = $protocolRepository->findAll();
        $alertMessage = $alertMessageRepository->findAll();
        $categories = $categoryRepository->findAll();
        $blocOne = $blocOneRepository->findAll();
        $blocTwo = $blocTwoRepository->findAll();

        return $this->render('admin/home/dashboard.html.twig', [
            'articles'=>$articles,
            'healthcare'=>$healthcare,
            'protocol'=>$protocol,
            'alertMessage'=>$alertMessage,
            'categories'=>$categories,
            'blocOne'=>$blocOne,
            'blocTwo'=>$blocTwo
        ]);

    }
}