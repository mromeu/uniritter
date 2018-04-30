<?php

class Application_Model_Cargo
{

    private $dbTable;
    private $lastId;

    public function getDbTable() {
        $this->dbTable = new Application_Model_DbTable_Table(array('name' => 'cargo'));

        return $this->dbTable;
    }

    // Recebe como parâmetro um array com nomes dos campos em suas chaves e parametros de pesquisa nos valores.
    public function setFiltros($conditions)
    {
        //inicia a variável $where
        $where = array();

        // Passa por pelo array definindo a chave na variável $key e o valor na variável $value.
        foreach ($conditions as $key => $value) {

            // O switch da chave fará com que script de pesquisa seja preparado de acordo com o tipo do campo no banco de dados.
            switch ($key) {

                case 'cargo_ativo':

                    // Prepara o script para a pesquisa de um número inteiro
                    $where[$key . ' = ?'] = $value;

                    break;

                default:

                    // O default do switch prepara o script para busca de uma string no banco, caso a variável $value não esteja vazia.
                    if(!empty($value)) {

                        $where[$key . ' LIKE ?'] = '%'. $value . '%';
                    }
                    break;
            }
        }

        // Retorna a variável $where com todas os scripts de pesquisa formatados de acordo com o framework
        return $where;
    }

    // A função pode receber ou não um array com as condições de pesquisa como parâmetro.
    public function fetchAll($conditions = NULL) {

        // Prepara um script de pesquisa no banco ordenando os resultados pelo campo cargo_nome.
        $select = $this->getDbTable()->select()
                ->setIntegrityCheck(FALSE)
                ->from(array('x' => $this->getDbTable()->getName()))
                ->order('cargo_nome ASC');

        if(!empty($conditions)) {

            // Caro não esteja vazio, o array armazenado na variável $conditions será enviado para uma função de tratamento de dados.
            $where = $this->setFiltros($conditions);

            foreach($where as $key => $value) {

                // Adiciona ao script de pesquisa no banco os critérios tratados pela função anterior.
                $select->where($key, $value);
            }
        }

        // Armazena na variável $rowSet o resultado da consulta no banco de dados, de acordo com as condições enviadas como parâmetro.
        $rowSet = $this->getDbTable()->fetchAll($select);

        // Retorna o resultado da consulta.
        return $rowSet;
    }

    public function find($id) {

        // A função precisa receber um id para realizar a busca do registro no banco de dados, caso contrário, retornará falso.
        if(!empty($id)) {
            // Prepara um script de pesquisa no banco de dados pelo campo que armazena o id recebido como parâmetro.
            $select = $this->getDbTable()->select()
                ->setIntegrityCheck(FALSE)
                ->from(array('x' => $this->getDbTable()->getName()))
                ->where('cargo_id = ?', $id);

            // Armazena na variável $rowSet o resultado da consulta no banco de dados, de acordo com as condições enviadas como parâmetro.
            $rowSet = $this->getDbTable()->fetchAll($select);

            // Retorna o resultado da consulta.
            return $rowSet[0];

        }

        return false;
    }

    public function setLastId($id) {
        // Armazena na variável lastId o último id cadastrado na tabela do banco de dados.
        $this->lastId = $id;
    }

    public function getLastId() {
        // Retorna o último id cadastrado na tabela do banco de dados.
        return $this->lastId;
    }

    public function novo($array) {
        // Armazena uma entidade da tabela no banco na variável $dbTable
        $dbTable = $this->getDbTable();

        // Adiciona ao recebido como parâmetro uma chave com a data e hora local, que será colocado no campo referente na tabela
        $array['cargo_cadastro'] = date('Y-m-d H:i:s');

        // Armazena na variável id o resultado da inserção dos dados na tabela
        $id = $dbTable->insert($array);

        // Envia o resultado da inserção no campo para a função setLastId
        $this->setLastId($id);

        if($id){
            // Caso a inserção tenha sucesso ele retorna verdadeiro para o Controller.
            return true;
        }

        // Caso a inserção não tenha sucesso ele retorna falso para o Controller.
        return false;
    }

    public function salvar($array, $id) {

        // Armazena uma entidade da tabela no banco na variável $dbTable
        $dbTable = $this->getDbTable();

        // Adiciona ao array recebido como parâmetro o id de qual registro será alterado
        $where = 'cargo_id = ' . $id;

        // Adiciona ao array recebido como parâmetro uma chave com a data e hora local, que será colocado no campo referente na tabela
        $array['cargo_update'] = date('Y-m-d H:i:s');

        // Efetua a alteração do registro enviando o array como parâmetro na variável $where o id do registro que será alterado.
        $dbTable->update($array, $where);

        return true;
    }

    public function deletar($id, $param) {
        // Armazena uma entidade da tabela no banco na variável $dbTable
        $dbTable = $this->getDbTable();

        // Adiciona ao array recebido como parâmetro o id de qual registro será alterado
        $where = 'cargo_id = ' . $id;

        // Adiciona ao array recebido como parâmetro o novo status do registro
        $array['cargo_ativo'] = $param;

        // Adiciona ao array recebido como parâmetro uma chave com a data e hora local, que será colocado no campo referente na tabela
        $array['cargo_update'] = date('Y-m-d H:i:s');

        // Efetua a alteração do registro enviando o array como parâmetro na variável $where o id do registro que será alterado.
        $dbTable->update($array, $where);
    }

}