
# UrlAutoConverterBundle #

Forked from [liip/LiipUrlAutoConverterBundle](https://github.com/liip/LiipUrlAutoConverterBundle)

## About ##

This bundle adds a Twig Extension with a filter for automatically converting urls and emails in a string to html links.
In the Format: "<a href="http://liip.ch">liip.ch</a>" for urls or "<a href="mailto:info@liip.ch">info@liip.ch</a>" for emails.

# Installation for Symfony

```bash
composer require linnit/UrlAutoConverterBundle
```

or update your composer.json

```json
"require": {
    "linnit/UrlAutoConverterBundle": "1.*"
}
```

and run `composer install`

## Configuration ##

The supported options for the UrlAutoConverterBundle are: (put in /app/config/config.yml)

    linnit_url_auto_converter:
        linkclass:
        target: _blank
        debugmode: false


- "linkClass":  css class that will be added automatically to converted links. default: "" (empty)
- "target":     browser link target. default: "_blank"
- "debugMode":  if true, links will be colored with a nasty green color - cool for testing. default: false

All settings are optional.

## Usage ##

This library adds a filter for twig templates that can be used like:

    {{ "sometexttofindaurl www.liip.ch inside" | converturls }}

## License ##

See `LICENSE`.
