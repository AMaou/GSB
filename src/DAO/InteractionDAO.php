<?php

namespace GSB\DAO;

use GSB\Domain\Interaction;

class InteractionDAO extends DAO
{

    /**
     * @var \GSB\DAO\MedicamentDAO
     */
    private $medicamentDAO;

    public function setMedicamentDAO(MedicamentDAO $medicamentDAO) {
        $this->medicamentDAO = $medicamentDAO;
    }

    /**
     * Renvoie la liste de toutes intéractions pour un médicament
     *
     * @return array La liste de toutes les intéractions
     */
    public function findAllById($id) {
        $sql = "select * from interagir where id_medicament=? OR med_id_medicament=?";
        $result = $this->getDb()->fetchAll($sql,array($id,$id));

        // Convertit les résultats de requête en tableau d'objets du domaine
        $interactions = array();
        foreach ($result as $row) {
            $interactionId = $row['med_id_medicament'];
            if($interactionId != $id)
                $interactions[$interactionId] = $this->buildDomainObject($row);
        }
        return $interactions;
    }

    /**
     * Crée un objet Interaction à partir d'une ligne de résultat BD
     *
     * @param array $row La ligne de résultat BD
     *
     * @return \GSB\Domain\Interaction
     */
    protected function buildDomainObject($row) {
        $interaction = new Interaction();
        if (array_key_exists('id_medicament', $row)) {
            // Trouve et définit la medicament associée
            $medicamentId = $row['id_medicament'];
            $medicament = $this->medicamentDAO->find($medicamentId);
            $interaction->setMedicament1($medicament);
        }
        if (array_key_exists('med_id_medicament', $row)) {
            // Trouve et définit la medicament associée
            $medicamentId = $row['med_id_medicament'];
            $medicament = $this->medicamentDAO->find($medicamentId);
            $interaction->setMedicament2($medicament);
        }
        return $interaction;
    }

    /**
     * Sauvegarde une interaction
     *
     * @param \GSB\Domain\Interaction $interaction
     */
    public function save(Interaction $interaction)
    {
            $this->getDb()->insert('interagir',  array ('id_medicament' => $interaction->getMedicament1()->getId(), 'med_id_medicament' => $interaction->getMedicament2()));
            $this->getDb()->insert('interagir',  array ('id_medicament' => $interaction->getMedicament2(), 'med_id_medicament' => $interaction->getMedicament1()->getId()));
    }

    /**
     * Supprime une intéraction
     *
     * @param integer $id L'id de l'animal
     */
    public function delete($id,$id2)
    {
        // Delete the article
        $this->getDb()->delete('interagir', array('id_medicament' => $id,'med_id_medicament' => $id2));
        $this->getDb()->delete('interagir', array('id_medicament' => $id2,'med_id_medicament' => $id));
    }

}
