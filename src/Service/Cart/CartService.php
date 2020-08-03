<?php
/**
 * Created by PhpStorm.
 * User: abdel
 * Date: 02/05/2020
 * Time: 12:47
 */

namespace App\Service\Cart;


use App\Controller\ProductController;
use App\Entity\Order;
use App\Entity\Product;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

class CartService{

    protected $session;
    protected $productRepository;
    protected $security;
    protected $productController;
    public function __construct(SessionInterface $session, ProductRepository $productRepository, Security $security, ProductController $productController )
    {
        $this->productController = $productController;
        $this->security = $security;
        $this->productRepository = $productRepository;
        $this->session = $session;
    }

    public function getCart(){
        $cartWithData = [];
        $cart = $this->session->get('cart',[]);
        foreach ($cart as $id => $quantity) {
            $product = $this->productRepository->find($id);
            if ($product === null) {
                continue;
            }
            $cartWithData[] = ['product' => $product, 'quantity' => $quantity];
        }
        return $cartWithData;
    }

    public function getTotal(){
        $total = 0;
        $cart = $this->session->get('cart',[]);
        foreach ($cart as $id => $quantity) {
            $product = $this->productRepository->find($id);
            if ($product === null) {
                continue;
            }
            $total += $product->getPrice() * $quantity;
        }
        return $total;
    }

    public function addToCart($idProduct){
        //$this->initializeCart();
        $cart = $this->session->get('cart',[]);
        //$product = $this->productRepository->find($idProduct);
        if (!empty($cart[$idProduct])){
            $cart[$idProduct]++;
        }else{
            $cart[$idProduct] = 1;
        }
        $cart = $this->session->set('cart', $cart);
    }

    public function removeProduct(int $idProduct){
        $cart = $this->session->get('cart',[]);
        $product = $this->productRepository->find($idProduct);
        unset($cart[$product]);
        $this->session->set('cart',$cart);
    }

    public function purchase(){
        $order = new Order();
        $cart = $this->session->get('cart',[]);
        $products = [];
        foreach ($cart as $id => $quantity){
            $product = $this->productRepository->find($id);
            $products[] = [$product];
            $order->addProduct($product);
        }
        $date = new \DateTime();
        $user = $this->security->getUser();
        $order->setDatePurchase($date);
        $order->setUser($user);
        return $order;
    }
    public function emptyCart(){
        $this->session->set('cart',[]);
    }
}
