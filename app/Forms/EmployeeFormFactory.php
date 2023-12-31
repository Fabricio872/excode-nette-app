<?php

declare(strict_types=1);

namespace App\Forms;

use Nette\Application\UI\Form;
use Tomaj\Form\Renderer\BootstrapRenderer;

class EmployeeFormFactory
{
    public function create(): Form
    {
        $form = new Form();
        $form->setRenderer(new BootstrapRenderer());
        $form->addText('name', 'Name:');
        $form->addText('sex', 'Sex:');
        $form->addInteger('age', 'Age:');
        $form->addSubmit('save', 'Save');
        return $form;
    }
}
