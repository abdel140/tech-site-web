<?php

namespace App\DataFixtures;

use App\Entity\CategoryParent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryParentFixtures extends Fixture implements FixtureGroupInterface
{
    public const CATEGORY_PARENT_1_REFERENCE = "category-parent-1";
    public const CATEGORY_PARENT_2_REFERENCE = "category-parent-2";
    public const CATEGORY_PARENT_3_REFERENCE = "category-parent-3";
    public const CATEGORY_PARENT_4_REFERENCE = "category-parent-4";
    public function load(ObjectManager $manager)
    {
        $category_parent = new CategoryParent();
        $category_parent->setName("category parent 1");
        $manager->persist($category_parent);

        $category_parent2 = new CategoryParent();
        $category_parent2->setName("category parent 2");
        $manager->persist($category_parent2);

        $category_parent3 = new CategoryParent();
        $category_parent3->setName("category parent 3");
        $manager->persist($category_parent3);

        $manager->flush();
        $this->addReference(self::CATEGORY_PARENT_1_REFERENCE, $category_parent);
        $this->addReference(self::CATEGORY_PARENT_2_REFERENCE, $category_parent2);
        $this->addReference(self::CATEGORY_PARENT_3_REFERENCE, $category_parent3);
    }
    public static function getGroups(): array
    {
        return ['category_parent'];
    }
}
