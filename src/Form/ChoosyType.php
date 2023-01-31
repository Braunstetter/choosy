<?php

namespace Braunstetter\Choosy\Form;

use Braunstetter\Choosy\Option;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoosyType extends AbstractType
{

    const CONTROLLER_NAME = 'braunstetter--choosy-type--choosy';

    public array $options;

    public function __construct()
    {
        $this->formatOptions();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setNormalizer('row_attr', function (Options $options, $values) {
            $values['data-' . self::CONTROLLER_NAME . '-options-value'] = json_encode(Option::build($options));
            $values['data-controller'] = self::CONTROLLER_NAME;
            return $values;
        });

        $this->defineOptions($resolver);
        $this->setAllowedTypes($resolver);
        $this->setDefaults($resolver);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    protected function formatOption($name, $type, $default): array
    {
        return [
            'name' => $name,
            'types' => $type,
            'default' => $default
        ];
    }

    private function formatOptions()
    {
        $this->options = [
            $this->formatOption('choosy_enabled', ['boolean'], true)
        ];
    }

    private function defineOptions(OptionsResolver $optionsResolver)
    {
        foreach ($this->options as $option) {
            $optionsResolver->setDefined($option['name']);
        }
    }

    private function setAllowedTypes(OptionsResolver $resolver)
    {
        foreach ($this->options as $option) {
            $resolver->setAllowedTypes($option['name'], $option['types']);
        }
    }

    private function setDefaults(OptionsResolver $resolver)
    {
        $defaults = [];
        foreach ($this->options as $option) {
            $defaults[$option['name']] = $option['default'];
        }

        $resolver->setDefaults($defaults);
    }
}
