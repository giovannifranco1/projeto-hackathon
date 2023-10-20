<?php

namespace App\Filament\Resources\SolicitacaoRecursoResource\Pages;

use App\Filament\Pages\Dashboard;
use App\Filament\Resources\SolicitacaoRecursoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\CreateRecord;

class CreateSolicitacaoRecurso extends CreateRecord
{
    protected static string $resource = SolicitacaoRecursoResource::class;

    protected function getRedirectUrl(): string
    {
        return auth()->user()->is_admin
            ? Dashboard::getUrl()
            : SolicitacaoRecursoResource::getUrl('create');
    }
}
