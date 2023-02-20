<?php

namespace Braunstetter\Choosy\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ChoosyEntityType extends ChoosyType
{
    public function getParent(): string
    {
        return EntityType::class;
    }
}