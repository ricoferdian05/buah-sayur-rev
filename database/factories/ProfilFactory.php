<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'image' => 'default.jpg',
            'profil' => 'Profil singkat',
            'alamat' => 'Jalan Buah dan Sayur No.A73 Rt.01 Rw.09 Bandung, Jawa Barat',
            'telp' => '022-7501233',
            'email' => 'buahdansayur@gmail.com',
            'whatsapp' => '081222259986',
            'link_whatsapp' => 'https://www.whatsapp.com/',
            'link_facebook' => 'https://www.facebook.com/',
            'link_instagram' => 'https://www.instagram.com/',
            'link_youtube' => 'https://www.youtube.com/',
            'link_embed' => 'https://www.youtube.com/'
        ];
    }
}
