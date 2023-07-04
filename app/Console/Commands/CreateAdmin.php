<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {UserEmail=admin@hz.nl} {UserPassword=123qweASD###}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Created the first admin account with the given email and password.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userEmail = $this->argument('UserEmail');
        $userPassword = $this->argument('UserPassword');

        if (preg_match("#^[a-zA-Z0-9]+$#", $userEmail)) {
            $userEmail .= '@example.com';
        }

        if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            $existingUser = User::where('email', $userEmail)->first();
            if (! $existingUser) {
                $validator = Validator::make(['password' => $userPassword], [
                    'password' => ['required', 'string', 'min:12', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
                ]);

                if ($validator->fails()) {
                    echo "   \nERROR | Password validation failed. The password must be at least 12 characters and contain at least one uppercase character, one number, and one special character. | ERROR\n";
                    return;
                }

                User::create([
                    "name" => strstr($userEmail,'@',true),
                    "email" => $userEmail,
                    "password" => Hash::make($userPassword),
                    "role" => "admin"
                ]);
                echo "\n{ Laravel | Security4 |\n";
                echo "|_ Admin\n    \_Create\n";
                echo "  \n| Admin account created: $userEmail | $userPassword\n";
            } else echo "   \nERROR | An account already uses that email: $userEmail | ERROR\n";
        } else echo "   \nERROR | The email you entered is not in valid format: { $userEmail } - Correct format: { email@webite.com } | ERROR\n";

        echo"\n}";
    }
}
