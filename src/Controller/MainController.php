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
        $search = [];
        $categs = $categoryRepository->findAll();
        $size = null;
        $prices = [];

        if($request->getMethod() == 'POST'){

            if(!empty($request->get("search"))){
                $search = explode(" ",$request->get("search"));
                $memory['search'] = $request->get('search');
            }
            
            $categFilter = null;
            if($request->get('categ')!=null){
                $categFilter = $categoryRepository->findOneBy(['id'=>$request->get('categ')]);
            }

           
            if($request->get('minPrice') != null){
                $prices[0] = $request->get('minPrice');
                $memory['minPrice'] = $request->get('minPrice');
            }
            if($request->get('maxPrice') != null){
                $prices[1] = $request->get('maxPrice');
                $memory['maxPrice'] = $request->get('maxPrice');
            }

            if($categFilter != null){
                $filters['category'] = $categFilter;
                $memory['categ'] = $categFilter->getId();    

                if(!empty($request->get('sizes'))){
                    $size = explode(",",$request->get('sizes'));
                    $memory['sizes'] = $request->get('sizes');
                }
            }
            
        }
      
        $products = $productRepository->findByFilter($filters,$prices,$size,$search);
   
        return $this->render('main/index.html.twig', [
            'categs' => $categs,
            'products'=>$products,
            'memory'=>$memory
        ]);
    }
}
