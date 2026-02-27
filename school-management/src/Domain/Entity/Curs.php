<?php

namespace SchoolManagement\Domain\Entity;

use SchoolManagement\Domain\ValueObject\Id;
use SchoolManagement\Domain\ValueObject\Nom;

// comentali per la entitat curs
class Curs
{
    private Id $id;
    private Nom $nom;
    private array $estudiants = [];
    private array $assignatures = [];

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

    public function afegirEstudiant(Estudiant $estudiant): void
    {
        $this->estudiants[] = $estudiant;
    }

    public function afegirAssignatura(Assignatura $assignatura): void
    {
        $this->assignatures[] = $assignatura;
    }

    public function getEstudiants(): array
    {
        return $this->estudiants;
    }

    public function getAssignatures(): array
    {
        return $this->assignatures;
    }
}