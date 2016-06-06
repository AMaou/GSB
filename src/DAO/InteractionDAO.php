<?php

namespace GSB\DAO;

use GSB\Domain\Interaction;

class InteractionDAO extends DAO
{
   
    private $medicamentDAO;

    public function setMedicamentDAO(MedicamentDAO $medicamentDAO) {
        $this->medicamentDAO = $medicamentDAO;
    }

    /**
     * Renvoie la liste de tous les médicaments, triés par nom commercial
     *
     * @return array La liste de tous les médicaments
     */
    public function findAll() {
        $sql = "select * from medicament Join interagir on medicament.id_medicament = interagir.id_medicament order by nom_commercial";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $medicaments = array();
        foreach ($result as $row) {
            $medicamentId = $row['id_medicament'];
            $medicaments[$medicamentId] = $this->buildDomainObject($row);
        }
        return $medicaments;
    }

    /**
     * Renvoie la liste de tous les médicaments appartenant à une famille
     *
     * @param integer $FamilleDd L'identifiant de la famille
     *
     * @return array La liste des médicaments
     */
    public function findAllByFamille($familleId) {
        $sql = "select * from medicament where id_famille=? order by nom_commercial";
        $result = $this->getDb()->fetchAll($sql, array($familleId));
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $medicaments = array();
        foreach ($result as $row) {
            $medicamentId = $row['id_medicament'];
            $medicaments[$medicamentId] = $this->buildDomainObject($row);
        }
        return $medicaments;
    }

    /**
     * Renvoie un médicament à partir de son identifiant
     *
     * @param integer $id L'identifiant du médicament
     *
     * @return \GSB\Domain\Medicament|Lève un exception si aucun médicament ne correspond
     */
    public function find($id) {
        $sql = "select * from interagir where med_id_medicament=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucun médicament ne correspond à l'identifiant " . $id);
    }
	
    

    public function save(Interaction $interaction) {

            $interactionData = array(

            'id_medicament' => $interaction->getId(),

            'med_id_medicament' => $interaction->getMedId(),

            );
            
        $this->getDb()->insert('interagir', $interactionData);
        
            $interactionData = array(

            'id_medicament' => $interaction->getMedId(),

            'med_id_medicament' => $interaction->getId(),

            );
          
           $this->getDb()->insert('interagir', $interactionData);
        

    }



    public function delete($id,$medId) {

       

        $this->getDb()->delete('interagir', array('id_medicament' => $id,'med_id_medicament' => $medId));
        $this->getDb()->delete('interagir', array('id_medicament' => $medId,'med_id_medicament' => $id));

    }



    /**
     * Crée un objet Medicament à partir d'une ligne de résultat BD
     *
     * @param array $row La ligne de résultat BD
     *
     * @return \GSB\Domain\Medicament
     */
    protected function buildDomainObject($row) {
        $interaction = new Interaction();
        $interaction->setId($row['id_medicament']);
        $interaction->setMedId($row['med_id_medicament']);
    

        if (array_key_exists('id_medicament.med_id_medicament', $row)) {
            // Trouve et définit l'interaction associée
            $InteractionId = $row['id_medicament.med_id_medicament'];
            $interaction = $this->interactionDAO->find($interactionId);
            $interaction->setInteraction($interaction);
        }
        return $interaction;
    }
}