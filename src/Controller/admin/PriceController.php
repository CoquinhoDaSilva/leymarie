<?php


namespace App\Controller\admin;


use App\Entity\Price;
use App\Form\PriceType;
use App\Repository\PriceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PriceController extends AbstractController
{
    /**
     * @Route("/admin/prices", name="admin_prices")
     * @param PriceRepository $priceRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function prices(PriceRepository $priceRepository) {

        $prices = $priceRepository->findAll();

        return $this->render('admin/prices/prices.html.twig', [
            'prices'=>$prices
        ]);
    }

    /**
     * @Route("/admin/price/insert", name="admin_insert_price")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function insertPrice(Request $request, EntityManagerInterface $entityManager) {

        $price = new Price;

        $formPrice = $this->createForm(PriceType::class, $price);
        $formPrice->handleRequest($request);

        if($formPrice->isSubmitted() && $formPrice->isValid()) {

            $entityManager->persist($price);
            $entityManager->flush();

            return $this->redirectToRoute('admin_prices');

        }

        return $this->render('admin/prices/insert_price.html.twig', [
            'formPrice'=>$formPrice->createView()
        ]);
    }

    /**
     * @Route("/admin/price/update/{id}", name="admin_update_price")
     * @param PriceRepository $priceRepository
     * @param $id
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updatePrice(PriceRepository $priceRepository, $id, Request $request, EntityManagerInterface $entityManager) {

        $price = $priceRepository->find($id);

        $formPrice = $this->createForm(PriceType::class, $price);
        $formPrice->handleRequest($request);

        if ($formPrice->isSubmitted() && $formPrice->isValid()) {

            $entityManager->persist($price);
            $entityManager->flush();

            $this->addFlash('success', 'Le prix a bien été modifié !');

            return $this->redirectToRoute('admin_prices');

        }

        return $this->render('admin/prices/update_price.html.twig', [
            'formPrice'=>$formPrice->createView()
        ]);
    }

    /**
     * @Route("/admin/price/delete/{id}", name="admin_delete_price")
     */
    public function deletePrice(PriceRepository $priceRepository, $id, EntityManagerInterface $entityManager) {

        $price = $priceRepository->find($id);

        $entityManager->remove($price);
        $entityManager->flush();

        $this->addFlash('success', 'Le prix a bien été supprimé !');

        return $this->redirectToRoute('admin_prices');
    }

}