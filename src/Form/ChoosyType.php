<?php

namespace Braunstetter\Choosy\Form;

use Braunstetter\Choosy\Option;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoosyType extends AbstractType
{

    private array $options;

    public function __construct()
    {
        $this->options = Option::formatOptions();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        Option::injectChoosyJsOptionsToHtmlAttr($resolver);

        $this->defineOptions($resolver);
        $this->setAllowedTypes($resolver);
        $this->setDefaults($resolver);

        $resolver->define('include_css')
            ->default(false)
            ->allowedTypes('bool')
            ->info('Determines whether the supplied css should be injected.');
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_replace($view->vars, [
            'include_css' => $options['include_css']
        ]);
    }


    private function defineOptions(OptionsResolver $optionsResolver): void
    {
        foreach ($this->options as $option) {
            $optionsResolver->setDefined($option['name']);
        }
    }

    private function setAllowedTypes(OptionsResolver $resolver): void
    {
        foreach ($this->options as $option) {
            $resolver->setAllowedTypes($option['name'], $option['types']);
        }
    }

    private function setDefaults(OptionsResolver $resolver): void
    {
        $defaults = [];
        foreach ($this->options as $option) {
            if ($option['default'] !== Option::DEFAULT_UNSET) {
                $defaults[$option['name']] = $option['default'];
            }
        }

        $resolver->setDefaults($defaults);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}
