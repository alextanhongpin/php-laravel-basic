# Running the Project

To run the project, you need to have the following installed:

- docker


Most of the commands are available in the root `Makefile`.

To start the project, run:

```bash
$ make up
```

This will bring up the docker containers, and build the laravel project in a docker container for development. This eases up local setup, because you do not need to install PHP and its dependencies locally.


To verify the endpoints are working, visit http://localhost:8000.


To stop the project, run:

```bash
$ make down
```
