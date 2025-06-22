<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Alice Johnson',
                'review' => 'Pelayanan sangat cepat dan makanannya enak! Akan pesan lagi.',
                'rating' => 5,
            ],
            [
                'name' => 'Budi Santoso',
                'review' => 'Porsi pas, harga bersahabat. Recommended banget!',
                'rating' => 4,
            ],
            [
                'name' => 'Carla Devina',
                'review' => 'Tim sangat responsif, pengalaman saya luar biasa.',
                'rating' => 5,
            ],
            [
                'name' => 'Daniel Lee',
                'review' => 'Secara keseluruhan oke, tapi pengiriman agak lambat.',
                'rating' => 3,
            ],
            [
                'name' => 'Eka Putri',
                'review' => 'Sangat puas! Cocok buat kebutuhan katering kantor.',
                'rating' => 4,
            ],
            [
                'name' => 'Fadli Rahman',
                'review' => 'Kualitas makanan konsisten dan selalu fresh.',
                'rating' => 5,
            ],
            [
                'name' => 'Grace Natalia',
                'review' => 'Porsi terlalu sedikit untuk saya, tapi rasa oke.',
                'rating' => 3,
            ],
            [
                'name' => 'Hendra Wijaya',
                'review' => 'Customer service ramah dan membantu. Terima kasih!',
                'rating' => 4,
            ],
            [
                'name' => 'Ira Kurnia',
                'review' => 'Pengemasan rapi dan higienis, sangat terpercaya.',
                'rating' => 5,
            ],
            [
                'name' => 'Joko Prasetyo',
                'review' => 'Butuh variasi menu lebih banyak. Selebihnya oke.',
                'rating' => 4,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::create([
                'id' => Str::uuid(),
                'name' => $data['name'],
                'review' => $data['review'],
                'rating' => $data['rating'],
            ]);
        }
    }
}
