<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('educations')->insert([
            'edu_name' => "MCA"
        ]);
        DB::table('educations')->insert([
            'edu_name' => "BCA"
        ]);
        DB::table('educations')->insert([
            'edu_name' => "B.Tech"
        ]);
        DB::table('educations')->insert([
            'edu_name' => "B.A. LLB."
        ]);
        DB::table('educations')->insert([
            'edu_name' => "MBA"
        ]);
        DB::table('educations')->insert([
            'edu_name' => "B.Com"
        ]);
        DB::table('educations')->insert([
            'edu_name' => "BSc"
        ]);
    }
}
