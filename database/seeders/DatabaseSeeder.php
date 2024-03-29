<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CampusSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\StudentSeeder;
use Database\Seeders\PhilippineCitiesTableSeeder;
use Database\Seeders\PhilippineRegionsTableSeeder;
use Database\Seeders\PhilippineBarangaysTableSeeder;
use Database\Seeders\PhilippineProvincesTableSeeder;
use Database\Seeders\IdDataSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            CampusSeeder::class,
            CourseSeeder::class,
            // StudentSeeder::class,
            IdDataSeeder::class,
            CardSeeder::class,
            PhilippineRegionsTableSeeder::class,
            PhilippineProvincesTableSeeder::class,
            PhilippineCitiesTableSeeder::class,
            PhilippineBarangaysTableSeeder::class,
            
        ]);


        $tellers = [
            [
                'teller_name' => 'teller1',
                'teller_letter'=> 'a',
                'id_number'=>'123',
                'password'=> 'password',
            ],
            [
                'teller_name' => 'teller2',
                'teller_letter'=> 'b',
                'id_number'=>'1234',
                'password'=> 'password',
            ],
            [
                'teller_name' => 'teller3',
                'teller_letter'=> 'c',
                'id_number'=>'12345',
                'password'=> 'password',
            ],
            [
                'teller_name' => 'teller4',
                'teller_letter'=> 'd',
                'id_number'=>'12356',
                'password'=> 'password',
            ],
        ];

        foreach ($tellers as $teller) {
            \App\Models\Teller::create($teller);
        }
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
