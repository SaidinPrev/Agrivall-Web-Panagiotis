<?php

namespace Database\Seeders;

use App\Models\SemanaCasilla;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;

class SemanaCasillaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $start = CarbonImmutable::now()->startOfWeek();

        for ($index = 0; $index < 30; $index++) {
            $weekStart = $start->addWeeks($index)->locale('es');
            $weekEnd = $weekStart->endOfWeek();

            SemanaCasilla::firstOrCreate(
                [
                    'numero_semana' => (int) $weekStart->isoWeek(),
                    'anio' => (int) $weekStart->isoWeekYear(),
                ],
                [
                    'descriptor' => $weekStart->translatedFormat('j M') . ' - ' . $weekEnd->translatedFormat('j M'),
                    'precio' => 650,
                    'estado' => 'DISPONIBLE',
                ],
            );
        }
    }
}
