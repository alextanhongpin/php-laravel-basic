# Views

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
