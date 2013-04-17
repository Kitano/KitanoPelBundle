# PelBundle

This bundle integrates [Kitano PHP Expression language](https://github.com/Kitano/php-expression)
into Symfony 2.

## TODO

* Add symfony specific expressions + compilers (if any)

## Index

* [State](#state)
* [Installation](#installation)
* [Usage](#usage)
    * [Basic usage](#basic-usage)
    * [Registering custom expression compiler](#registering-custom-expression-compiler)
* [Testing](#testing)
* [License](#license)

## State

Unstable. [![Build Status](https://travis-ci.org/Kitano/KitanoPelBundle.png?branch=master)](https://travis-ci.org/Kitano/KitanoPelBundle)


## Installation

First, install the bundle package with composer:

```bash
$ php composer.phar require kitano/pel-bundle
```

Next, activate the bundle into `app/AppKernel.php`:

```PHP
<?php

// ...
    public function registerBundles()
    {
        $bundles = array(
            //...
            new Kitano\PelBundle\KitanoPelBundle(),
        );

        // ...
    }
```

## Usage

### Basic Usage

The `Expression` compiler can be injected into your services:

```PHP
<?php

namespace My\Service;

use Pel\Expression\ExpressionCompiler;

class MyService
{
    private $expressionCompiler;

    public function __construct(ExpressionCompiler $expressionCompiler)
    {
        $this->expressionCompiler = $expressionCompiler;
    }
}
```

```XML
<service id="my.service.my_service" class="My\Service\MyService">
    <argument type="service" id="kitano_pel.expression.compiler" />
</service>
```

And then you can start compiling expressions:

```PHP
<?php

namespace My\Service;

use Pel\Expression\ExpressionCompiler;
use Pel\Expression\Expression;

class MyService
{
    // ...

    public function someMethod()
    {
        $evaluator = eval($this->expressionCompiler->compileExpression(new Expression("['foo', 'bar']")));
        $result = call_user_func($evaluator, array()));
        // $result => array('foo', 'bar')
    }
}
```

### Registering custom compiler

After having created your expression compiler
(see [https://github.com/Kitano/php-expression#adding-a-custom-function-compiler](https://github.com/Kitano/php-expression#adding-a-custom-function-compiler))
You need to register a new service into the Dependency Container with one of the following tag
(depending on your expression type):
    * `kitano_pel.expression.type_compiler`
    * `kitano_pel.expression.function_compiler`

If we take the `isNumber()` function compiler example:

```XML
<service id="my.expression.is_number_compiler" class="My\Expression\Compiler\Func\IsNumberFunctionCompiler.php" public="false">
    <tag name="kitano_pel.expression.function_compiler" />
</service>
```

Then, you can start compiling your custom expressions:

```PHP
<?php

namespace My\Service;

use Pel\Expression\ExpressionCompiler;
use Pel\Expression\Expression;

class MyService
{
    // ...

    public function someMethod()
    {
        $evaluator = eval($this->expressionCompiler->compileExpression(new Expression("isNumber('1234')")));
        $result = call_user_func($evaluator, array()));
        // $result => bool(true)
    }
}
```

## Testing

Install development dependencies

```bash
$ composer install --dev
```

Run the test suite

```bash
$ vendor/bin/phpunit
```

## License

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE