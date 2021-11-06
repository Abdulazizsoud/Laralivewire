<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();
        \App\Models\SupportTicket::factory(2)->create();
        
        \App\Models\Comment::create([
            'body'=>'first comment', 
            'photo'=>'public/photos/default_img.png', 
            'user_id' => 1,
            'support_ticket_id' => 1,
        ]);
    }
}
