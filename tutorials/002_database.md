# Database


For this project, we use `Postgres`.


To interact with the database, we have a few commands available:

```bash
$ make migrate
```


## Seeding


The seed files can be found in `database/seeders`. The main file is `DatabaseSeeder.php`.



Let's add a new seed file for `users`. To create a new seed file, we run the following command:

```bash
$ php artisan make:seeder <name, e.g. UsersTableSeeder>
```


Since we are running it in docker, we need to use the `Makefile` command:

```bash
$ make seed-new name=UsersTableSeeder
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

Now, run `make seed` to run the seed.


```bash
➜  php-laravel-basics git:(main) ✗ make seed

   INFO  Seeding database.

  Database\Seeders\UsersTableSeeder ........................................................................................................ RUNNING
  Database\Seeders\UsersTableSeeder ................................................................................................. 437.56 ms DONE

```


Note that this operation is not idempotent. Running it multiple times will error.
