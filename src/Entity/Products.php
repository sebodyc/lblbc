<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 * @ApiResource(normalizationContext={"groups"={"product"}})
 *
 */
class Products
{
    /**
     * @ORM\Id()
     * @ApiFilter(SearchFilter::class, properties={"id": "exact", "ZipCode": "exact", "ZipCode": "start"})
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"product","user" , "conversation:read"})
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"product","user","conversation:read"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=6555)
     * @Groups({"product"})
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @Groups({"product"})
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="products")
     * @Groups({"product"})
     *
     */
    private $User;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"product"})
     */
    private $ZipCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"product"})
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Conversation::class, mappedBy="product")
     * @ApiSubresource()
     */
    private $conversations;

    public function __construct()
    {
        $this->conversations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return User|null
     *
     */
    public function getUser(): ?User
    {
        return $this->User;
    }

    /**
     * @param User|null $User
     *
     * @return Products
     */
    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getZipCode(): ?int
    {
        return $this->ZipCode;
    }

    public function setZipCode(int $ZipCode): self
    {
        $this->ZipCode = $ZipCode;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Conversation[]
     */
    public function getConversations(): Collection
    {
        return $this->conversations;
    }

    public function addConversation(Conversation $conversation): self
    {
        if (!$this->conversations->contains($conversation)) {
            $this->conversations[] = $conversation;
            $conversation->setProduct($this);
        }

        return $this;
    }

    public function removeConversation(Conversation $conversation): self
    {
        if ($this->conversations->contains($conversation)) {
            $this->conversations->removeElement($conversation);
            // set the owning side to null (unless already changed)
            if ($conversation->getProduct() === $this) {
                $conversation->setProduct(null);
            }
        }

        return $this;
    }
}
