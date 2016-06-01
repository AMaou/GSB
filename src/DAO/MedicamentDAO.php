<?php

namespace GSB\DAO;

use GSB\Domain\Medicament;

class MedicamentDAO extends DAO
{
    /**
     * @var \GSB\DAO\FamilleDAO
     */
    private $familleDAO;

    public function setFamilleDAO(FamilleDAO $familleDAO) {
        $this->familleDAO = $familleDAO;
    }

    /**
     * Renvoie la liste de tous les médicaments, triés par nom commercial
     *
     * @return array La liste de tous les médicaments
     */
    public function findAll() {
        $sql = "select * from medicament order by nom_commercial";
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
        $sql = "select * from medicament where id_medicament=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucun médicament ne correspond à l'identifiant " . $id);
    }
	       public function findAllByNomFamille($nomCommercial,$familleID) {
        $sql = "select * from medicament join famille on medicament.id_famille = famille.id_famille where nom_commercial like ? and lib_famille like ? order by nom_commercial";
        $result = $this->getDb()->fetchAll($sql, array('%'.$nomCommercial.'%','%'.$familleID.'%'));
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $medicaments = array();
        foreach ($result as $row) {
            $medicamentId = $row['id_medicament'];
            $medicaments[$medicamentId] = $this->buildDomainObject($row);
        }
        return $medicaments;
    }

    /**
     * Crée un objet Medicament à partir d'une ligne de résultat BD
     *
     * @param array $row La ligne de résultat BD
     *
     * @return \GSB\Domain\Medicament
     */
    protected function buildDomainObject($row) {
        $medicament = new Medicament();
        $medicament->setId($row['id_medicament']);
        $medicament->setDepotLegal($row['depot_legal']);
        $medicament->setNomCommercial($row['nom_commercial']);
        $medicament->setComposition($row['composition']);
        $medicament->setEffets($row['effets']);
        $medicament->setContreIndication($row['contre_indication']);
        $medicament->setPrixEchantillon($row['prix_echantillon']);

        if (array_key_exists('id_famille', $row)) {
            // Trouve et définit la famille associée
            $familleId = $row['id_famille'];
            $famille = $this->familleDAO->find($familleId);
            $medicament->setFamille($famille);
        }
   
        if (array_key_exists('id_medicament.med_id_medicament', $row)) {
            // Trouve et définit l'interaction associée
            $InteractionId = $row['id_medicament.med_id_medicament'];
            $interaction = $this->interactionDAO->find($interactionId);
            $interaction->setInteraction($interaction);
        }
        return $medicament;
    }
}