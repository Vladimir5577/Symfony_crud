<?php

namespace App\Entity;

use App\Repository\WorkerRepository;
use Doctrine\ORM\Mapping as ORM;

// for validation
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;
//use Symfony\Component\Validator\Constraints as Assert;  // for email or something

/**
 * @ORM\Entity(repositoryClass=WorkerRepository::class)
 */
class Worker
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    // validation
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
        $metadata->addPropertyConstraint('country', new NotBlank());
        $metadata->addPropertyConstraint('description', new NotBlank());
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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

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
}
