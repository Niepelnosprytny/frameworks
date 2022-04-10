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

    #[ORM\ManyToOne(targetEntity: Probe::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $question_id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $user_id;

    #[ORM\Column(type: 'integer')]
    private $chosen_answer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionId(): ?Probe
    {
        return $this->question_id;
    }

    public function setQuestionId(?Probe $question_id): self
    {
        $this->question_id = $question_id;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getChosenAnswer(): ?int
    {
        return $this->answer_1_votes;
    }

    public function setChosenAnswer(int $answer_1_votes): self
    {
        $this->answer_1_votes = $answer_1_votes;

        return $this;
    }
}
