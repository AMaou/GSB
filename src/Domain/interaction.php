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
