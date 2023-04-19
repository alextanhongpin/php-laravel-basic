# Database


For this project, we use `Postgres`.


To interact with the database, we have a few commands available:

```bash
$ php artisan migrate

# Or

$ make migrate
```


## Docker


Note that when running in docker, you need to change the `DB_HOST` environment to match the name of the database `services` in `docker-compose.yaml`. In this case, it is `db`.

When running any command that requires database in Docker, you can either re-export the `DB_HOST` again:

```bash
$ export DB_HOST=db
$ php artisan config:clear # Clear the cache
$ printenv DB_HOST # Check the current DB_HOST
```

Or add the environment inline:

```bash
$ env DB_HOST=db php artisan migrate
```


## Seeding


The seed files can be found in `database/seeders`. The main file is `DatabaseSeeder.php`.



Let's add a new seed file for `users`. To create a new seed file, we run the following command:

```bash
$ php artisan make:seeder UserTableSeeder
```


This will generate the file `database/seeders/UsersTableSeeder.php`.


Add the following to the file:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);
    }
}
```


In the `database/seeders/DatabaseSeeder.php` file, include the `UsersTableSeeder.php` module:

```php
<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
    }
}
```

Now, run `make seed` to run the seed:

```bash
$ make seed

# Or

$ php artisan db:seed
```


```bash
➜  php-laravel-basics git:(main) ✗ make seed

   INFO  Seeding database.

  Database\Seeders\UsersTableSeeder ........................................................................................................ RUNNING
  Database\Seeders\UsersTableSeeder ................................................................................................. 437.56 ms DONE

```


Note that this operation is not idempotent. Running it multiple times will error.
