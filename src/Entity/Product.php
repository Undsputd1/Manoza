<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Category;
use App\Entity\OrderItem;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Category $category = null;

    #[ORM\Column]
    private ?float $ordering = null;

    #[ORM\Column(length: 255)]
    private ?string $item = null;

    #[ORM\Column]
    private ?float $stock = null;

    #[ORM\Column(length: 255)]
    private ?string $reviews = null;

    /**
     * @var Collection<int, OrderItem>
     */
    #[ORM\OneToMany(targetEntity: OrderItem::class, mappedBy: 'product')]
    private Collection $orderItems;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getName(): ?string { return $this->name; }
    public function setName(string $name): static { $this->name = $name; return $this; }
    public function getPrice(): ?float { return $this->price; }
    public function setPrice(float $price): static { $this->price = $price; return $this; }
    public function getCategory(): ?Category { return $this->category; }
    public function setCategory(?Category $category): static { $this->category = $category; return $this; }
    public function getOrdering(): ?float { return $this->ordering; }
    public function setOrdering(float $ordering): static { $this->ordering = $ordering; return $this; }
    public function getItem(): ?string { return $this->item; }
    public function setItem(string $item): static { $this->item = $item; return $this; }
    public function getStock(): ?float { return $this->stock; }
    public function setStock(float $stock): static { $this->stock = $stock; return $this; }
    public function getReviews(): ?string { return $this->reviews; }
    public function setReviews(string $reviews): static { $this->reviews = $reviews; return $this; }

    /**
     * @return Collection<int, OrderItem>
     */
    public function getOrderItems(): Collection { return $this->orderItems; }

    public function addOrderItem(OrderItem $orderItem): static
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems->add($orderItem);
            $orderItem->setProduct($this);
        }
        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): static
    {
        if ($this->orderItems->removeElement($orderItem)) {
            if ($orderItem->getProduct() === $this) {
                $orderItem->setProduct(null);
            }
        }
        return $this;
    }
}
