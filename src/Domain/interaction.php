<?php

namespace GSB\Domain;

class Interaction 
{
    /**
     * Identifiant.
     *
     * @var integer
     */
    private $id;

  
    private $medId;
    
    private $medicament;

    public function getMedicament() {
        return $this->medicament;
    }

    public function setMedicament($medicament) {
        $this->medicament = $medicament;
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getMedId() {
        return $this->medId;
    }

    public function setMedId($medId) {
        $this->medId = $medId;
    }


}
