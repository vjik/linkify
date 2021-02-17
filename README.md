# Linkify

[![Latest Stable Version](https://poser.pugx.org/vjik/linkify/v/stable.png)](https://packagist.org/packages/vjik/linkify)
[![Total Downloads](https://poser.pugx.org/vjik/linkify/downloads.png)](https://packagist.org/packages/vjik/linkify)
[![Build status](https://github.com/vjik/linkify/workflows/build/badge.svg)](https://github.com/vjik/linkify/actions?query=workflow%3Abuild)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fvjik%2Flinkify%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/vjik/linkify/master)
[![static analysis](https://github.com/vjik/linkify/workflows/static%20analysis/badge.svg)](https://github.com/vjik/linkify/actions?query=workflow%3A%22static+analysis%22)

The package provide `Linkify` class that matches things like email addresses, web URLs, etc. in the text and makes them clickable links.

## Installation

The package could be installed with [composer](https://getcomposer.org/download/):

```shell
composer require vjik/linkify --prefer-dist
```

## General usage

```php
$linkify = new \Vjik\Linkify\Linkify(
    new \Vjik\Linkify\HttpPattern(),
    new \Vjik\Linkify\EmailPattern(),
); 

$text = 'Contacts: https://example.com, info@example.com.';

$result = $linkify->process($text);
```

`$result` will be:

```html
Contacts: <a href="https://example.com">example.com</a>, <a href="mailto:info@example.com">info@example.com</a>.
```

## Testing

### Unit testing

The package is tested with [PHPUnit](https://phpunit.de/). To run tests:

```shell
./vendor/bin/phpunit
```

### Mutation testing

The package tests are checked with [Infection](https://infection.github.io/) mutation framework with
[Infection Static Analysis Plugin](https://github.com/Roave/infection-static-analysis-plugin). To run it:

```shell
./vendor/bin/roave-infection-static-analysis-plugin
```

### Static analysis

The code is statically analyzed with [Psalm](https://psalm.dev/). To run static analysis:

```shell
./vendor/bin/psalm
```

## License

The Linkify is free software. It is released under the terms of the BSD License.
Please see [`LICENSE`](./LICENSE.md) for more information.
