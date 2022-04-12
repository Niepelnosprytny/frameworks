<?php

namespace App\Entity;

use App\Repository\VoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoteRepository::class)]
class Vote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $chosenAnswer;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'votes')]
    private $user_id;

    #[ORM\ManyToMany(targetEntity: Probe::class, inversedBy: 'votes')]
    private $question_id;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
        $this->question_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChosenAnswer(): ?int
    {
        return $this->chosenAnswer;
    }

    public function setChosenAnswer(int $chosenAnswer): self
    {
        $this->chosenAnswer = $chosenAnswer;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id[] = $userId;
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        $this->user_id->removeElement($userId);

        return $this;
    }

    /**
     * @return Collection<int, Probe>
     */
    public function getQuestionId(): Collection
    {
        return $this->question_id;
    }

    public function addQuestionId(Probe $questionId): self
    {
        if (!$this->question_id->contains($questionId)) {
            $this->question_id[] = $questionId;
        }

        return $this;
    }

    public function removeQuestionId(Probe $questionId): self
    {
        $this->question_id->removeElement($questionId);

        return $this;
    }
}
