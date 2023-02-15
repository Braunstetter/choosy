<?php

namespace Braunstetter\Choosy\Tests\Functional\Unit;

use Braunstetter\Choosy\Form\ChoosyType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Test\TypeTestCase;

class FormTypeTest extends TypeTestCase
{

    const FORM_DEFAULT = 'form_default';
    const FORM_LIMITED = 'form_limited';
    const FORM_DISABLED_OPEN_ON_FOCUS = 'form_disabled_open_on_focus';

    public function testDefaultFormView()
    {
        $vars = $this->getFormView()->children['choices']->vars;
        $rowAttributes = $vars['row_attr'];

        $this->assertContains('choosy', $vars['block_prefixes']);

        $this->assertArrayHasKey('disabled', $vars);
        $this->assertFalse($vars['disabled']);

        $this->assertArrayHasKey('data-braunstetter--choosy-type--choosy-options-value', $rowAttributes);
        $this->assertSame('{"enabled":true}', $rowAttributes['data-braunstetter--choosy-type--choosy-options-value']);

        $this->assertArrayHasKey('data-controller', $rowAttributes);
        $this->assertSame('braunstetter--choosy-type--choosy', $rowAttributes['data-controller']);
    }

    public function testLimitedFormView()
    {
        $vars = $this->getFormView(self::FORM_LIMITED)->children['choices']->vars;
        $rowAttributes = $vars['row_attr'];

        $this->assertArrayHasKey('data-braunstetter--choosy-type--choosy-options-value', $rowAttributes);
        $this->assertSame('{"enabled":true,"textInput":{"limit":2}}', $rowAttributes['data-braunstetter--choosy-type--choosy-options-value']);
    }

    public function testDisabledOpenOnFocusFormView()
    {
        $vars = $this->getFormView(self::FORM_DISABLED_OPEN_ON_FOCUS)->children['choices']->vars;
        $rowAttributes = $vars['row_attr'];

        $this->assertArrayHasKey('data-braunstetter--choosy-type--choosy-options-value', $rowAttributes);
        $this->assertSame('{"enabled":true,"resultList":{"openOnFocus":false}}', $rowAttributes['data-braunstetter--choosy-type--choosy-options-value']);
    }

    public function getFormView(?string $formViewType = self::FORM_DEFAULT): FormView
    {
        $form = $this->factory->createBuilder();
        $form->add('choices', ChoosyType::class, $this->createOptionsForFormViewType($formViewType));

        return $form->getForm()->createView();
    }

    private function createOptionsForFormViewType(?string $formViewType): array
    {

        if (self::FORM_LIMITED === $formViewType) {
            return array_replace($this->getDefaultOptions(), ['choosy_limit' => 2]);
        }

        if (self::FORM_DISABLED_OPEN_ON_FOCUS === $formViewType) {
            return array_replace($this->getDefaultOptions(), ['choosy_open_on_focus' => false]);
        }

        return $this->getDefaultOptions();
    }

    public function getDefaultOptions(): array
    {
        return [
            'choices' => [
                'Maybe' => null,
                'Yes' => true,
                'No' => false,
            ],
        ];
    }

}