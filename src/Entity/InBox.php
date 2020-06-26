<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InBoxRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InBoxRepository::class)
 * @ApiResource()
 */
class InBox
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
    private $title;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $message;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="inBoxes")
     */
    private $destinataire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sender;

    /**
     * @ORM\Column(type="integer")
     */
    private $productUserId;

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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDestinataire(): ?User
    {
        return $this->destinataire;
    }

    public function setDestinataire(?User $destinataire): self
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    public function getSender(): ?string
    {
        return $this->sender;
    }

    public function setSender(string $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getProductUserId(): ?int
    {
        return $this->productUserId;
    }

    public function setProductUserId(int $productUserId): self
    {
        $this->productUserId = $productUserId;

        return $this;
    }
}
