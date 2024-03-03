<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Group;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Models\Faq;
use Illuminate\Database\Seeder;
use Str;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // for ($i=0; $i < 1000 ; $i++) { 
        //     User::create([
        //         'uuid'=> Str::uuid(),
        //         "first_name"=>fake()->firstname(),
        //         "last_name"=>fake()->lastname(),
        //         "username"=>"testquynh".$i,
        //         "gender"=>"male",
        //         'email_verified_at'=>now(),
        //         'mobile_verified_at'=>now(),
        //         "profile"=>"profiles/avatar.png",
        //         'thumbnail'=>"profiles/WO3LJzrOPCyuYWfFQEPFPECO7t1IjlWZixTVjuH3.jpg",
        //         "mobile"=>fake()->phonenumber(),
        //         "password"=> Hash::make('password'),
        //         'email' => fake()->safeemail(),
        //     ]);
            
        // }
        // for ($i=0; $i < 500 ; $i++) {
        //     Post::create([
        //         'uuid'=>Str::uuid(),
        //         'user_id'=>User::InRandomOrder()->first()->id,
        //         'content'=>implode(fake()->sentences(rand(2,6))),
        //         'likes'=>rand(200,10000),
        //         'comments'=>rand(200,10000),
               
        //     ]);
        //  }

        // for ($i=0; $i < 500 ; $i++) {
        //     Page::create([
        //         'uuid'=>Str::uuid(),
        //         'user_id'=>User::InRandomOrder()->first()->id,
        //         'icon'=>"pages/dIraNX2p3f5WQXyhMONukof3RR98pRbaBhJASIFZ.jpg",
        //         'thumbnail'=>"pages/BXeV5GTEQyHkJDkZSBaR0xh1TFwSUMEQRDgnFynn.jpg",
        //         'description'=>implode(fake()->sentences(rand(2,6))),
        //         'name'=>fake()->username(),
        //         'location'=>(fake()->sentence(3)),
        //         'type'=>(fake()->sentence(3)),
        //         'members'=>rand(200,10000),
        //     ]);
        // }

        // for ($i=0; $i < 500 ; $i++) {
        //     Group::create([
        //         'uuid'=>Str::uuid(),
        //         'user_id'=>User::InRandomOrder()->first()->id,
        //         'icon'=>"pages/dIraNX2p3f5WQXyhMONukof3RR98pRbaBhJASIFZ.jpg",
        //         'thumbnail'=>"pages/BXeV5GTEQyHkJDkZSBaR0xh1TFwSUMEQRDgnFynn.jpg",
        //         'description'=>implode(" ",fake()->sentences(rand(2,6))),
        //         'name'=>fake()->username(),
        //         'location'=>(fake()->sentence(3)),
        //         'type'=>(fake()->sentence(3)),
        //         'members'=>rand(200,10000),
        //     ]);
        // }

           for ($i=0; $i < 50 ; $i++) {
            Faq::create([
                'question'=>fake()->sentence(),
                'answer'=>fake()->paragraph(),
            ]);
        }

    }
}
