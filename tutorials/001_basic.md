# Running the Project

To run the project, you need to have the following installed:

- docker


Most of the commands are available in the root `Makefile`.

To start the Docker containers, run:

```bash
$ make up
```

This will bring up the docker containers, and build the laravel project in a docker container for development. This eases up local setup, because you do not need to install PHP and its dependencies locally.


To verify the endpoints are working, visit http://localhost:8000.


To stop the Docker containers, run:

```bash
$ make down
```


## Artisan CLI


The artisan CLI provides a lot of convenient methods to generate templates etc.

To access the artisan CLI in docker, run:

```bash
$ make artisan-cli
```

You will be in the present working directory. To validate:

```bash
john@48fd7c5b44df:/var/www$ php --version
PHP 8.1.18 (cli) (built: Apr 14 2023 18:18:41) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.1.18, Copyright (c) Zend Technologies
```

You can now run commands such as `php artisan about`.
