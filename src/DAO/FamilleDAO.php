<?php

namespace GSB\DAO;

use GSB\Domain\Famille;

class FamilleDAO extends DAO
{
    /**
     * Renvoie la liste de toutes les familles, triées par libellé
     *
     * @return array La liste de toutes les familles
     */
    public function findAll() {
        $sql = "select * from famille order by lib_famille";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $familles = array();
        foreach ($result as $row) {
            $familleId = $row['id_famille'];
            $familles[$familleId] = $this->buildDomainObject($row);
        }
        return $familles;
    }

    /**
     * Renvoie une famille à partir de son identifiant
     *
     * @param integer $id L'identifiant de la famille
     *
     * @return \GSB\Domain\Famille|Lève un exception si aucune famille ne correspond
     */
    public function find($id) {
        $sql = "select * from famille where id_famille=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucune famille ne correspond à l'identifiant " . $id);
    }
	

    /**
     * Crée un objet Famille à partir d'une ligne de résultat BD
     *
     * @param array $row La ligne de résultat BD
     *
     * @return \GSB\Domain\Famille
     */
    protected function buildDomainObject($row) {
        $famille = new Famille();
        $famille->setId($row['id_famille']);
        $famille->setLibelle($row['lib_famille']);
        return $famille;
    }
}