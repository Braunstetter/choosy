# Choosy FormType

This bundle brings `@michael-brauner/choosy` into your symfony application.

It is just a nice wrapper around the standard symfony `ChoiceType` and `EntityType` form fields.  
It gives you the ability to turn it into a nice tag picker.

 - [Installation](#installation)
 - [Usage](#usage)
 - [Options](#options)
 - [Contributing](#contributing)
 - [Testing](#testing)

## Installation

`composer require braunstetter/choosy`

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

## Contributing
If you think this bundle could still be improved and expanded, then we welcome your PR.

## Testing
To make sure everything works fine - you have to run the test suite.

You need to make sure Panther is working properly on your machine.
Then your tests should work fine performing a simple:

```shell
composer install
vendor/bin/bdi detect drivers
yarn --cwd ./src/Resources/assets install --force
yarn --cwd ./tests/app install --force
yarn --cwd ./src/Resources/assets  dev
yarn --cwd ./tests/app dev

./vendor/phpunit/phpunit/phpunit
```
