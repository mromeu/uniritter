<?php


class Zend_Funcoes {


    public function fDataInt($dData)
    {
        if($dData != '0000-00-00' and $dData != NULL and $dData != ""){
            $sData = implode("-",array_reverse(explode("/",$dData)));
            return $sData;
        }

        return null;
    }

    public function fDataBr($dData)
    {
        if($dData != NULL and $dData != ""){
            $sData = implode("/",array_reverse(explode("-",$dData)));
            return $sData;
        }

        return null;
    }

    public function fDateTime($dData)
    {
        if($dData != '0000-00-00' and $dData != NULL and $dData != ""){
            $sData = date('d/m/Y  H:i:s', strtotime($dData));

            return $sData;
        }

        return null;
    }

    public function fMoedaInt($mValor)
    {
        if($mValor != NULL){
            $source = array('.', ',');
            $replace = array('', '.');
            $mNewValor = str_replace($source, $replace, $mValor); //remove os pontos e substitui a virgula pelo ponto

            return $mNewValor;
        }

        return null;
    }

    public function fMoedaBr($mValor)
    {
        if($mValor != NULL){
            $mNewValor =  number_format($mValor, 2, ',', '.');

            return $mNewValor;
        }

        return null;
    }

    public function getMeses($id = null)
    {
      $array = [
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro',
      ];

      if($id != null) {

        return $array[$id];
      } else {

        return $array;
      }
    }

    public function DateTime($formato = null, $intervalo = null, $operacao = null)
    {
        if(!is_null($formato)) {

            $data = new DateTime();

            if(!is_null($intervalo)){
                switch ($operacao) {
                    case 'add':
                        # code...
                        $data->add(new DateInterval('P'.$intervalo. 'D'));
                        break;
                    case 'sub':
                        # code...
                        $data->sub(new DateInterval('P'.$intervalo. 'D'));
                        break;
                }
            }

            return $data->format($formato);
        }

        return false;
    }

    public function firstDay($formato = null)
    {
        if(!is_null($formato)){

            return date($formato,strtotime("first day of this month"));
        }
    }

    public function lastDay($formato = null)
    {
        if(!is_null($formato)){

            return date($formato,strtotime("last day of this month"));
        }
    }

    /*
     *
     * Funções de Sistema
     *
     */

    public function Logado()
    {
        $session = new Zend_Session_Namespace('login');

        if (Zend_Auth::getInstance()->hasIdentity()) {
            return $session->usuario_id;

        }

        return false;
    }

    public function ColsInfo($mapper = null, $view = false)
    {

        if($mapper != null){

            if(!$view) {
                return $mapper->getDbTable()->info(Zend_Db_Table_Abstract::METADATA);
            } else {
                return $mapper->getViewTable()->info(Zend_Db_Table_Abstract::METADATA);
            }
        }

        return false;
    }

    public function FormataInputsBd($cols, $inputs = null)
    {
        if($cols != null){
            foreach($cols as $col => $info){
                $colinfo[$info['COLUMN_NAME']] = $info['DATA_TYPE'];
            }

            foreach($inputs as $input => $val){
                foreach ($colinfo as $colnome => $coltipo){
                    if($colnome == $input){
                        switch ($coltipo) {
                            case 'date':
                                $array[$colnome] = $this->fDataInt($val);

                                break;
                            case 'decimal':
                                $array[$colnome] = $this->fMoedaInt($val);

                                break;
                            default:
                                $array[$colnome] = $val;

                                break;
                        }
                    }
                }
            }

            return $array;
        }

        return false;
    }

