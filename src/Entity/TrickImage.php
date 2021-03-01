<?php

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Repository\TrickImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TrickImageRepository::class)
 */
class TrickImage
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
     * @Assert\File(
     *     maxSize = "2M",
     *     maxSizeMessage = "La taille du fichier est trop importante, celle-ci ne doit pas excéder {{ limit }} {{ suffix }}",
     *     mimeTypes = {"image/png", "image/jpeg", "image/gif"},
     *     mimeTypesMessage = "Le type de fichier est invalide, les extensions autorisées sont {{ types }}"
     * )
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity=Trick::class, inversedBy="trickImages")
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

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file): self
    {
        $this->file = $file;

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
