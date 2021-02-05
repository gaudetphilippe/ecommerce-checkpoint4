<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ProductController extends AbstractController
{
    /**
     * @Route("/{slug}", name="product_category")
     */
    public function category($slug, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneBy([
            'slug' => $slug,
        ]);

        if (!$category){
            throw $this->createNotFoundException("La catégorie demandée n'existe pas");
        }

        return $this->render('product/category.html.twig', [
            'slug' => $slug,
            'category' => $category
        ]);
    }

    /**
     * @route("/{category_slug}/{slug}", name="product_show")
     */
    public function show($slug, ProductRepository $productRepository, UrlGeneratorInterface $urlGenerator) {


        $product = $productRepository->findOneBy([
            'slug' => $slug
        ]);

        if(!$product){
            throw $this->createNotFoundException("le produit demandé n'existe pas");
        }

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'urlGenerator' => $urlGenerator
        ]);
    }
}

