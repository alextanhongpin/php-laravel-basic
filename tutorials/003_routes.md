# Routes

## Adding a new view

Create a new view route in `routes/web.php`.

```diff
Route::get('/', function () {
-    return view('welcome');
+    return view('welcome', ['users' => App\Models\User::all()]);
});
```

Replace the body of `resources/views/welcome.blade.php` with this:


```php
    <body class="antialiased">
        <h1>Users</h1>

        @foreach($users as $user)
            <div>
                <p><b>ID: {{ $user->id }}</b></p>
                <p>Name: {{ $user->name }}</p>
                <p>Email: {{ $user->email }}</p>
            </div>
        @endforeach
    </body>
```
