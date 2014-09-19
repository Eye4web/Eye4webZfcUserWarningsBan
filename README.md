Eye4webZfcUserWarningsBan
==========
[![Build Status](https://travis-ci.org/Eye4web/Eye4webZfcUserBan.svg?branch=master)](https://travis-ci.org/Eye4web/Eye4webZfcUserWarningsBan)
[![Latest Stable Version](https://poser.pugx.org/eye4web/eye4web-zfc-user-ban/v/stable.svg)](https://packagist.org/packages/eye4web/eye4web-zfc-user-warnings-ban)
[![Latest Unstable Version](https://poser.pugx.org/eye4web/eye4web-zfc-user-ban/v/unstable.svg)](https://packagist.org/packages/eye4web/eye4web-zfc-user-warnings-ban)
[![Code Climate](https://codeclimate.com/github/Eye4web/Eye4webZfcUserBan/badges/gpa.svg)](https://codeclimate.com/github/Eye4web/Eye4webZfcUserWarningsBan)
[![Test Coverage](https://codeclimate.com/github/Eye4web/Eye4webZfcUserBan/badges/coverage.svg)](https://codeclimate.com/github/Eye4web/Eye4webZfcUserWarningsBan)
[![Total Downloads](https://poser.pugx.org/eye4web/eye4web-zfc-user-ban/downloads.svg)](https://packagist.org/packages/eye4web/eye4web-zfc-user-warnings-ban)
[![License](https://poser.pugx.org/eye4web/eye4web-zfc-user-ban/license.svg)](https://packagist.org/packages/eye4web/eye4web-zfc-user-warnings-ban)

Introduction
==========
This module will allow you to ban a user after x amount of warnings or a total warnings weight

Installation
------------
#### With composer

1. Add this project composer.json:

    ```json
    "require": {
        "eye4web/eye4web-zfc-user-warnings-ban": "dev-master"
    }
    ```

2. Now tell composer to download the module by running the command:

    ```bash
    php composer.phar update
    ```

3. Enable it in your `application.config.php` file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'Eye4web\ZfcUser\WarningsBan'
        ),
        // ...
    );
    ```

4. Copy config from ```config/eye4web-zfcuser-warnings-ban.global.php.dist``` to your autoload folder.
