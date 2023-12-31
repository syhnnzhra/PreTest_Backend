<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://book-crud-service-6dmqxfovfq-et.a.run.app/api/users',[
            'Accept' => 'application/json',
            'Authorization' => 'Bearer 116|4CnfMDpn1NYdjceSuf3JYjEkzUB7ajyluGbcMLXd'
        ]);

        if ($response->successful()) {
            $usersData = $response->json();

            if (is_array($usersData) || is_object($usersData)) {
                foreach ($usersData as $userData) {
                    User::create([
                        'name' => $userData['name'],
                        'email' => $userData['email'],
                        'password' => $userData['password'],
                        'password_confirmation' => $userData['password_confirmation']
                    ]);
                }
            } else {
                $this->command->error('Invalid data format received from the API.');
            }
        } else {
            $this->command->error('Failed to fetch data from the API.');
        }
    }
}
