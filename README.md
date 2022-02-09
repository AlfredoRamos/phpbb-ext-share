### About

Share Links extension for phpBB.

[![Build Status](https://img.shields.io/github/workflow/status/AlfredoRamos/phpbb-ext-share/CI?style=flat-square)](https://github.com/AlfredoRamos/phpbb-ext-share/actions)
[![Latest Stable Version](https://img.shields.io/github/tag/AlfredoRamos/phpbb-ext-share.svg?label=stable&style=flat-square)](https://github.com/AlfredoRamos/phpbb-ext-share/releases)
[![Code Quality](https://img.shields.io/codacy/grade/b7f39e63a66f4d9cb47f3fa5600a12cd.svg?style=flat-square)](https://app.codacy.com/gh/AlfredoRamos/phpbb-ext-share/dashboard)
[![License](https://img.shields.io/github/license/AlfredoRamos/phpbb-ext-share.svg?style=flat-square)](https://raw.githubusercontent.com/AlfredoRamos/phpbb-ext-share/master/license.txt)

Adds social share links after a post, either only on topics or on all of them, to share them to social networks.

Currently supported social networks: WhatsApp, Telegram, Facebook, Twitter, Reddit, Vk, Tumblr, Evernote, Pocket, Digg, Diigo, LinkedIn, Skype, Pinterest, Email, SMS.

### Features

- Display share links on topics (firs post only) or all posts
- You can change the order of the social share links
- Fully compatible with the [SEO Metadata](https://github.com/AlfredoRamos/phpbb-ext-seo-metadata) extension

### Preview

[![Social Links](https://i.imgur.com/CySHthzb.png)](https://i.imgur.com/CySHthz.png)
[![Social Links Settings](https://i.imgur.com/W05H3Cub.png)](https://i.imgur.com/W05H3Cu.png)

*(Click to view in full size)*

### Requirements

- PHP 7.1.3 or greater
- phpBB 3.3 or greater

### Support

- [**Download page**](https://github.com/AlfredoRamos/phpbb-ext-share/releases)
- [GitHub issues](https://github.com/AlfredoRamos/phpbb-ext-share/issues)

### Donate

If you like or found my work useful and want to show some appreciation, you can consider supporting its development by giving a donation.

[![Donate with PayPal](https://alfredoramos.mx/images/paypal.svg)](https://alfredoramos.mx/donate/) | [![Donate with Stripe](https://alfredoramos.mx/images/stripe.svg)](https://alfredoramos.mx/donate/)
:-:|:-:
[![Donate with PayPal](https://alfredoramos.mx/images/donate_paypal.svg)](https://alfredoramos.mx/donate/) | [![Donate with Stripe](https://alfredoramos.mx/images/donate_stripe.svg)](https://alfredoramos.mx/donate/)

### Installation

- Download the [latest release](https://github.com/AlfredoRamos/phpbb-ext-share/releases)
- Decompress the `*.zip` or `*.tar.gz` file
- Copy the files and directories inside `{PHPBB_ROOT}/ext/alfredoramos/share/`
- Go to your `Administration Control Panel` > `Customize` > `Manage extensions`
- Click on `Enable` and confirm

### Configuration

- Go to `Administration Control Panel` > `Extensions` > `Share Links` > `Settings`
- Choose the `Type` to show share links only on topics (first post of topic) or on all posts
- Choose the `Social Networks` you want to show or hide.
- In the `Preview` section, drag and drop the icons to change the order of the links
- Click on `Submit` to save the configuration changes

### Uninstallation

- Go to your `Administration Control Panel` > `Customize` > `Manage extensions`
- Click on `Disable` and confirm
- Go back to `Manage extensions` > `Share` > `Delete data` and confirm

### Upgrade

- Go to your `Administration Control Panel` > `Customize` > `Manage extensions`
- Click on `Disable` and confirm
- Delete all the files inside `{PHPBB_ROOT}/ext/alfredoramos/share/`
- Download the new version
- Upload the new files inside `{PHPBB_ROOT}/ext/alfredoramos/share/`
- Enable the extension again
