<?php

namespace GSB\Domain;

class Famille 
{
    /**
     * Identifiant.
     *
     * @var integer
     */
    private $id;

    /**
     * Libelle.
     *
     * @var string
     */
    private $libelle;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }
}
