<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    #[Route('/product/add', name: 'addProduct')]
    public function addProduct(Request $request, EntityManagerInterface $em, FileUploader $fileUploader): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class,$product);

        
        $form->handleRequest($request);
        $sizes = $request->get('size');
        if($form->isSubmitted() && $form->isValid()){

            $file = $form->get('imgProduct')->getData();
            if ($file) {
                $brochureFileName = $fileUploader->upload($file);
                $product->setImgProduct($brochureFileName);
            }

            $product->setSize(explode(",",$sizes));
            $product->setKeyWord(explode(";",$request->get('product')['keyWord']));
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('main');
        }

        return $this->render('product/index.html.twig', [
            'productForm' => $form->createView(),
            'sizes'=>$sizes
        ]);
    }

    #[Route('/product/{id}', name:"getProduct")]
    public function getProductById(Request $request, ProductRepository $productRepository)
    {

        $requestParam = $request->get('id');
        $product = $productRepository->findOneBy(['id'=>$requestParam]);

        return $this->render('product/desc.html.twig', [
            'product'=>$product
        ]);
    }
}
