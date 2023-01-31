<?php

namespace App\Functional\Unit;

use Braunstetter\Choosy\Form\ChoosyType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\VarDumper\VarDumper;

class FormTypeTest extends TypeTestCase
{

    public function testCustomFormView()
    {
        $form = $this->factory->createBuilder();

        $form->add('choices', ChoosyType::class, [
            'choices'  => [
                'Maybe' => null,
                'Yes' => true,
                'No' => false,
            ],
        ]);

        $view = $form->getForm()->createView();

        $vars = $view->children['choices']->vars;
        $rowAttributes = $vars['row_attr'];

        $this->assertContains('choosy', $vars['block_prefixes']);

        $this->assertArrayHasKey('disabled', $vars);
        $this->assertFalse($vars['disabled']);

        $this->assertArrayHasKey('data-braunstetter--choosy-type--choosy-options-value', $rowAttributes);
        $this->assertSame('{"enabled":true}', $rowAttributes['data-braunstetter--choosy-type--choosy-options-value']);

        $this->assertArrayHasKey('data-controller', $rowAttributes);
        $this->assertSame('braunstetter--choosy-type--choosy', $rowAttributes['data-controller']);


    }

}