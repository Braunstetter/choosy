# Choosy FormType

## Installation

`composer require braunstetter/choosy`

This bundle brings `@michael-brauner/choosy` into your symfony application.

It is just a nice wrapper around the standard symfony `ChoiceType` and `EntityType` form fields.  
It gives you the ability to turn it into a nice tag picker and you can add new elements to your list. 

## Usage

```php
$form->add('choices', ChoosyType::class, [
    'choices'  => [
        'Maybe' => null,
        'Yes' => true,
        'No' => false,
    ],
]);

// for entities
$form->add('choices', ChoosyEntityType::class, [
    'class' => Tag:class
]);
```

## Options
You can pass the same options as you would do directly to the javascript component.
All available options are documented [here](https://github.com/MichaelBrauner/choosy#options).


