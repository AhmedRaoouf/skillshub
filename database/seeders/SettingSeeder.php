<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            "email"=> "contact@skillshub.com",
            "phone"=> "+201023456789",
            "facebook"=> "http://www.facebook.com",
            "instagram"=> "http://www.instagram.com",
            "youtube"=> "http://www.youtube.com",
            "linkedin"=> "http://www.linkedin.com", 
        ]);
    }
}
