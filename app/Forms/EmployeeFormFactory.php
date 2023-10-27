<?php

namespace App\Forms;

use Nette\Application\UI\Form;

class EmployeeFormFactory
{
    public function create()
    {
        $form = new Form();
        $form->addText('name', 'Name:');
        $form->addText('sex', 'Sex:');
        $form->addInteger('age', 'Age:');
        $form->addSubmit('save', 'Save');
        return $form;
    }
}
