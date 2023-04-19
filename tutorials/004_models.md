# Models


To create a new model, run the following command:

```bash
$ php artisan make:model --help

# Generate a migration, seeder, factory, policy, resource controller and form
# request classes for the model.
# --api ensures that the generated controller is an API resource controller.
$ php artisan make:model --all --api Driver
```



Output:
```bash
   INFO  Model [app/Models/Driver.php] created successfully.

   INFO  Factory [database/factories/DriverFactory.php] created successfully.

   INFO  Migration [database/migrations/2023_04_19_135838_create_drivers_table.php] created successfully.

   INFO  Seeder [database/seeders/DriverSeeder.php] created successfully.

   INFO  Request [app/Http/Requests/StoreDriverRequest.php] created successfully.

   INFO  Request [app/Http/Requests/UpdateDriverRequest.php] created successfully.

   INFO  Controller [app/Http/Controllers/DriverController.php] created successfully.

   INFO  Policy [app/Policies/DriverPolicy.php] created successfully.
```



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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
```

Run the migration:

```bash
$ php artisan migrate
```

## Factory


Update the factory in `database/factories/DriverFactory.php`:

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
        ];
    }
}
```


## Seed


Update the `database/seeders/DriverSeeder.php`:


```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 drivers.
        Driver::factory(10)->create();
    }
}
```

Don't forget to update the `database/seeders/DatabaseSeeder.php` to run the migration for the `DriverSeeder.php`:


```diff
    public function run(): void
    {
        // Other seeders not shown here
+       $this->call(DriverSeeder::class);
    }
```

Run the seed with this command:

```bash
$ php artisan db:seed

# Or

$ make seed
```

Output:

```bash
  Database\Seeders\DriverSeeder ............................................................................................................ RUNNING
  Database\Seeders\DriverSeeder ...................................................................................................... 31.21 ms DONE
```

## Models

Update your model in `app/Models/Driver.php`:

```diff
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;


+   protected $fillable = ['name'];
}
```
