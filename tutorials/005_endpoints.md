# Endpoints

Note that the api endpoint is available under `localhost:8000/api`.


## Creating controller

Run the command below to create a new controller:
```bash
# php artisan make:controller <TestController> --resource
$ make controller name=<TestController>
```

It should generate a new controller in `app/Http/Controllers/CarController.php`.


Then add the following to your `routes/api.php`:

```php
Route::resource("cars", Controllers\CarController::class);
```


Calling the endpoint should now return the resources to cars:

```bash
$ curl localhost:8000/api/cars
```


## Resources

Resources envelopes the data.

Instead of manually doing this:

```php
$response = [
    'data' => $user
]
response()->json($response, 201);
```

Create a resource and return it:

```php
public function show(string $id) {
    return new UserResource(User::findOrFail($id));
}
```


## Useful curl
```bash
# Create a car
curl -XPOST localhost:8000/api/cars \
-H 'Accept: application/json' \
-H 'Content-Type: application/json' \
-d '{"make": "make", "model": "model", "year": 2000}'

# Deletes a car by id
curl -XDELETE localhost:8000/api/cars/1

# Updates a car
curl -XPUT localhost:8000/api/cars/2 \
-H 'Accept: application/json' \
-H 'Content-Type: application/json' \
-d '{"make": "make", "model": "model", "year": 2000}'
```
