<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          DB::table('products')->insert([
           [
             'name' => 'Chocolate cake',
            'price' => '240',
            'description' => 'Beautiful Dark Chocolate',
            'category' => 'cake',
            'gallery' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=789&q=80'
            
           ],
           [
             'name' => 'Pink cake',
            'price' => '240',
            'description' => 'Sponge with cream icing',
            'category' => 'cake',
            'gallery' => 'https://images.unsplash.com/photo-1464349095431-e9a21285b5f3?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=636&q=80'
            
           ],
           [
             'name' => 'Sponge cake',
            'price' => '240',
            'description' => 'Sponge with cream icing',
            'category' => 'cake',
            'gallery' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=789&q=80'
           ],
           [
             'name' => 'Sponge cake',
            'price' => '240',
            'description' => 'Sponge with cream icing',
            'category' => 'cake',
            'gallery' => 'https://images.unsplash.com/photo-1627834377411-8da5f4f09de8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=401&q=80'
            
           ]
        ]);
    }
}
