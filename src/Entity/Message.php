<?php
declare(strict_types=1);

namespace App\Entity;

use App\Enum\MessageAspect;
use App\Repository\MessageRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $textMessage = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $dateOfCreation = null;

    #[ORM\Column]
    private ?bool $readMessage = false;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private ?MessageAspect $messageAspect = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTextMessage(): ?string
    {
        return $this->textMessage;
    }

    public function setTextMessage(string $textMessage): self
    {
        $this->textMessage = $textMessage;

        return $this;
    }

    public function getDateOfCreation(): ?DateTimeInterface
    {
        return $this->dateOfCreation;
    }

    public function setDateOfCreation(DateTimeInterface $dateOfCreation): self
    {
        $this->dateOfCreation = $dateOfCreation;

        return $this;
    }

    public function isReadMessage(): ?bool
    {
        return $this->readMessage;
    }

    public function setReadMessage(bool $readMessage): self
    {
        $this->readMessage = $readMessage;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMessageAspect(): ?MessageAspect
    {
        return $this->messageAspect;
    }

    public function setMessageAspect(MessageAspect $messageAspect): self
    {
        $this->messageAspect = $messageAspect;

        return $this;
    }
}
