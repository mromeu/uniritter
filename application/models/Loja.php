<?php

class Application_Model_Loja
{
    private $dbTable;
    private $lastId;

    public function getDbTable() {
        $this->dbTable = new Application_Model_DbTable_Table(array('name' => 'loja'));

        return $this->dbTable;
    }

    public function setFiltros($conditions)
    {

        $where = array();

        foreach ($conditions as $key => $value) {

            switch ($key) {

                case 'loja_nome':

                    if(!empty($value)) {

                        $where[$key . ' LIKE ?'] = '%'. $value . '%';
                    }

                    break;

                case 'loja_endereco':

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
                ->order('loja_nome ASC');


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
                ->where('loja_id = ?', $id);

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

        $array['loja_cadastro'] = date('Y-m-d H:i:s');

        $id = $dbTable->insert($array);
        $this->setLastId($id);

        if($id){

            return true;
        }

        return false;
    }

    public function salvar($array, $id) {

        $dbTable = $this->getDbTable();

        $where = 'loja_id = ' . $id;

        $array['loja_update'] = date('Y-m-d H:i:s');

        $dbTable->update($array, $where);

        return true;
    }

    public function deletar($id, $param) {
        $dbTable = $this->getDbTable();

        $where = 'loja_id = ' . $id;

        $array['loja_update'] = date('Y-m-d H:i:s');
        $array['loja_ativo'] = $param;


        $dbTable->update($array, $where);
    }


}
