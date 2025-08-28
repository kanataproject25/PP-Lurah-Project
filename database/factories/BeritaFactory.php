<?php

namespace Database\Factories;

use App\Models\Berita;
use Illuminate\Database\Eloquent\Factories\Factory;

class BeritaFactory extends Factory
{
    protected $model = Berita::class;

    public function definition()
    {
        return [
            'judul' => $this->faker->sentence(3),
            'isi' => $this->faker->paragraph(5),
            'tanggal' => $this->faker->date(),
            'headline' => $this->faker->sentence(2),
            'deskripsi' => $this->faker->sentence(8),
            'image_path' => null,
        ];
    }
} 