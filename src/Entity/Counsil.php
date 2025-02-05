<?php

namespace App\Entity;

use App\Repository\CounsilRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CounsilRepository::class)]
class Counsil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $attendee = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subject = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $attachment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getAttendee(): ?string
    {
        return $this->attendee;
    }

    public function setAttendee(?string $attendee): static
    {
        $this->attendee = $attendee;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getAttachment()
    {
        return $this->attachment;
    }

    public function setAttachment($attachment): static
    {
        $this->attachment = $attachment;

        return $this;
    }
}
