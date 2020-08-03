<?php
/**
 * Created by PhpStorm.
 * User: abdel
 * Date: 15/04/2020
 * Time: 14:24
 */

namespace App\Controller;
use App\Entity\Order;
use App\Repository\CategoryParentRepository;
use App\Repository\ProductRepository;
use App\Service\Cart\CartService;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_getCart")
     */
    public function getCart(CartService $cartService)
    {
        $cartWithData = $cartService->getCart();
        $total = $cartService->getTotal();
        return $this->render("security/cart.html.twig", ["items"=>$cartWithData, "total"=>$total]);
    }


    /**
     * @Route(path="/product/{id_product}", methods={"POST"}, name="cart_addToCart")
     */
    public function addToCart($id_product, CartService $cartService)
    {
        $cartService->addToCart($id_product);
        return $this->redirectToRoute("cart_addToCart",array("id_product"=>$id_product));
    }
    /**
     * @Route(path="/cart/product/{id_product}", methods={"POST"}, name="cart_removeProduct")
     */
    public function removeProduct($id_product, CartService $cartService){
        $cartService->removeProduct($id_product);
        return $this->redirectToRoute("cart_getCart");
    }

    /**
     * @Route(path="/purchase-confirmation", methods={"GET"}, name="cart_purchase")
     */
    public function purchase(CartService $cartService,CategoryParentRepository $categoryParentRepository){
        $order = $cartService->purchase();
        $manager = $this->getDoctrine()->getManager();
        $total = $cartService->getTotal();
        $categoriesParents = $categoryParentRepository->findAll();
        $manager->persist($order);
        $manager->flush();
        $cartService->emptyCart();
        return $this->render("security/purchase-confirmation.html.twig",["order" => $order ,"total" => $total, "categoriesParents"=>$categoriesParents]);
    }
}