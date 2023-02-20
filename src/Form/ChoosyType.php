<?php

namespace Braunstetter\Choosy\Form;

use Braunstetter\Choosy\Option;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
