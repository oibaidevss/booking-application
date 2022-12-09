<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

         // Reset cached roles and permissions
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         $role = Role::create(['name' => 'admin']);
         $role = Role::create(['name' => 'customer']);
         $role = Role::create(['name' => 'business owner']);

         $admin = \App\Models\User::factory()->create([
            'first_name' => 'admin',
            'last_name' => '',
            'email' => 'admin@admin.com',
            'business_type' => 'none'
         ])->assignRole('admin');
         
         // Business Owner - Hotel
         $business_owner_hotel = \App\Models\User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'business_type' => 'hotel'
         ])->assignRole('business owner');

         // Hotel
         $hotel = \App\Models\Hotel::factory()->create([
            'min_price' => rand(000, 999),
            'max_price' => rand(0000, 9999),
            'user_id' => $business_owner_hotel->id
         ]);

         // Rooms
         for ($i=1; $i <= 10; $i++) { 
            # code...
            \App\Models\Room::factory()->create([
               'room_number' => $i,
               'floor' => $i,
               'hotel_id' => $hotel->id
            ]);
         }

         $business_owner_restaurant = \App\Models\User::factory()->create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane.doe@example.com',
            'business_type' => 'restaurant'
         ])->assignRole('business owner');

         $restaurant = \App\Models\Restaurant::factory()->create([
            'min_price' => rand(000, 999),
            'max_price' => rand(0000, 9999),
            'user_id' => $business_owner_restaurant->id
         ]);

         for ($i=1; $i <= 10; $i++) { 
            # code...
            \App\Models\Table::factory()->create([
               'table_number' => $i,
               'restaurant_id' => $restaurant->id
            ]);
         }

         $business_owner_spot = \App\Models\User::factory()->create([
            'first_name' => 'Mark',
            'last_name' => 'Doe',
            'email' => 'mark.doe@example.com',
            'business_type' => 'tourist_spot'
         ])->assignRole('business owner');

         $spot = \App\Models\TouristSpot::factory()->create([
            'user_id' => $business_owner_spot->id,
            'price' => rand(00000, 99999)
         ]);
         
         $customer = \App\Models\User::factory()->create([
            'first_name' => 'Customer',
            'last_name' => 'Nick',
            'email' => 'customer@example.com',
            'business_type' => 'none'
         ])->assignRole('customer');

            
         // Create Multiple Business Owners for Hotel
         for ($i=0; $i <= 10; $i++) { 

            $u = \App\Models\User::factory()->create([
               'business_type' => 'hotel'
            ])->assignRole('business owner'); // Create User

            $h = \App\Models\Hotel::factory()->create([
               'user_id' => $u->id,
               'min_price' => rand(000, 999),
               'max_price' => rand(0000, 9999),
            ]);

            for ($x=1; $x <= 10; $x++) { 
               # code...
               \App\Models\Room::factory()->create([
                  'room_number' => $x,
                  'floor' => $x,
                  'hotel_id' => $h->id
               ]);
            }
         }

         // Create Multiple Business Owners for Restaurant
         for ($i=0; $i <= 10; $i++) { 

            $u = \App\Models\User::factory()->create([
               'business_type' => 'restaurant'
            ])->assignRole('business owner'); // Create User

            $h = \App\Models\Restaurant::factory()->create([
               'user_id' => $u->id,
               'min_price' => rand(000, 999),
               'max_price' => rand(0000, 9999),
            ]);

            for ($x=1; $x <= 10; $x++) { 
               # code...
               \App\Models\Table::factory()->create([
                  'table_number' => $x,
                  'restaurant_id' => $h->id
               ]);
            }
         }

         // Create Multiple Business Owners for Tourist Spots
         for ($i=0; $i <= 10; $i++) { 

            $u = \App\Models\User::factory()->create([
               'business_type' => 'tourist_spot'
            ])->assignRole('business owner'); // Create User

            $h = \App\Models\TouristSpot::factory()->create([
               'user_id' => $u->id,
               'price' => rand(00000, 99999)
            ]);
         }
         
    }
}
