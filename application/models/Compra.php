<?php

class Application_Model_Compra
{

    private $dbTable;
    private $lastId;

    public function getDbTable() {
        $this->dbTable = new Application_Model_DbTable_Table(array('name' => 'compra'));

        return $this->dbTable;
    }

    public function setFiltros($conditions)
    {

        $where = array();

        foreach ($conditions as $key => $value) {

            switch ($key) {

                case 'compra_ativo':

                    $where[$key . ' = ?'] = $value;

                    break;

                default:

                    if(!empty($value)) {

                        $where[$key . ' LIKE ?'] = '%'. $value . '%';
                    }
                    break;
            }
        }

        return $where;
    }

    public function fetchAll($conditions = NULL) {
        $select = $this->getDbTable()->select()
                ->setIntegrityCheck(FALSE)
                ->from(array('x' => $this->getDbTable()->getName()))
                ->order('compra_cadastro ASC');


        if(!empty($conditions)) {

            $where = $this->setFiltros($conditions);

            foreach($where as $key => $value) {

                $select->where($key, $value);
            }
        }

        $rowSet = $this->getDbTable()->fetchAll($select);

        return $rowSet;
    }


    public function find($id) {
        $select = $this->getDbTable()->select()
                ->setIntegrityCheck(FALSE)
                ->from(array('x' => $this->getDbTable()->getName()))
                ->where('compra_id = ?', $id);

        $rowSet = $this->getDbTable()->fetchAll($select);

        return $rowSet[0];
    }

    public function setLastId($id) {
        $this->lastId = $id;
    }

    public function getLastId() {
        return $this->lastId;
    }

    public function novo($array) {
        $dbTable = $this->getDbTable();

        $array['compra_cadastro'] = date('Y-m-d H:i:s');

        $modelEstoque = new Application_Model_Estoque();
        $obj = $modelEstoque->fetchAll(array('fk_produto_id' => $array['fk_produto_id']));

        if(count($obj) > 0) {
            $newEstoqueQtd = $obj[0]['estoque_quantidade'] - $array['compra_quantidade'];
            $modelEstoque->salvar(array('estoque_quantidade' => $newEstoqueQtd), $obj[0]['estoque_id'], $usuario);

            $id = $dbTable->insert($array);
            $this->setLastId($id);

            return true;
        }

        return false;
    }

    public function salvar($array, $id) {

        $dbTable = $this->getDbTable();

        $where = 'compra_id = ' . $id;

        $array['compra_id_update'] = date('Y-m-d H:i:s');

        $dbTable->update($array, $where);

        return true;
    }

    public function deletar($id, $param) {
        $dbTable = $this->getDbTable();

        $where = 'compra_id = ' . $id;

        $array['compra_ativo'] = $param;
        $array['compra_update'] = date('Y-m-d H:i:s');

        $dbTable->update($array, $where);
    }


}
