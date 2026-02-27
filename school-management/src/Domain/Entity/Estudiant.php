<?php

namespace SchoolManagement\Domain\Entity;

use SchoolManagement\Domain\ValueObject\Id;
use SchoolManagement\Domain\ValueObject\Nom;
use SchoolManagement\Domain\ValueObject\Email;

// comentali per la entitat estudiant
class Estudiant
{
    private Id $id;
    private Nom $nom;
    private Email $email;
    private array $cursos = [];

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

    public function matricular(Curs $curs): void
    {
        // comentali per evitar matriculacio duplicada
        foreach ($this->cursos as $c) {
            if ($c->getId()->equals($curs->getId())) {
                throw new \Exception("Ja matriculat en aquest curs");
            }
        }
        $this->cursos[] = $curs;
    }

    public function getCursos(): array
    {
        return $this->cursos;
    }
}