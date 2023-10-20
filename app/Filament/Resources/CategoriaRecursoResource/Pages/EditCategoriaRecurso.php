<?php

namespace App\Filament\Resources\CategoriaRecursoResource\Pages;

use App\Filament\Resources\CategoriaRecursoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoriaRecurso extends EditRecord
{
    protected static string $resource = CategoriaRecursoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
