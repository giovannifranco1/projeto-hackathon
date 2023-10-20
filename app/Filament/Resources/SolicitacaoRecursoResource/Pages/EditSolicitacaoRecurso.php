<?php

namespace App\Filament\Resources\SolicitacaoRecursoResource\Pages;

use App\Filament\Resources\SolicitacaoRecursoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSolicitacaoRecurso extends EditRecord
{
    protected static string $resource = SolicitacaoRecursoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
