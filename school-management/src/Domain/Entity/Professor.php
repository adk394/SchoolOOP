<?php

namespace SchoolManagement\Domain\Entity;

use SchoolManagement\Domain\ValueObject\Id;
use SchoolManagement\Domain\ValueObject\Nom;
use SchoolManagement\Domain\ValueObject\Email;

// comentali per la entitat professor
class Professor
{
    private Id $id;
    private Nom $nom;
    private Email $email;
    private array $assignatures = [];

    public function __construct(Id $id, Nom $nom, Email $email)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getNom(): Nom
    {
        return $this->nom;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function assignar(Assignatura $assignatura): void
    {
        // comentali per evitar assignacio duplicada
        foreach ($this->assignatures as $a) {
            if ($a->getId()->equals($assignatura->getId())) {
                throw new \Exception("Ja assignat a aquesta assignatura");
            }
        }
        $this->assignatures[] = $assignatura;
    }

    public function getAssignatures(): array
    {
        return $this->assignatures;
    }
}