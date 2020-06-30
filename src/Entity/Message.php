<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 * @ApiResource(denormalizationContext={"groups" = "message:write"})
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("conversation:read")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"message:write","conversation:read"})
     *
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"conversation:read"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Conversation::class, inversedBy="messages")
     * @Groups({"message:write"})
     */
    private $conversation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="messages")
     * @Groups({"conversation:read"})
     */
    private $sender;
    /**
     * @Groups("message:write")
     * @var int
     */
    public $annonceId;

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getConversation(): ?Conversation
    {
        return $this->conversation;
    }

    public function setConversation(?Conversation $conversation): self
    {
        $this->conversation = $conversation;

        return $this;
    }

    public function getSender(): ?User
    {
        return $this->sender;
    }

    public function setSender(?User $sender): self
    {
        $this->sender = $sender;

        return $this;
    }
}
