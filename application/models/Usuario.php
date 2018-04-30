<?php

class Application_Model_Usuario
{
    private $dbTable;
    private $lastId;

    public function getDbTable() {
        $this->dbTable = new Application_Model_DbTable_Table(array('name' => 'usuario'));

        return $this->dbTable;
    }

    public function getLoginAdapter()
    {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        $authAdapter->setTableName($this->getDbTable()->getName())
                    ->setIdentityColumn('usuario_login')
                    ->setCredentialColumn('usuario_senha');
        return $authAdapter;
    }

    public function login($login, $senha)
    {

        if(!empty($senha)) {
          $senha = md5($senha);
        }

        $adapter = $this->getLoginAdapter();
        $adapter->setIdentity($login);
        $adapter->setCredential($senha);
        $auth    = Zend_Auth::getInstance();

        $result  = $auth->authenticate($adapter);

        if($result->isValid()) {

            $id = $adapter->getResultRowObject('usuario_id');
            Zend_Auth::getInstance()->getStorage()->write($id);

            $cargo = $adapter->getResultRowObject('fk_cargo_id');
            Zend_Auth::getInstance()->getStorage()->write($cargo);

            $session = new Zend_Session_Namespace('login');
            $session->setExpirationSeconds( 60000 );

            $session->usuario_id = $id->usuario_id;
            $session->usuario_cargo = $cargo->fk_cargo_id;
            return true;
        }
        return false;
    }

    public function setFiltros($conditions)
    {

        $where = array();

        foreach ($conditions as $key => $value) {

            switch ($key) {

                case 'usuario_nome':

                    if(!empty($value)) {

                        $where[$key . ' LIKE ?'] = '%'. $value . '%';
                    }

                    break;

                case 'usuario_email':

                    if(!empty($value)) {

                        $where[$key . ' LIKE ?'] = '%'. $value . '%';
                    }

                    break;

                case 'usuario_login':

                    if(!empty($value)) {

                        $where[$key . ' LIKE ?'] = '%'. $value . '%';
                    }

                    break;

                case 'cadastroi':

                    if(!empty($value)) {

                        $where['usuario_cadastro >= ?'] = $value;
                    }

                    break;

                case 'cadastrof':

                    if(!empty($value)) {

                        $where['usuario_cadastro <= ?'] = $value;
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
                ->order('usuario_nome ASC');


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
                ->where('usuario_id = ?', $id);

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

        $array['usuario_cadastro'] = date('Y-m-d H:i:s');
        $array['usuario_senha'] = md5($array['usuario_senha']);

        $id = $dbTable->insert($array);
        $this->setLastId($id);

        if($id){

            return true;
        }

        return false;
    }

    public function salvar($array, $id) {

        $dbTable = $this->getDbTable();

        $where = 'usuario_id = ' . $id;

        $array['usuario_update'] = date('Y-m-d H:i:s');

        $dbTable->update($array, $where);

        return true;
    }

    public function deletar($id, $param) {
        $dbTable = $this->getDbTable();

        $where = 'usuario_id = ' . $id;

        $array['usuario_ativo'] = $param;
        $array['usuario_update'] = date('Y-m-d H:i:s');

        $dbTable->update($array, $where);
    }

}
