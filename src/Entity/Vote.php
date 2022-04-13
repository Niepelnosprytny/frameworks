<?php

namespace App\Entity;

use App\Repository\VoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoteRepository::class)]
class Vote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $chosen_answer;

    #[ORM\Column(type: 'integer')]
    private $question_id;

    #[ORM\Column(type: 'integer')]
    private $user_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChosenAnswer(): ?int
    {
        return $this->chosen_answer;
    }

    public function setChosenAnswer(int $chosen_answer): self
    {
        $this->chosen_answer = $chosen_answer;

        return $this;
    }

    public function getQuestionId(): ?int
    {
        return $this->question_id;
    }

    public function setQuestionId(int $question_id): self
    {
        $this->question_id = $question_id;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
