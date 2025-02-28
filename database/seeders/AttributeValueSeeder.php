<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttributeValue::create([
            'attribute_id' => 1,
            'entity_id' => 1, // Project Alpha
            'value' => 'IT',
        ]);

        AttributeValue::create([
            'attribute_id' => 2,
            'entity_id' => 1, // Project Alpha
            'value' => '2024-01-01',
        ]);

        AttributeValue::create([
            'attribute_id' => 3,
            'entity_id' => 1, // Project Alpha
            'value' => '2024-06-01',
        ]);
    }
}
