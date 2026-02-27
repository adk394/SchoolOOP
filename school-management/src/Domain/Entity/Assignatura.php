<?php

namespace SchoolManagement\Domain\Entity;

use SchoolManagement\Domain\ValueObject\Id;
use SchoolManagement\Domain\ValueObject\Nom;

// comentali per la entitat assignatura
class Assignatura
{
    private Id $id;
    private Nom $nom;
    private ?Professor $professor = null;

    public function __construct(Id $id, Nom $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getNom(): Nom
    {
        return $this->nom;
    }

    public function assignarProfessor(Professor $professor): void
    {
        $this->professor = $professor;
    }

    public function getProfessor(): ?Professor
    {
        return $this->professor;
    }
}