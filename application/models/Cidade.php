<?php

class Application_Model_Cidade
{
    private $dbTable;
    private $lastId;

    public function getDbTable() {
        $this->dbTable = new Application_Model_DbTable_Table(array('name' => 'cidade'));

        return $this->dbTable;
    }

    public function setFiltros($conditions)
    {

        $where = array();

        foreach ($conditions as $key => $value) {

            switch ($key) {

                case 'cidade_nome':

                    if(!empty($value)) {

                        $where[$key . ' LIKE ?'] = '%'. $value . '%';
                    }

                    break;

                default:

                    if($value != "") {

                        $where[$key . ' = ?'] = $value;
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
                ->order('cidade_nome ASC');


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
                ->where('cidade_id = ?', $id);

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

        $array['cidade_cadastro'] = date('Y-m-d H:i:s');
        $array['fk_usuario_id_cad'] = $usuario;


        $id = $dbTable->insert($array);
        $this->setLastId($id);

        if($id){

            return true;
        }

        return false;
    }

    public function salvar($array, $id) {

        $dbTable = $this->getDbTable();

        $where = 'cidade_id = ' . $id;
        $array['cidade_update'] = date('Y-m-d H:i:s');
        $array['fk_usuario_id_upd'] = $usuario;

        $dbTable->update($array, $where);

        return true;
    }

    public function deletar($id, $param) {
        $dbTable = $this->getDbTable();

        $where = 'cidade_id = ' . $id;
        $array['cidade_ativo'] = $param;
        $array['cidade_update'] = date('Y-m-d H:i:s');
        $array['fk_usuario_id_upd'] = $usuario;
        $dbTable->update($array, $where);
    }


}
