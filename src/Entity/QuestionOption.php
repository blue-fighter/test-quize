<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
#[ORM\Entity(repositoryClass: QuestionRepository::class)]
#[ORM\Table(name: "question_options")]
class QuestionOption
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;
    #[ORM\Column(length: 255)]
    private ?string $text;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isCorrectAnswer;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'questions')]
    private Question $question;

    public function __construct(
        ?string $text,
        ?string $isCorrectAnswer,
        DateTime $date
    )
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function getIsCorrectAnswer(): ?bool
    {
        return $this->isCorrectAnswer;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }
}