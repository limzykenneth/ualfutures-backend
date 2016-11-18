# UALFutures' Website Backend

> Exploring the futures of creativity and learning where Technology meets Art, Design, Fashion, Communications and Performance.

This repository contains the code for the backend of the UALFutures' website. The following contains instructions on how to setup and deploy.

## Before you begin:

A few things you should familiarize yourself with before working on this fully:
- Wordpress
- Some PHP
- Basic server admin with Linux, Apache and MySQL

Having said that, most beginners should be able to hack the code a bit and PR is always welcomed!

## Installation

Clone the repo.
```
git clone https://github.com/limzykenneth/ualfutures-backend.git
```
Make sure you have a PHP environment set up locally and a MySQL instance running.

The site is basically Wordpress so just follow standard installation of Wordpress and setup the relevant MySQL database.

Activate all plugins except for "Wordpress Importer" (unless performing migration) and "WP REST API Cache" (should only be used in production environment).

Activate the theme "Twenty Sixteen Child".

In Settings > Permalinks, make sure "Post name" is selected (You may need mod_rewrite for Apache and the relevant entry in .htaccess as well).

## Developing

Developments are basically limited to the files under the `twentysixteen-child` theme which is extended from `twentysixteen` for most styling. `functions.php` contains logic for creating new post types and formating the REST response, it is also the main entry point. `custom-fields.php` contains the definitions for all the custom fields used by the various posts. The other files are there for legacy purpose and are not used at the moment.

The backend is as minimal as possible and built to be a easy to deploy REST API server, with most of the logic and data processing done on the frontend.

Please note the backend is not meant to be a public facing site and visitors should never be directed to the backend.

## License

For Wordpress's license see [license](https://codex.wordpress.org/License). Other custom code under the `twentysixteen-child` folder are under [BSD 3-Clause](https://opensource.org/licenses/BSD-3-Clause) license.