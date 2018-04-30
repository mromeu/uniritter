<?php
class Zend_View_Helper_FormataInputsView extends Zend_View_Helper_Abstract{
    
    public function FormataInputsView($cols, $inputs = null)
    {     
        $funcoes = new Zend_Funcoes();
        
        if($cols != null){
            foreach($cols as $col => $info){
                $colinfo[$info['COLUMN_NAME']] = $info['DATA_TYPE'];
            }
            
            foreach($inputs as $input => $val){
                foreach ($colinfo as $colnome => $coltipo){
                    if($colnome == $input){
                        switch ($coltipo) {
                            case 'date':
                                $inputs[$colnome] = $funcoes->fDataBr($val);
                                
                                break;
                            case 'datetime':
                                $inputs[$colnome] = $funcoes->fDateTime($val);
                                
                                break;                            
                            case 'decimal':
                                $inputs[$colnome] = $funcoes->fMoedaBr($val);
                                
                                break;
                            default:
                                
                                
                                break;
                        }
                    }
                }
            }
            
            return $inputs;
        }
        return false;
    }    
    
}
?>