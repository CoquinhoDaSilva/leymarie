<?php


namespace App\Controller\admin;


use App\Form\CommentaryType;
use App\Repository\CommentaryRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class CommentaryController extends AbstractController
{

    /**
     * @Route("/admin/commentaries", name="admin_commentaries")
     * @param CommentaryRepository $commentaryRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminCommentaries(CommentaryRepository $commentaryRepository) {

        $commentaries = $commentaryRepository->findBy([], ['date'=>'DESC']);


        return $this->render('admin/commentaries/commentaries.html.twig', [
            'commentaries'=>$commentaries
        ]);
    }

    /**
     * @Route("/admin/commentary/show/{id}", name="admin_commentary")
     * @param CommentaryRepository $commentaryRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminCommentary(CommentaryRepository $commentaryRepository, $id, UserRepository $userRepository) {

        $commentary = $commentaryRepository->find($id);

        return $this->render('admin/commentaries/commentary.html.twig', [
            'commentary'=>$commentary,
        ]);
    }

    /**
     * @Route("/admin/commentary/search", name="admin_search_commentary")
     */
    public function adminSearchCommentary(Request $request, CommentaryRepository $commentaryRepository) {

        $search = $request->query->get('search');
        $commentary = $commentaryRepository->getByWordInComment($search);

        return $this->render('admin/commentaries/search_commentary.html.twig', [
            'search'=>$search,
            'commentary'=>$commentary
        ]);
    }

    /**
     * @Route("/admin/commentary/update/{id}", name="admin_update_commentary")
     * @param CommentaryRepository $commentaryRepository
     * @param $id
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminUpdateCommentary(CommentaryRepository $commentaryRepository, $id, Request $request, EntityManagerInterface $entityManager) {

        $commentary = $commentaryRepository->find($id);

        $formCommentary = $this->createForm(CommentaryType::class, $commentary);
        $formCommentary->handleRequest($request);

        if ($formCommentary->isSubmitted() && $formCommentary->isValid()) {

            $entityManager->persist($commentary);
            $entityManager->flush();

            $this->addFlash('success', 'Le commentaire a bien été modifié !');

            return $this->redirectToRoute('admin_commentaries', ['id'=>$commentary->getId()]);

        }


        return $this->render('admin/commentaries/update_commentary.html.twig', [
            'formCommentary'=>$formCommentary->createView()
        ]);

    }


    /**
     * @Route("/admin/commentary/delete/{id}", name="admin_delete_commentary")
     */
    public function adminDeleteCommentary ($id, CommentaryRepository $commentaryRepository, EntityManagerInterface $entityManager) {


        $commentary = $commentaryRepository->find($id);

        $entityManager->remove($commentary);
        $entityManager->flush();

        $this->addFlash('success', 'Le commentaire a bien été supprimé !');


        return $this->redirectToRoute('admin_commentaries');
    }

}