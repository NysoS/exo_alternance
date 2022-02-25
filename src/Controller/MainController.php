<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(Request $request, CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
    {
        $memory = [];
        $filters = [];
        $categs = $categoryRepository->findAll();
        $size = null;

        if($request->getMethod() == 'POST'){

            $categFilter = $categoryRepository->findOneBy($request->get('categ')!=null?['id'=>$request->get('categ')]:[]);

            if($categFilter != null){
                $filters['category'] = $categFilter;
                $memory['categ'] = $categFilter->getId();    

                if(!empty($request->get('sizes'))){
                    $size = explode(",",$request->get('sizes'));
                    $memory['sizes'] = $request->get('sizes');
                }
            }
        }
      
        $products = $productRepository->findByFilter($filters,$size);
   
        return $this->render('main/index.html.twig', [
            'categs' => $categs,
            'products'=>$products,
            'memory'=>$memory
        ]);
    }
}
