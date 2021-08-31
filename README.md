![GitHub release](https://img.shields.io/github/release/lotgd-core/fairy-bundle.svg)
![GitHub Release Date](https://img.shields.io/github/release-date/lotgd-core/fairy-bundle.svg)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/lotgd-core/fairy-bundle)
[![Build in PHP](https://img.shields.io/badge/PHP-^7.2-8892BF.svg?logo=php)](http://php.net/)

![GitHub issues](https://img.shields.io/github/issues/lotgd-core/fairy-bundle.svg)
![GitHub pull requests](https://img.shields.io/github/issues-pr/lotgd-core/fairy-bundle.svg)
![Github commits (since latest release)](https://img.shields.io/github/commits-since/lotgd-core/fairy-bundle/latest.svg)
![GitHub commit activity](https://img.shields.io/github/commit-activity/w/lotgd-core/fairy-bundle.svg)
![GitHub last commit](https://img.shields.io/github/last-commit/lotgd-core/fairy-bundle.svg)

![GitHub top language](https://img.shields.io/github/languages/top/lotgd-core/fairy-bundle.svg)
![GitHub language count](https://img.shields.io/github/languages/count/lotgd-core/fairy-bundle.svg)

[![PayPal.Me - The safer, easier way to pay online!](https://img.shields.io/badge/donate-help_my_project-ffaa29.svg?logo=paypal&cacheSeconds=86400)](https://www.paypal.me/idmarinas)
[![Liberapay - Donate](https://img.shields.io/liberapay/receives/IDMarinas.svg?logo=liberapay&cacheSeconds=86400)](https://liberapay.com/IDMarinas/donate)
[![Twitter](https://img.shields.io/twitter/url/http/shields.io.svg?style=social&cacheSeconds=86400)](https://twitter.com/idmarinas)


## Installation ##

```bash
composer require lotgd-core/fairy-bundle
```

# Default configuration
```yaml
lotgd_fairy:
    # Is a permanent hitpoint or lost when kill Dragon?
    permanent: false
    awards:
        # How many Hitpoints given by the Fairy?
        hitpoint: 1 # One of 1; 2; 3; 4; 5
        # How many Turns give by the Fairy?
        turn: 1 # One of 1; 2; 3; 4; 5
```
