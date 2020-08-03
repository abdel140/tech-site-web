<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\CategoryParent;
use App\Entity\Product;
use App\Repository\CategoryParentRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use function PHPSTORM_META\override;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    /**
     * @Route("/products", name="product_getProducts")
     */
    public function getProducts(ProductRepository $productRepo, CategoryParentRepository $categoryParentRepo)
    {
        $products = $productRepo->findAll();
        $categoriesParents = $categoryParentRepo->findAll();
        return $this->render('product/products.html.twig', [
            "products"=>$products,
            "categoriesParents" => $categoriesParents
        ]);
    }
    /**
     * @Route("/category/{category_id}", name="product_getProductsByCategory")
     */
    public function getProductsByCategory(ProductRepository $repo, CategoryParentRepository $categoryParentRepo, int $category_id)
    {
        $categoriesParents = $categoryParentRepo->findAll();
        $products = $repo->findBy(['category' => $category_id]);
        return $this->render('/product/category.html.twig', [
            "products"=>$products, "categoriesParents"=>$categoriesParents
        ]);
    }

    /**
     * @Route("/product/{id}", methods={"GET"}, name="product_getProduct")
     */
    public function getProduct(Product $product, CategoryParentRepository $categoryParentRepository){
        $categoriesParents = $categoryParentRepository->findAll();
        return $this->render('/product/details.html.twig',["product"=>$product, "categoriesParents"=>$categoriesParents]);
    }
    public function getProductById(int $idProduct, ProductRepository $productRepository){
        $product = $productRepository->find($idProduct);
        return $product;
    }
}
