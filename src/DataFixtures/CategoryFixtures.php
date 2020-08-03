<?php

namespace App\DataFixtures;
use App\Repository\CategoryParentRepository;
use Psr\Log\LoggerInterface;
use App\Entity\Category;
use App\Entity\CategoryParent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CategoryFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public const CATEGORY_1_REFERENCE = "category-1";
    public const CATEGORY_2_REFERENCE = "category-2";
    public const CATEGORY_3_REFERENCE = "category-3";
    public const CATEGORY_4_REFERENCE = "category-4";
    public function load(ObjectManager $manager){

        $category = new Category();
        $category->setName("category n°1");
        $category->setCategoryParent($this->getReference(CategoryParentFixtures::CATEGORY_PARENT_1_REFERENCE));
        $manager->persist($category);

        $category2 = new Category();
        $category2->setName("category n°2");
        $category2->setCategoryParent($this->getReference(CategoryParentFixtures::CATEGORY_PARENT_2_REFERENCE));
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName("category n°3");
        $category3->setCategoryParent($this->getReference(CategoryParentFixtures::CATEGORY_PARENT_1_REFERENCE));
        $manager->persist($category3);

        $category4 = new Category();
        $category4->setName("category n°4");
        $category4->setCategoryParent($this->getReference(CategoryParentFixtures::CATEGORY_PARENT_3_REFERENCE));
        $manager->persist($category4);

        $manager->flush();
        $this->addReference(self::CATEGORY_1_REFERENCE, $category);
        $this->addReference(self::CATEGORY_2_REFERENCE, $category2);
        $this->addReference(self::CATEGORY_3_REFERENCE, $category3);
        $this->addReference(self::CATEGORY_4_REFERENCE, $category4);
    }

    public function getDependencies()
    {
        return [
            CategoryParentFixtures::class
        ];
    }

    public static function getGroups(): array
    {
        return ['category'];
    }
}

