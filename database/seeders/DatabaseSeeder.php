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
        // \App\Models\User::factory(10)->create();

       

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

         \App\Models\Restaurant::factory()->create([
            'user_id' => $business_owner_restaurant->id
         ]);

         $customer = \App\Models\User::factory()->create(
            [  
               'email' => 'customer@example.com',
               'business_type' => 'none'
            ]
         );

         $customer->assignRole('customer');

         $owners = \App\Models\User::factory(10)->create(
            ['business_type' => 'hotel']
         );

         foreach ($owners as $key => $owner) {
            $owner->assignRole('business owner');
            \App\Models\Hotel::factory()->create([
               'user_id' => $owner->id
            ]);
         }

         $owners = \App\Models\User::factory(10)->create(
            ['business_type' => 'restaurant']
         );

         foreach ($owners as $key => $owner) {
            $owner->assignRole('business owner');
            \App\Models\Restaurant::factory()->create([
               'user_id' => $owner->id
            ]);
         }


    }
}
