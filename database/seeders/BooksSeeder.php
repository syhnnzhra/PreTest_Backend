<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Book;
use GuzzleHttp\Client;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer 116|4CnfMDpn1NYdjceSuf3JYjEkzUB7ajyluGbcMLXd'
        ])->get('https://book-crud-service-6dmqxfovfq-et.a.run.app/api/books');
        
        if ($response->successful()) {
            $data = $response->json();
            $apiBooks = $data['data'] ?? [];
    
            foreach ($apiBooks as $apiBook) {
                Book::create([
                    'id' => $apiBook['id'],
                    'isbn' => $apiBook['isbn'],
                    'title' => $apiBook['title'],
                    'subtitle' => $apiBook['subtitle'],
                    'author' => $apiBook['author'],
                    'published' => $apiBook['published'],
                    'publisher' => $apiBook['publisher'],
                    'pages' => $apiBook['pages'],
                    'description' => $apiBook['description'],
                    'website' => $apiBook['website'],
                    'created_at' => $apiBook['created_at'],
                    'updated_at' => $apiBook['updated_at'],
                ]);
            }
            
            $this->command->info('Books seeded successfully!');
        } else {
            $this->command->error('Failed to fetch books from the API');
        }
    }
}
