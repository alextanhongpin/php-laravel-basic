# Authentication

Using Laravel Sanctum.


```bash
$ php artisan make:request RegisterRequest
```

Add to `app/Http/Requests/RegisterRequest.php`:

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'name' => 'required|min:3'
        ];
    }
}
```

Add the following to your `routes/api.php`:


```php
// Request payload.
use App\Http\Requests\RegisterRequest;

// For password hashing.
use Illuminate\Support\Facades\Hash;

// The user model for auth.
use App\Models\User;

Route::post('/register', function (RegisterRequest $request) {
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    $token = $user->createToken($user->name);

    return ['token' => $token->plainTextToken];
}
```

Make a request:
```bash
curl -XPOST \
-H 'Content-Type: application/json' \
-H 'Accept: application/json' \
-d '{"email": "john.doe@mail.com", "password": "12345678", "name": "John Doe"}' \
localhost:8000/api/register

curl -XPOST \
-H 'Content-Type: application/json' \
-H 'Accept: application/json' \
-d '{"email": "john.doe@mail.com", "password": "12345678"}' \
localhost:8000/api/login

{"token":"2|zlEh8C0zEaItZwf2y7OCWHjr0edcLfyjilMWgYBD"}%

# Authenticated
curl -XPOST \
-H 'Content-Type: application/json' \
-H 'Accept: application/json' \
-H 'Authorization: Bearer 2|zlEh8C0zEaItZwf2y7OCWHjr0edcLfyjilMWgYBD' \
localhost:8000/api/user-info

# Unauthenticated
curl -XPOST \
-H 'Content-Type: application/json' \
-H 'Accept: application/json' \
localhost:8000/api/user-info
```
