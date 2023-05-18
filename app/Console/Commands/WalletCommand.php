<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class WalletCommand extends Command
{
    /**
     * The name and signature of the console command.
     * You can now run $ php artisan wallet:command
     *
     * @var string
     */
    protected $signature = 'wallet:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to test our Wallet operations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $first = User::first();
        if (empty($first)) {
            $first = User::create([
                'name' => 'John Doe',
                'email' => 'john.doe@mail.com',
                'password' => Hash::make('123456')
            ]);
        }

        $last = User::orderBy('id', 'desc')->first();
        if ($first->getKey() == $last->getKey()) {
            $last = User::create([
                'name' => 'Alice',
                'email' => 'alice@mail.com',
                'password' => Hash::make('123456')
            ]);
        }

        var_dump($first->name . ' has ' . $first->balance);
        var_dump($last->name . ' has ' . $last->balance);
        // Deposit 10 cents.
        //$first->deposit(10);
        // Withdraw 10 cents.
        //$first->withdraw(10);
        //$first->transfer($last, 10);
        echo 'hello world\n';
    }
}
