<?php

namespace App\Observers;

use App\Filament\Resources\SolicitacaoRecursoResource;
use App\Models\SolicitacaoRecurso;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class SolicitacaoRecursoObserver
{
    /**
     * Handle the SoliciacaoRecurso "created" event.
     */
    public function created(SolicitacaoRecurso $soliciacaoRecurso): void
    {
        Notification::make()
            ->title('Solicitação de recurso criada')
            ->success()
            ->body("A solicitação de recurso #{$soliciacaoRecurso->id} foi criada com sucesso.")
            ->actions([
                Action::make('Visualizar')
                    ->button()
                    ->url(SolicitacaoRecursoResource::getUrl('edit', [$soliciacaoRecurso]))
                    ->markAsRead(),
            ])
            ->sendToDatabase(auth()->user());
    }
}
