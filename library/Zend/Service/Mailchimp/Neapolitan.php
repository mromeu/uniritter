<?php

class Mailchimp_Neapolitan {
    public function __construct(Zend_Service_Mailchimp $master) {
        $this->master = $master;
    }

}


