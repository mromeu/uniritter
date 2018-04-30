<?php


	class Zend_View_Helper_Flash extends Zend_View_Helper_Abstract{

	    public function Flash($args = null)
	    {

	    	if(empty($args)) {

	    		return false;
	    	}

	    	$message = "

	    	<div class='flash alert alert-". $args['css'] ."'>
			  <strong>". $args['title'] ."</strong> ". $args['message'] ."

			</div>";


	    	return $message;

	    }
	}

?>