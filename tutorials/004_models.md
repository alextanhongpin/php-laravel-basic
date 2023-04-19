# Models


To create a new model, run the following command:

```bash
$ php artisan make:model --help

# Generate a migration, seeder, factory, policy, resource controller and form
# request classes for the model.
# --api ensures that the generated controller is an API resource controller.
$ php artisan make:model --all --api User
```



Output:
```bash
   INFO  Model [app/Models/Cars.php] created successfully.

   INFO  Factory [database/factories/CarsFactory.php] created successfully.

   INFO  Migration [database/migrations/2023_04_19_035457_create_cars_table.php] created successfully.
```

Note that three files are created
- model
- factory
- migration


## Migration

Update the migration file:
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('make');
            $table->string('model');
            $table->integer('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
```

## Factory


Update the factory in `database/factories/CarsFactory.php`:

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cars>
 */
class CarsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'make' => fake()->company(),
            'model' => fake()->word(),
            'year' => fake()->year(),
        ];
    }
}
```


## Seed

Create a seed based on the tutorial `002_database.md`.

So
```bash
$ make seed-new name=CarsTableSeeder
```

Update the `database/seeders/CarsTableSeeder.php`:


```php

<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Cars::factory(10)->create();
    }
}
```

Don't forget to update the `database/seeders/DatabaseSeeder.php` to run the migration for the `CarsTableSeeder.php`:


```diff
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
+       $this->call(CarsTableSeeder::class);
    }
```

Run the seed with this command:

```bash
$ make seed
```

Output:

```bash
  Database\Seeders\CarsTableSeeder ......................................................................................................... RUNNING
  Database\Seeders\CarsTableSeeder ................................................................................................... 47.50 ms DONE
```

## Adding Views

Go to `routes/web.php` and add a new route to fetch the cars:


```php
Route::get('/cars', function () {
    $cars = DB::table('cars')
        -> join('users', 'users.id', 'cars.id')
        ->select('users.name', 'users.email', 'cars.*')
        ->get();

    return view('cars', ['cars' => $cars]);
});
```

Create a new view at `resources/views/cars.blade.php` with the following `body`:

```html
    <body class="antialiased">
        <h1>Cars</h1>

        @foreach($cars as $car)
            <div>
                <p><b>ID: {{ $car->id }}</b></p>
                <p>Make: {{ $car->make }}</p>
                <p>Model: {{ $car->model }}</p>
                <p>Name: {{ $car->name }}</p>
                <p>Email: {{ $car->email }}</p>
            </div>
        @endforeach
    </body>
```


View the result in `http://localhost:8000/cars`.
