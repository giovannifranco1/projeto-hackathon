<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaRecursoResource\Pages;
use App\Filament\Resources\CategoriaRecursoResource\RelationManagers;
use App\Models\CategoriaRecurso;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoriaRecursoResource extends Resource
{
    protected static ?string $model = CategoriaRecurso::class;
    protected static ?string $navigationGroup = 'Administrativo';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $recordTitleAttribute = 'nome';

    public static function getNavigationBadge(): ?string
    {
        return CategoriaRecurso::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Recurso')
                    ->description('Insira as informações da categoria do recurso.')
                    ->schema([
                        Forms\Components\TextInput::make('nome')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('descricao')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Checkbox::make('is_evidencia_required')
                            ->default(false)
                            ->label('É necessário enviar evidência?'),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategoriaRecursos::route('/'),
            'create' => Pages\CreateCategoriaRecurso::route('/create'),
            'edit' => Pages\EditCategoriaRecurso::route('/{record}/edit'),
        ];
    }
}
