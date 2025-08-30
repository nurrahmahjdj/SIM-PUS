<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KaryaIlmiahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'judul' => $this->faker->sentence(mt_rand(6,8)),
            'slug' => $this->faker->slug(),
            'user_id' => mt_rand(2,7),
            'tipe' => $this->faker->randomElement(array ('Jurnal','Skripsi / Tugas Akhir')),
            'rumpun_id' => mt_rand(1,3),
            'kata_kunci' => $this->faker->sentence(mt_rand(1, 3)),
            'penulis' => $this->faker->name(),
            'referensi' => $this->faker->sentence(mt_rand(4, 8)),
            'abstrak' => $this->faker->sentence(mt_rand(60, 140)),
        ];
    }
}
