<?php

namespace SRS\Forms\Form;

use Zend\Form\Form;

class TestForm extends Form
{

    public function __construct()
    {

        parent::__construct();

        $this->setName('test');
        $this->setAttribute('method', 'post');

    }

}