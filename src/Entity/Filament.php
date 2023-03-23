<?php
declare(strict_types=1);
namespace App\Entity;

use App\Repository\FilamentRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilamentRepository::class)]
class Filament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $producer = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\Column(length: 255)]
    private ?string $material = null;

    #[ORM\Column(length: 255)]
    private ?string $temperatureExtruder = null;

    #[ORM\Column(length: 255)]
    private ?string $temperatureTable = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $purchaseDate = null;

    #[ORM\ManyToOne(inversedBy: 'filaments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filename = null;

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename($filename):self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducer(): ?string
    {
        return $this->producer;
    }

    public function setProducer(string $producer): self
    {
        $this->producer = $producer;

        return $this;
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getMaterial(): ?string
    {
        return $this->material;
    }

    public function setMaterial(string $material): self
    {
        $this->material = $material;

        return $this;
    }

    public function getTemperatureExtruder(): ?string
    {
        return $this->temperatureExtruder;
    }

    public function setTemperatureExtruder(string $temperatureExtruder): self
    {
        $this->temperatureExtruder = $temperatureExtruder;

        return $this;
    }

    public function getTemperatureTable(): ?string
    {
        return $this->temperatureTable;
    }

    public function setTemperatureTable(string $temperatureTable): self
    {
        $this->temperatureTable = $temperatureTable;

        return $this;
    }

    public function getPurchaseDate(): ?DateTimeInterface
    {
        return $this->purchaseDate;
    }

    public function setPurchaseDate(DateTimeInterface $purchaseDate): self
    {
        $this->purchaseDate = $purchaseDate;

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
}
