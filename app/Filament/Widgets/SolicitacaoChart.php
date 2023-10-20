<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class SolicitacaoChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    public static function canView(): bool
    {
        return auth()->user()->isAdmin();
    }

    protected function getData(): array
    {
        if (!auth()->user()->is_admin) {
            return [];
        }
        return [
            'labels' => ['Aguardando', 'Em análise', 'Aprovado', 'Reprovado'],
            'datasets' => [
                [
                    'label' => 'Solicitações',
                    'backgroundColor' => ['#FFCE56', '#FFCE56', '#FFCE56', '#FF6384'],
                    'borderColor' => ['#FFCE56', '#FFCE56', '#FFCE56', '#FF6384'],
                    'data' => [
                        \App\Models\SolicitacaoRecurso::where('status', 'Aguardando')->count(),
                        \App\Models\SolicitacaoRecurso::where('status', 'Em análise')->count(),
                        \App\Models\SolicitacaoRecurso::where('status', 'Aprovado')->count(),
                        \App\Models\SolicitacaoRecurso::where('status', 'Reprovado')->count(),
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
