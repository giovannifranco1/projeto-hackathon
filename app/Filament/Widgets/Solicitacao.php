<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Solicitacao extends BaseWidget
{
    public static function canView(): bool
    {
        return auth()->user()->isAdmin();
    }

    protected function getStats(): array
    {
        if (!auth()->user()->is_admin) {
            return [];
        }
        return [
            Stat::make('Aguardando', \App\Models\SolicitacaoRecurso::where('status', 'Aguardando')->count())
                ->color('warning')
                ->chart([3, 2, 5, 3, 6])
                ->description('Solicitações aguardando aprovação')
                ->icon('heroicon-o-document-arrow-up'),
            Stat::make('Em análise', \App\Models\SolicitacaoRecurso::where('status', 'Em análise')->count())
                ->icon('heroicon-o-document-arrow-up')
                ->chart([30, 7, 10, 24, 30])
                ->description('Solicitações em análise')
                ->color('warning'),
            Stat::make('Aprovado', \App\Models\SolicitacaoRecurso::where('status', 'Aprovado')->count())
                ->icon('heroicon-o-document-arrow-up')
                ->description('Solicitações aprovadas')
                ->chart([20, 5, 10, 2, 50])
                ->color('success'),
            Stat::make('Reprovado', \App\Models\SolicitacaoRecurso::where('status', 'Reprovado')->count())
                ->icon('heroicon-o-document-arrow-up')
                ->chart([1, 1, 5, 3, 40])
                ->description('Solicitações reprovadas')
                ->color('danger'),
        ];
    }
}
