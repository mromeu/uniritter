<?php

class Application_Model_Cliente
{
    private $dbTable;
    private $lastId;

    public function getDbTable() {
        $this->dbTable = new Application_Model_DbTable_Table(array('name' => 'cliente'));

        return $this->dbTable;
    }

    public function setFiltros($conditions)
    {

        $where = array();

        foreach ($conditions as $key => $value) {

            switch ($key) {

                case 'cliente_nome':

                    if(!empty($value)) {

                        $where[$key . ' LIKE ?'] = '%'. $value . '%';
                    }

                    break;

                case 'cliente_email':

                    if(!empty($value)) {

                        $where[$key . ' LIKE ?'] = '%'. $value . '%';
                    }

                    break;

                case 'cliente_login':

                    if(!empty($value)) {

                        $where[$key . ' LIKE ?'] = '%'. $value . '%';
                    }

                    break;

                case 'cadastroi':

                    if(!empty($value)) {

                        $where['cliente_cadastro >= ?'] = $value;
                    }

                    break;

                case 'cadastrof':

                    if(!empty($value)) {

                        $where['cliente_cadastro <= ?'] = $value;
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
                ->order('cliente_nome ASC');


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
                ->where('cliente_id = ?', $id);

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

        $array['cliente_cadastro'] = date('Y-m-d H:i:s');
        $array['cliente_senha'] = md5($array['cliente_senha']);

        $id = $dbTable->insert($array);
        $this->setLastId($id);

        if($id){

            return true;
        }

        return false;
    }

    public function salvar($array, $id) {

        $dbTable = $this->getDbTable();

        $where = 'cliente_id = ' . $id;

        $array['cliente_update'] = date('Y-m-d H:i:s');
        $array['cliente_senha'] = md5($array['cliente_senha']);

        $dbTable->update($array, $where);

        return true;
    }

    public function deletar($id, $param) {
        $dbTable = $this->getDbTable();

        $where = 'cliente_id = ' . $id;

        $array['cliente_ativo'] = $param;
        $array['cliente_update'] = date('Y-m-d H:i:s');

        $dbTable->update($array, $where);
    }

}
