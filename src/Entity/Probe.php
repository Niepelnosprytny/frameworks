<?php

namespace App\Entity;

use App\Repository\ProbeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProbeRepository::class)]
class Probe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $question;

    #[ORM\Column(type: 'string', length: 255)]
    private $answer1;

    #[ORM\Column(type: 'string', length: 255)]
    private $answer2;

    #[ORM\Column(type: 'string', length: 255)]
    private $answer3;

    #[ORM\Column(type: 'boolean')]
    private $enabled;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer1(): ?string
    {
        return $this->answer1;
    }

    public function setAnswer1(string $answer1): self
    {
        $this->answer1 = $answer1;

        return $this;
    }

    public function getAnswer2(): ?string
    {
        return $this->answer2;
    }

    public function setAnswer2(string $answer2): self
    {
        $this->answer2 = $answer2;

        return $this;
    }

    public function getAnswer3(): ?string
    {
        return $this->answer3;
    }

    public function setAnswer3(string $answer3): self
    {
        $this->answer3 = $answer3;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }
}
