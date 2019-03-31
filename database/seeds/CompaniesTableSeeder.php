<?php

use App\City;
use App\Company;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collection = collect([
            'iTunes',
            'Play Store',
            'Netflix',
            'Steam',
            'Xbox Live',
            'Playstation',
            'Nintendo',
            'Facebook',
            'Amazon',
            'Cash U',
            'eBay',
            'rixty',
        ]);
        City::create(['name' => 'جيزة']);
        City::create(['name' => 'القاهرة']);
        $collection->each(function ($item, $key){
            // create permissions for each collection item
            Company::create([
                'name' => $item,
                'image' => Str::slug($item).'.png']);
        });
    }
}
