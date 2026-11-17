<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('Admin123'),
            ]
        );
        $items = [
            ['Carbon Fiber Paddle',       'Paddles',     3500.00, 'Carbon fiber face, polymer honeycomb core, 16 mm thick, 8.0 oz.', 'Available'],
            ['Fiberglass Paddle',         'Paddles',     2200.00, 'Fiberglass face, polypropylene core, 13 mm thick, 7.8 oz.',       'Unavailable'],
            ['Indoor Pickleball Pack',    'Balls',        650.00, 'Pack of 6 indoor balls, 26 large holes, 74 mm diameter.',         'Available'],
            ['Outdoor Pickleball Pack',   'Balls',        750.00, 'Pack of 6 outdoor balls, 40 small holes, UV and wind resistant.', 'Unavailable'],
            ['Portable Pickleball Net',   'Nets',        8500.00, 'Regulation 22 ft net with steel frame, wheeled carry case.',      'Available'],
            ['Replacement Net',           'Nets',        1800.00, 'Net only, 21.5 ft wide, double-stitched top band.',                'Available'],
            ['Paddle Grip Tape',          'Accessories',  180.00, 'Pack of 3 overgrips, tacky, 1.2 mm thick.',                        'Unavailable'],
            ['Pickleball Equipment Bag',  'Accessories', 1500.00, 'Holds 4 paddles and 12 balls, padded shoulder strap.',             'Available'],
        ];

        foreach ($items as [$name, $category, $price, $description, $status]) {
            $admin->equipment()->create([
                'equipment_name'      => $name,
                'category'            => $category,
                'unit_price'          => $price,
                'description'         => $description,
                'availability_status' => $status,
            ]);
        }
    }
}
