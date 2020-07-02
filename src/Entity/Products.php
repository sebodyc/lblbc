<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use App\Controller\CreateProductWithImageController;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 * @ApiResource(normalizationContext={"groups"={"product"}} ,
 *      collectionOperations={
 *       "get",
 *     "post"={
 *             "controller"=CreateProductWithImageController::class,
 *             "deserialize"=false}
 *     })
 * @Vich\Uploadable()
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "ZipCode": "exact"})
 *
 *
 */
class Products
{
    /**
     * @ORM\Id()
     *
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"product","user" , "conversation:read"})
     *
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
     * @Groups({"product","conversation:read"})
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

    /**
     * @Vich\UploadableField(mapping="products", fileNameProperty="productImage")
     */
    private $productImageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("product")
     */
    private $productImage;

    /**
     * @return mixed
     */
    public function getProductImageFile()
    {
        return $this->productImageFile;
    }

    /**
     * @param mixed $productImageFile
     */
    public function setProductImageFile($productImageFile): void
    {
        $this->productImageFile = $productImageFile;
    }


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

    public function getProductImage(): ?string
    {
        return $this->productImage;
    }

    public function setProductImage(?string $productImage): self
    {
        $this->productImage = $productImage;

        return $this;
    }
}
