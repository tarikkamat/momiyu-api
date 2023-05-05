<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\ProductImage;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create();
        Category::factory()->count(5)->create();

        Product::factory()->count(10)->create();
        ProductAttribute::factory()->count(10)->create();
        ProductAttributeValue::factory()->count(10)->create();
        ProductImage::factory()->count(10)->create();

        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email_verified_at' => '2021-04-30 14:00:00',
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'customer',
            'email' => 'customer@mail.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
            'email_verified_at' => '2021-04-30 14:00:00',
            'remember_token' => Str::random(10)
        ]);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'customer']);

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 4
        ]);
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 5
        ]);

        DB::table('category_product')->insert([
            'category_id' => 1,
            'product_id' => 1
        ]);
        DB::table('category_product')->insert([
            'category_id' => 1,
            'product_id' => 2
        ]);
        DB::table('category_product')->insert([
            'category_id' => 2,
            'product_id' => 3
        ]);

    }
}
