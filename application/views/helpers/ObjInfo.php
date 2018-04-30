<?php

class Zend_View_Helper_ObjInfo extends Zend_View_Helper_Abstract{
    
    public function ObjInfo($array)
    {
        if($array['id'] == 0 || $array['id'] == NULL){
            return false;
        }

        $modelName = 'Application_Model_' . $array['model'];
        $model = new $modelName;

        if($array['id'] != ''){
            $obj = $model->find($array['id']);

            if(count($obj)){
                return $obj[$array['col']];
            }
        }

        return false;
    }     
}
?>
