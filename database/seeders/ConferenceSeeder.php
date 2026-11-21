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
        $conferences = [
            ['title' => 'Technologijų ateities forumas', 'description' => 'Pranešimai apie programinės įrangos kūrimą, dirbtinį intelektą ir atsakingą technologijų naudojimą.', 'date' => now()->addDays(21)->toDateString(), 'address' => 'Konstitucijos pr. 20', 'city' => 'Vilnius', 'capacity' => 180],
            ['title' => 'Dizaino ir verslo susitikimas', 'description' => 'Praktinės dirbtuvės ir pokalbiai apie paslaugų dizainą, verslumą bei bendradarbiavimą.', 'date' => now()->addDays(45)->toDateString(), 'address' => 'Karaliaus Mindaugo pr. 50', 'city' => 'Kaunas', 'capacity' => 120],
            ['title' => 'Tvarių miestų konferencija', 'description' => 'Miestų planavimo, judumo ir tvarumo ekspertų įžvalgos bei atvejų analizės.', 'date' => now()->addDays(70)->toDateString(), 'address' => 'Taikos pr. 61', 'city' => 'Klaipėda', 'capacity' => 95],
        ];

        foreach ($conferences as $conference) {
            Conference::firstOrCreate(['title' => $conference['title']], $conference);
        }
    }
}