    public function FormataInputsView($cols, $inputs = null, $result)
    {

        if($cols != null) {

            foreach($cols as $col => $info) {
                $colinfo[$info['COLUMN_NAME']] = $info['DATA_TYPE'];
            }

            foreach($inputs as $input) {

                foreach($colinfo as $coluna => $tipo) {

                    if($input->getName() == $coluna) {

                        if($input->getName() == 'fk_estado_id' and $result[$coluna] != null) {

                            $modelCidade = new Application_Model_Cidade();
                            $oCidades = $modelCidade->fetchAll(array(
                                'fk_estado_id' => $result[$coluna]
                            ));

                            $cflag = true;
                        }

                        switch ($tipo) {

                            case 'decimal':

                            $input->setValue($this->fMoedaBr($result[$coluna]));
                            break;

                            default:

                            if($input->getName() == 'fk_cidade_id' and $cflag) {

                                foreach($oCidades as $oCidade){

                                    $inputs['fk_cidade_id']->addMultiOption(

                                        $oCidade->cidade_id, $oCidade->cidade_nome
                                    );
                                }
                            }

                            $input->setValue($result[$coluna]);
                            break;
                        }
                    }
                }
            }

        }
    }


    public function getAuxTable($tabela = null){
        if($tabela != null){
            return array(
                'name' => $tabela,
                'primary' => $tabela . '_id'
            );
        }

        return false;
    }

    public function Paginacao($rRows = null, $pagina = null, $results = null)
    {
        if($results == null){
            $results = 50;
        }

        if($rRows != null){
            $paginator = Zend_Paginator::factory($rRows);
            $paginator->setItemCountPerPage($results);
            $paginator->setPageRange(20);
            $paginator->setCurrentPageNumber($pagina);

            return $paginator;
        }

        return false;
    }

    public function EmailConfig($user, $pass = null)
    {
        $default_pass = 'Spin@0224';

        if(!is_null($pass))
            $default_pass = $pass;

        $config = array(
                    'auth' => 'login',
                    'ssl' => 'ssl',
                    'port' => 465,
                    'username' => $user,
                    'password' => $default_pass);

        $transport = new Zend_Mail_Transport_Smtp('smtp.googlemail.com', $config);

        return $transport;
    }

    public function getGoogleClient()
    {

        $client_email = 'google-drive@sulvistos.iam.gserviceaccount.com';
        $private_key = file_get_contents(__DIR__ . '/sulvistos-7244a23116e6.p12');
        $scopes = array('https://www.googleapis.com/auth/drive');
        $user_to_impersonate = 'rmedeiros@sulvistos.com.br';
        $credentials = new Google_Auth_AssertionCredentials(
            $client_email,
            $scopes,
            $private_key,
            'notasecret',                                 // Default P12 password
            'http://oauth.net/grant_type/jwt/1.0/bearer', // Default grant type
            $user_to_impersonate
        );

        $client = new Google_Client();
        $client->setAssertionCredentials($credentials);
        if ($client->getAuth()->isAccessTokenExpired()) {
          $client->getAuth()->refreshTokenWithAssertion();
        }

        return $client;
    }

    public function criarPasta($iCompraId, $iFolderId, $sNome)
    {

        $moCompra = new Crm_Model_Compra();
        $obCompra = $moCompra->find($iCompraId);
        $google_client = $this->getGoogleClient();
        $service = new Google_Service_Drive($google_client);

        if($obCompra['google_drive'] == NULL){
            $fileMetadata = new Google_Service_Drive_DriveFile(array(
              'name' => $sNome,
              'parents' => array($iFolderId),
              'mimeType' => 'application/vnd.google-apps.folder',
            ));

            $file = $service->files->create($fileMetadata, array(
              'fields' => 'id'));
        }

        $moCompra->atualizar(array('google_drive' => $file->id), $iCompraId, $this->session->usuario_id);

    }

    public function getOfx($OfxFile) {

        $ofxParser = new \OfxParser\Parser();
        $ofx = $ofxParser->loadFromFile($OfxFile);

        $bankAccount = reset($ofx->bankAccounts);

        return $bankAccount;
    }

    public function getOrcamentos($conditions) {

        $model = new Crm_Model_Orcamento();

        $objs = $model->fetchAll($conditions);

        return $objs;
    }

}
