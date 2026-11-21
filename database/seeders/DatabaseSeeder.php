<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ConferenceSeeder::class);

        if (config('conference.admin_email') && config('conference.admin_password')) {
            User::updateOrCreate(
                ['email' => config('conference.admin_email')],
                ['name' => __('messages.administrator'), 'password' => config('conference.admin_password')],
            );
        }
    }
}
