<?php

namespace Database\Seeders;

use App\Models\Card;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $cards = ['12630417','12630418'];
        Card::create([
            'card_number'=> '12630417',
        ]);
        Card::create([
            'card_number'=> '12630418',
        ]);


    }
}
