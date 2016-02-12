# Laravel Datagrid Builder

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Codacy Grade][ico-codacy-grade]][link-codacy]
[![Codacy Coverage][ico-codacy-coverage]][link-codacy]
[![Total Downloads][ico-downloads]][link-downloads]

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

Via Composer

``` bash
composer require lykegenes/laravel-datagrid-builder
```

Then, add this to your Service Providers :

``` php
Lykegenes\DatagridBuilder\ServiceProvider::class,
```

...and this to your Aliases :

``` php
'DatagridBuilder' => Lykegenes\DatagridBuilder\Facades\DatagridBuilder::class,
```

Optionally, you can publish and edit the configuration file :

``` bash
php artisan vendor:publish --provider="Lykegenes\DatagridBuilder\ServiceProvider" --tag=config
```

## Usage

``` php
$skeleton = new League\Skeleton();
echo $skeleton->echoPhrase('Hello, League!');
```

## Testing

``` bash
composer test
```

## Credits

- [Patrick Samson][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/lykegenes/laravel-datagrid-builder.svg?style=flat-square
[ico-license]: https://img.shields.io/packagist/l/lykegenes/laravel-datagrid-builder.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/Lykegenes/laravel-datagrid-builder/master.svg?style=flat-square
[ico-codacy-grade]: https://api.codacy.com/project/badge/grade/ff95c3e5360649638c61f2834bffd8b2
[ico-codacy-coverage]: https://api.codacy.com/project/badge/coverage/ff95c3e5360649638c61f2834bffd8b2
[ico-downloads]: https://img.shields.io/packagist/dt/lykegenes/laravel-datagrid-builder.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/lykegenes/laravel-datagrid-builder
[link-travis]: https://travis-ci.org/Lykegenes/laravel-datagrid-builder
[link-codacy]: https://www.codacy.com/app/Lykegenes/laravel-datagrid-builder
[link-downloads]: https://packagist.org/packages/lykegenes/laravel-datagrid-builder
[link-author]: https://github.com/lykegenes
[link-contributors]: ../../contributors