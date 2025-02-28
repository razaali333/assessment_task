<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attribute::create(['name' => 'department', 'type' => 'text']);
        Attribute::create(['name' => 'start_date', 'type' => 'date']);
        Attribute::create(['name' => 'end_date', 'type' => 'date']);
    }
}
