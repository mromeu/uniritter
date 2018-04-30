<?php

class Application_Model_Produto
{
    private $dbTable;
    private $lastId;

    public function getDbTable() {
        $this->dbTable = new Application_Model_DbTable_Table(array('name' => 'produto'));

        return $this->dbTable;
    }

    public function setFiltros($conditions)
    {

        $where = array();

        foreach ($conditions as $key => $value) {

            switch ($key) {

                case 'produto_nome':

                    if(!empty($value)) {

                        $where[$key . ' LIKE ?'] = '%'. $value . '%';
                    }

                    break;

              case 'estoque_minimo':

                      $where['estoque_quantidade > ?'] = $value;

                  break;

                case 'valori':

                    if(!empty($value)) {

                        $where['produto_valor >= ?'] = $value;
                    }

                    break;

                case 'valorf':

                    if(!empty($value)) {

                        $where['produto_valor <= ?'] = $value;
                    }

                    break;


                case 'cadastroi':

                    if(!empty($value)) {

                        $where['valor_cadastro >= ?'] = $value;
                    }

                    break;

                case 'cadastrof':

                    if(!empty($value)) {

                        $where['valor_cadastro <= ?'] = $value;
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
                ->joinLeft(array('e' => 'estoque'),  'e.fk_produto_id = x.produto_id',array('estoque_quantidade'))
                ->order('produto_nome ASC');


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
                ->where('produto_id = ?', $id);

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

        $array['produto_cadastro'] = date('Y-m-d H:i:s');

        $id = $dbTable->insert($array);
        $this->setLastId($id);

        if($id){

            return true;
        }

        return false;
    }

    public function salvar($array, $id) {

        $dbTable = $this->getDbTable();

        $where = 'produto_id = ' . $id;

        $array['produto_update'] = date('Y-m-d H:i:s');

        $dbTable->update($array, $where);

        return true;
    }

    public function deletar($id, $param) {
        $dbTable = $this->getDbTable();

        $where = 'produto_id = ' . $id;

        $array['produto_update'] = date('Y-m-d H:i:s');
        $array['produto_ativo'] = $param;


        $dbTable->update($array, $where);
    }


}
