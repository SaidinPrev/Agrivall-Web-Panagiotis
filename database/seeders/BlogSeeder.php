<?php

namespace Database\Seeders;

use App\Models\PostBlog;
use App\Models\TipoPost;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = collect(['Cultivos', 'Ecología', 'Cursos'])->mapWithKeys(function ($type) {
            return [$type => TipoPost::firstOrCreate(['tipo' => $type])];
        });

        $posts = [
            [
                'tipo' => 'Cultivos',
                'titulo' => 'Cómo cuidamos cada cosecha desde el origen',
                'noticia' => 'Una mirada cercana al trabajo diario en el campo y a la forma en que mantenemos el equilibrio entre producción, cuidado y respeto por la tierra.',
                'imagen' => 'imgs/worker.jpg',
            ],
            [
                'tipo' => 'Ecología',
                'titulo' => 'La llegada de la cereza a la Vall de la Gallinera',
                'noticia' => 'El inicio de la temporada marca uno de los momentos más bonitos del año: paisaje, ritmo de trabajo y fruto en su punto justo.',
                'imagen' => 'imgs/cherries.jpg',
            ],
            [
                'tipo' => 'Cursos',
                'titulo' => 'Pequeños momentos para reconectar con el entorno',
                'noticia' => 'Entre huertos, caminos y silencio, compartimos experiencias que muestran otra forma de vivir el paisaje y el tiempo.',
                'imagen' => 'imgs/casilla.png',
            ],
        ];

        foreach ($posts as $post) {
            PostBlog::updateOrCreate(
                ['titulo' => $post['titulo']],
                [
                    'tipo_post_id' => $types[$post['tipo']]->id,
                    'fecha_public' => now()->toDateString(),
                    'noticia' => $post['noticia'],
                    'imagen' => $post['imagen'],
                ],
            );
        }
    }
}
