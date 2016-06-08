<?php

namespace GSB\Domain;

class Medicament 
{
    /**
     * Identifiant.
     *
     * @var integer
     */
    private $id;

    /**
     * Dépôt légal (nom déposé).
     *
     * @var string
     */
    private $depotLegal;

    /**
     * Nom commercial.
     *
     * @var string
     */
    private $nomCommercial;

    /**
     * Composition.
     *
     * @var string
     */
    private $composition;

    /**
     * Effets secondaires.
     *
     * @var string
     */
    private $effets;

    /**
     * Contre-indication.
     *
     * @var string
     */
    private $contreIndication;

    /**
     * Prix d'un échantillon.
     *
     * @var float
     */
    private $prixEchantillon;

    /**
     * Famille.
     *
     * @var \GSB\Domaine\Famille
     */
    private $famille;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDepotLegal() {
        return $this->depotLegal;
    }

    public function setDepotLegal($depotLegal) {
        $this->depotLegal = $depotLegal;
    }

    public function getNomCommercial() {
        return $this->nomCommercial;
    }

    public function setNomCommercial($nomCommercial) {
        $this->nomCommercial = $nomCommercial;
    }

    public function getComposition() {
        return $this->composition;
    }

    public function setComposition($composition) {
        $this->composition = $composition;
    }

    public function getEffets() {
        return $this->effets;
    }

    public function setEffets($effets) {
        $this->effets = $effets;
    }

    public function getContreIndication() {
        return $this->contreIndication;
    }

    public function setContreIndication($contreIndication) {
        $this->contreIndication = $contreIndication;
    }

    public function getPrixEchantillon() {
        return $this->prixEchantillon;
    }

    public function setPrixEchantillon($prixEchantillon) {
        $this->prixEchantillon = $prixEchantillon;
    }

    public function getFamille() {
        return $this->famille;
    }

    public function setFamille(Famille $famille) {
        $this->famille = $famille;
    }

    public function __toString()
    {
        return $this->getNomCommercial();
    }
}
