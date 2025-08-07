<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Form;
use App\Models\Submission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $form = Form::factory()->create([
            'user_id' => $user->id,
        ]);

        Submission::factory(5)->create([
            'form_id' => $form->id,
        ]);
    }
}
