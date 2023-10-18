<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add a user for the application';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = $this->ask("What is the name of the user?");
        $email = $this->ask("What is their email address?");

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make('password')
        ]);

        $this->info("A user with the name of {$name} and email of {$email} has been created.");
    }
}
