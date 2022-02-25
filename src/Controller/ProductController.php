<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class ProductController extends AbstractController
{

    #[Route('/product/add', name: 'addProduct')]
    public function addProduct(Request $request, EntityManagerInterface $em): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class,$product);

        $form->handleRequest($request);
        $sizes = $request->get('size');
        if($form->isSubmitted() && $form->isValid()){
            $product->setSize(explode(",",$sizes));
            $product->setKeyWord(explode(";",$request->get('product')['keyWord']));
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('product/index.html.twig', [
            'productForm' => $form->createView(),
            'sizes'=>$sizes
        ]);
    }
}
