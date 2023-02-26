<?php


namespace Braunstetter\Choosy;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Option
{
    const CONTROLLER_NAME = 'braunstetter--choosy-type--choosy';
    const DEFAULT_UNSET = '__unset__';

    public static function build(Options $options): array
    {
        $config = [];

        if ($options->offsetExists('choosy_enabled')) {
            $config['enabled'] = $options['choosy_enabled'];
        }

        if ($options->offsetExists('choosy_limit')) {
            $config['textInput']['limit'] = $options['choosy_limit'];
        }

        return $config;
    }

    public static function formatOptions(): array
    {
        return [
            self::formatOption('choosy_enabled', ['boolean'], true),
            self::formatOption('choosy_limit', ['int']),
        ];
    }

    public static function formatOption(string $name, array $type, $default = self::DEFAULT_UNSET): array
    {
        return [
            'name' => $name,
            'types' => $type,
            'default' => $default
        ];
    }

    public static function injectChoosyJsOptionsToHtmlAttr(OptionsResolver $resolver): void
    {
        $resolver->setNormalizer('row_attr', function(Options $options, $values) {
            $values['data-' . self::CONTROLLER_NAME . '-options-value'] = json_encode(Option::build($options));
            $values['data-controller'] = self::CONTROLLER_NAME;
            return $values;
        });
    }
}