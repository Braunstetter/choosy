<?php


namespace Braunstetter\Choosy;

use Symfony\Component\OptionsResolver\Options;

class Option
{

    public static function build(Options $options): array
    {
        $config = [];

        if ($options->offsetExists('choosy_enabled')) {
            $config['enabled'] = $options['choosy_enabled'];
        }

        if ($options->offsetExists('choosy_limit')) {
            $config['textInput']['limit'] = $options['choosy_limit'];
        }

        if ($options->offsetExists('choosy_open_on_focus')) {
            $config['resultList']['openOnFocus'] = $options['choosy_open_on_focus'];
        }

        return $config;
    }
}