<?php

namespace GSB\Domain;

class Interaction
{
    /**
     * Medicament 1.
     *
     * @var \GSB\Domain\Medicament
     */
    private $medicament1;

    /**
     * Medicament 2.
     *
     * @var \GSB\Domain\Medicament
     */
    private $medicament2;

    /**
     * @return \GSB\Domain\Medicament
     */
    public function getMedicament1()
    {
        return $this->medicament1;
    }

    /**
     * @param \GSB\Domain\Medicament $medicament1
     */
    public function setMedicament1( $medicament1)
    {
        $this->medicament1 = $medicament1;
    }

    /**
     * @return \GSB\Domain\Medicament
     */
    public function getMedicament2()
    {
        return $this->medicament2;
    }

    /**
     * @param \GSB\Domain\Medicament $medicament2
     */
    public function setMedicament2($medicament2)
    {
        $this->medicament2 = $medicament2;
    }


}