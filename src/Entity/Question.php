<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
#[ORM\Table(name: "questions")]
class Question
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $text;

    #[ORM\OneToMany(targetEntity: QuestionOption::class, mappedBy: 'question')]
    private Collection $options;

    /**
     * @param string|null $text
     */
    public function __construct(
        ?string $text,
    ) {
        $this->text = $text;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function getOptions(): Collection
    {
        return $this->options;
    }
}