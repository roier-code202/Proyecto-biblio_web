<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create(['name' => 'Fantasía']);
        Genre::create(['name' => 'Ciencia Ficción']);
        Genre::create(['name' => 'Drama']);
        Genre::create(['name' => 'Romance']);
        Genre::create(['name' => 'Misterio']);
        Genre::create(['name' => 'Thriller']);
        Genre::create(['name' => 'No Ficción']);
        Genre::create(['name' => 'Biografía']);
        Genre::create(['name' => 'Historia']);
        Genre::create(['name' => 'Autobiografía']);
        Genre::create(['name' => 'Filosofía']);
        Genre::create(['name' => 'Psicología']);
        Genre::create(['name' => 'Religión']);
        Genre::create(['name' => 'Cocina']);
        Genre::create(['name' => 'Viajes']);
        Genre::create(['name' => 'Infantil']);
        Genre::create(['name' => 'Juvenil']);
        Genre::create(['name' => 'Poesía']);
        Genre::create(['name' => 'Cómics']);
        Genre::create(['name' => 'Clásicos']);
        Genre::create(['name' => 'Terror']);
        Genre::create(['name' => 'Aventura']);
        Genre::create(['name' => 'Deportes']);
        Genre::create(['name' => 'Educación']);
        Genre::create(['name' => 'Tecnología']);
        Genre::create(['name' => 'Arte']);
        Genre::create(['name' => 'Música']);
        Genre::create(['name' => 'Cultura']);
        Genre::create(['name' => 'Economía']);
        Genre::create(['name' => 'Política']);
        Genre::create(['name' => 'Sociología']);
        Genre::create(['name' => 'Antropología']);
        Genre::create(['name' => 'Geografía']);
        Genre::create(['name' => 'Matemáticas']);
        Genre::create(['name' => 'Ciencias Naturales']);
        Genre::create(['name' => 'Ciencias Sociales']);
        Genre::create(['name' => 'Ciencias Formales']);
        Genre::create(['name' => 'Ciencias Aplicadas']);
        Genre::create(['name' => 'Ciencias de la Computación']);
        Genre::create(['name' => 'Ciencias de la Salud']);
        Genre::create(['name' => 'Ciencias Ambientales']);
        Genre::create(['name' => 'Ciencias Políticas']);
        Genre::create(['name' => 'Ciencias Económicas']);
        Genre::create(['name' => 'Ciencias de la Educación']);
        Genre::create(['name' => 'Novela']);
        Genre::create(['name' => 'Alta Fantasía']);
        Genre::create(['name' => 'Ciencia Ficción Espacial']);
        Genre::create(['name' => 'Ciencia Ficción Distópica']);
        Genre::create(['name' => 'Ciencia Ficción Cyberpunk']);
        Genre::create(['name' => 'Literatura Infantil']);
        Genre::create(['name' => 'Literatura Juvenil']);
        Genre::create(['name' => 'Literatura Clásica']);
        Genre::create(['name' => 'Literatura Contemporánea']);
        Genre::create(['name' => 'Literatura de Terror']);
        Genre::create(['name' => 'Literatura de Suspenso']);
        Genre::create(['name' => 'Literatura de Aventura']);
        Genre::create(['name' => 'Literatura de Ciencia Ficción']);
        Genre::create(['name' => 'Literatura de Fantasía']);
        Genre::create(['name' => 'Literatura de Romance']);
        Genre::create(['name' => 'Literatura de Misterio']);
        Genre::create(['name' => 'Literatura Fantastica']);
    }
}
