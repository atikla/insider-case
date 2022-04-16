<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public const TEAMS = [
        [
            'name' => 'MANCHESTER CITY',
            'strength' => 0.95,
            'logo' => '/menchester-city.png'
        ],
        [
            'name' => 'LIVERPOOL',
            'strength' => 0.90,
            'logo' => '/liverpool.png'
        ],
        [
            'name' => 'CHELSEA',
            'strength' => 0.88,
            'logo' => '/chelsea.png'
        ],
        [
            'name' => 'TOTTENHAM HOTSPUR',
            'strength' => 0.85,
            'logo' => '/tottenham.png'
        ],
        [
            'name' => 'MANCHESTER UNITED',
            'strength' => 0.82,
            'logo' => '/manchester-utd.png'
        ],
        [
            'name' => 'ARSENAL',
            'strength' => 0.81,
            'logo' => '/arsenal.png'
        ],
        [
            'name' => 'WEST HAM UNITED',
            'strength' => 0.80,
            'logo' => '/west-ham-united.png'
        ],
        [
            'name' => 'WOLVERHAMPTON WANDERERS',
            'strength' => 0.79,
            'logo' => '/wolves.png'
        ],
        [
            'name' => 'LEICESTER CITY',
            'strength' => 0.78,
            'logo' => '/leicester.png'
        ],
        [
            'name' => 'BRIGHTON & HOVE ALBION',
            'strength' => 0.76,
            'logo' => '/brighton.png'
        ],
        [
            'name' => 'BRENTFORD',
            'strength' => 0.74,
            'logo' => '/brentford.png'
        ],
        [
            'name' => 'SOUTHAMPTON',
            'strength' => 0.72,
            'logo' => '/southampton.png'
        ],
        [
            'name' => 'CRYSTAL PALACE',
            'strength' => 0.71,
            'logo' => '/crystalPalace.png'
        ],
        [
            'name' => 'ASTON VILLA',
            'strength' => 0.70,
            'logo' => '/astonVilla.png'
        ],
        [
            'name' => 'NEWCASTLE UNITED',
            'strength' => 0.70,
            'logo' => '/newCastle.png'
        ],
        [
            'name' => 'LEEDS',
            'strength' => 0.69,
            'logo' => '/leeds.png'
        ],
        [
            'name' => 'EVERTON',
            'strength' => 0.68,
            'logo' => '/everton.png'
        ],
        [
            'name' => 'BURNLEY',
            'strength' => 0.67,
            'logo' => '/burnley.png'
        ],
        [
            'name' => 'WATFORD',
            'strength' => 0.66,
            'logo' => '/watford.png'
        ],
        [
            'name' => 'NORWICH CITY',
            'strength' => 0.65,
            'logo' => '/norwich.png'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        foreach (self::TEAMS as $team) {
            Team::create(array_merge($team,[
                'created_at' => $now,
                'updated_at' => $now
            ]));
        }
    }
}
