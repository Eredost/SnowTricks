<?php

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MediaRepository::class)
 */
class Media
{
    use TimestampableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message = "La source ne peut pas être vide"
     * )
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "La source ne peut pas dépasser {{ limit }} caractères"
     * )
     */
    private $src;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank(
     *     message = "Le type de media ne peut pas être vide"
     * )
     * @Assert\Length(
     *     max = 60,
     *     maxMessage = "Le type de media ne peut pas dépasser {{ limit ]] caractères"
     * )
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Trick::class, inversedBy="media")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trick;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setSrc(string $src): self
    {
        $this->src = $src;

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

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function setTrick(?Trick $trick): self
    {
        $this->trick = $trick;

        return $this;
    }
}
