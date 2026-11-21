<?php

namespace Database\Seeders;

use App\Models\Conference;
use Illuminate\Database\Seeder;

class ConferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (__('sample_conferences.events') as $conference) {
            $conference['date'] = now()->addDays($conference['days_until'])->toDateString();
            unset($conference['days_until']);

            Conference::firstOrCreate(['title' => $conference['title']], $conference);
        }
    }
}
