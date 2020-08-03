<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product
            ->setPrice(600.50)
            ->setQte(10)
            ->setName("Iphone 1")
            ->setDescription("description de l'article n°1")
            ->setFeatures("caractéristique du produit n°1")
            ->setCategory($this->getReference(CategoryFixtures::CATEGORY_1_REFERENCE))
            ->setImage("http://placehold.it/350x250");
        $manager->persist($product);
        $product2 = new Product();
        $product2
            ->setPrice(600.50)
            ->setQte(10)
            ->setName("Iphone 1")
            ->setDescription("description de l'article n°1")
            ->setFeatures("caractéristique du produit n°1")
            ->setCategory($this->getReference(CategoryFixtures::CATEGORY_2_REFERENCE))
            ->setImage("http://placehold.it/350x150");
        $manager->persist($product2);

        $product3 = new Product();
        $product3
            ->setPrice(600.50)
            ->setQte(10)
            ->setName("Iphone 1")
            ->setDescription("description de l'article n°1")
            ->setFeatures("caractéristique du produit n°1")
            ->setCategory($this->getReference(CategoryFixtures::CATEGORY_1_REFERENCE))
            ->setImage("http://placehold.it/350x150");
        $manager->persist($product3);
        $product4 = new Product();
        $product4
            ->setPrice(600.50)
            ->setQte(10)
            ->setName("Iphone 1")
            ->setDescription("description de l'article n°1")
            ->setFeatures("caractéristique du produit n°1")
            ->setCategory($this->getReference(CategoryFixtures::CATEGORY_1_REFERENCE))
            ->setImage("http://placehold.it/350x150");
        $manager->persist($product4);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class
        ];
    }

    public static function getGroups(): array
    {
     return ["product"];
    }
}
