# translations_editor

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require jan-dolata/translations_editor
```

Add ServiceProvider to `config/app`.

```
JanDolata\TranslationsEditor\TranslationsEditorServiceProvider::class
```

And publish TranslationsEditor config.

``` bash
$ php artisan vendor:publish
```

Check config file.

```
config/TranslationsEditor.php
```

Add `resources/lang/xx` for all used laguages to `.gitignore`.

ex.
```
/resources/lang/en
/resources/lang/de
/resources/lang/pl
```

Change folder name `resources/lang/en` to `resources/lang/base`.

``` bash
$ mv resources/lang/en resources/lang/base
```

If you need, use seed. Add `TranslationSeeder` in `DatabaseSeeder.php`.

```
$this->call(JanDolata\TranslationsEditor\Engine\TranslationSeeder::class);
```

Done !

## Usage

Go to `.../translation/get` to edit your translations lines.

Before save, backup file will store in `storage/app/translations`.
Check that in `.../translation/log` page.


## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email jan.dolata.gd@gmail.com instead of using the issue tracker.

## Credits

- [Jan Dolata][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/jan-dolata/translations_editor.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/jan-dolata/translations_editor/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/jan-dolata/translations_editor.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/jan-dolata/translations_editor.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/jan-dolata/translations_editor.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/jan-dolata/translations_editor
[link-travis]: https://travis-ci.org/jan-dolata/translations_editor
[link-scrutinizer]: https://scrutinizer-ci.com/g/jan-dolata/translations_editor/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/jan-dolata/translations_editor
[link-downloads]: https://packagist.org/packages/jan-dolata/translations_editor
[link-author]: https://github.com/:author_username
[link-contributors]: ../../contributors
