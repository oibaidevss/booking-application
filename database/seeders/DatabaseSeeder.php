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

         $business_owner_hotel = \App\Models\User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'business_type' => 'hotel'
         ])->assignRole('business owner');

         $hotel = \App\Models\Hotel::factory()->create([
            'user_id' => $business_owner_hotel->id
         ]);

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
            'user_id' => $business_owner_spot->id
         ]);

    }
}
