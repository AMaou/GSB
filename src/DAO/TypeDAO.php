<?php

namespace GSB\DAO;

use GSB\Domain\Type;

class TypeDAO extends DAO
{
    /**
     * Renvoie la liste de tous les types, triées par libellé
     *
     * @return array La liste de tous les types
     */
    public function findAll() {
        $sql = "select * from type_praticien order by lib_type_praticien";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $types = array();
        foreach ($result as $row) {
            $typeId = $row['id_type_praticien'];
            $types[$typeId] = $this->buildDomainObject($row);
        }
        return $types;
    }

    /**
     * Renvoie un type à partir de son identifiant
     *
     * @param integer $id L'identifiant du type
     *
     * @return \GSB\Domain\Type|Lève une exception si aucun Type  ne correspond
     */
    public function find($id) {
        $sql = "select * from type_praticien where id_type_praticien=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucun type ne correspond à l'identifiant " . $id);
    }

    /**
     * Crée un objet Type à partir d'une ligne de résultat BD
     *
     * @param array $row La ligne de résultat BD
     *
     * @return \GSB\Domain\Type
     */
    protected function buildDomainObject($row) {
        $type = new Type();
        $type->setId($row['id_type_praticien']);
        $type->setLibelle($row['lib_type_praticien']);
        return $type;
    }
}