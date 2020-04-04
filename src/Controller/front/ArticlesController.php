<?php


namespace App\Controller\front;


use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles", name="articles")
     */
    public function articles(ArticleRepository $articleRepository) {

        $articles = $articleRepository->findAll();

        return $this->render('front/articles/articles.html.twig', [
            'articles'=>$articles
        ]);
    }

    /**
     * @Route("/article/show/{id}", name="article")
     * @param ArticleRepository $articleRepository
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function article(ArticleRepository $articleRepository, $id) {

        $article = $articleRepository->find($id);

        return $this->render('front/articles/article.html.twig', [
            'article'=>$article
        ]);
    }

    /**
     * @Route("/actuality/search", name="search_actuality")
     * @param ArticleRepository $articleRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchArticle(ArticleRepository $articleRepository, Request $request) {

        $search = $request->query->get('search');

        $articles = $articleRepository->getByWordInTitle($search);

        return $this->render('admin/articles/search_article.html.twig', [
            'search'=>$search,
            'articles'=>$articles
        ]);
    }

}