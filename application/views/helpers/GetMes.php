<?php


	class Zend_View_Helper_GetMes extends Zend_View_Helper_Abstract{

	    public function GetMes($id = null)
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
}

?>
