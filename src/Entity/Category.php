<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategoryParent", inversedBy="category_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoryParent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="category", orphanRemoval=true)
     */
    private $product_category_relation;

    public function __construct()
    {
        $this->product_category_relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategoryParent(): ?CategoryParent
    {
        return $this->categoryParent;
    }

    public function setCategoryParent(?CategoryParent $categoryParent): self
    {
        $this->categoryParent = $categoryParent;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProductCategoryRelation(): Collection
    {
        return $this->product_category_relation;
    }

    public function addProductCategoryRelation(Product $productCategoryRelation): self
    {
        if (!$this->product_category_relation->contains($productCategoryRelation)) {
            $this->product_category_relation[] = $productCategoryRelation;
            $productCategoryRelation->setCategoryId($this);
        }

        return $this;
    }

    public function removeProductCategoryRelation(Product $productCategoryRelation): self
    {
        if ($this->product_category_relation->contains($productCategoryRelation)) {
            $this->product_category_relation->removeElement($productCategoryRelation);
            // set the owning side to null (unless already changed)
            if ($productCategoryRelation->getCategoryId() === $this) {
                $productCategoryRelation->setCategoryId(null);
            }
        }

        return $this;
    }
}
