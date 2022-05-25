<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;



class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $countries = require 'vendor/umpirsky/country-list/data/en/country.php';
        foreach($countries as $country_code => $country){
            Country::create(['name' => $country, 'country_code' => $country_code]);
        }
    }
}
