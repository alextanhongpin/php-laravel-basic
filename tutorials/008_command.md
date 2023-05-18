# How to run command

1. Create a new command
```bash
php artisan make:command WalletCommand
```
2. In `/app/Console/Commands/FancyCommand.php` find a protected variable `$signature` and change it's value to your preferred signature:

```php
protected $signature = 'fancy:command';
```
3. Code in the `handle()` method will be executed:

```php
public function handle()
{
    // Use Eloquent and other Laravel features...

    echo 'Hello world';
}
```
4. ~~Register your new command in the `/app/Console/Kernel.php` by adding your command's class name to $commands array.

```php
protected $commands = [
    // ...
    Commands\FancyCommand::class,
];
```
~~ In the newer Laravel version, this is handled.

5. Run your new command: php artisan fancy:command.

### Reference

https://stackoverflow.com/questions/40993513/command-line-scripts-in-laravel
