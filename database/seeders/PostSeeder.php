<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::factory(10)->create()->each(function($user){
        Post::factory(50)->create([
                'user_id'=> $user->id,
                // 'name' => 'Test User',
                // 'email' => 'test@example.com',
            ]);
        });

        
    }
}
