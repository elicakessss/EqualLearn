<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use Illuminate\Support\Str;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['name' => 'Philippines', 'code' => 'PH'],
            ['name' => 'United States', 'code' => 'US'],
            ['name' => 'Canada', 'code' => 'CA'],
            ['name' => 'United Kingdom', 'code' => 'UK'],
            ['name' => 'Australia', 'code' => 'AU'],
            ['name' => 'India', 'code' => 'IN'],
            ['name' => 'Japan', 'code' => 'JP'],
            ['name' => 'South Korea', 'code' => 'KR'],
            ['name' => 'Brazil', 'code' => 'BR'],
            ['name' => 'Mexico', 'code' => 'MX'],
            ['name' => 'Germany', 'code' => 'DE'],
            ['name' => 'France', 'code' => 'FR'],
            ['name' => 'Spain', 'code' => 'ES'],
            ['name' => 'Italy', 'code' => 'IT'],
            ['name' => 'Netherlands', 'code' => 'NL'],
            ['name' => 'Sweden', 'code' => 'SE'],
            ['name' => 'Norway', 'code' => 'NO'],
            ['name' => 'Denmark', 'code' => 'DK'],
            ['name' => 'Finland', 'code' => 'FI'],
            ['name' => 'Singapore', 'code' => 'SG'],
        ];

        foreach ($countries as $country) {
            Country::create([
                'name' => $country['name'],
                'code' => $country['code'],
                'slug' => Str::slug($country['name']),
            ]);
        }
    }
}
