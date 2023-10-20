<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SolicitacaoRecursoResource\Pages;
use App\Models\CategoriaRecurso;
use App\Models\Comunidade;
use App\Models\SolicitacaoRecurso;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class SolicitacaoRecursoResource extends Resource
{
    protected static ?string $model = SolicitacaoRecurso::class;
    protected static ?string $label = 'Solicitação';
    protected static ?string $modelLabel = 'Solicitação';
    protected static ?string $navigationLabel = 'Solicitações de Recursos';
    protected static ?string $navigationGroup = 'Administrativo';
    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';

    protected static ?string $recordTitleAttribute = 'nome_comunidade';

    public static function canCreate(): bool
    {
        if (!auth()->user()->is_admin) {
            return true;
        } else {
            return false;
        }
    }
    public static function canGloballySearch(): bool
    {
        return static::$isGloballySearchable && count(static::getGloballySearchableAttributes()) && (static::canViewAny() || auth()->user()->is_admin);
    }

    public static function registerNavigationItems(): void
    {
        if (!static::shouldRegisterNavigation()) {
            return;
        }

        if (!static::canViewAny() || !auth()->user()->is_admin) {
            return;
        }

        Filament::getCurrentPanel()
            ->navigationItems(static::getNavigationItems());
    }

    public static function getNavigationBadge(): ?string
    {
        return SolicitacaoRecurso::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tab')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Dados Cadastrais')
                            ->badge(function (Comunidade $comunidade) {
                                return $comunidade->exists
                                    ? null
                                    : 'Novo';
                            })
                            ->schema([
                                Forms\Components\TextInput::make('nome_comunidade')
                                    ->required()
                                    ->label('Nome da Comunidade')
                                    ->placeholder('Nome da Comunidade')
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('nome_lider')
                                    ->required()
                                    ->label('Nome do Líder')
                                    ->placeholder('Nome do Líder')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('nome_solicitante')
                                    ->required()
                                    ->label('Nome do Solicitante')
                                    ->placeholder('Nome do Solicitante')
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Tabs\Tab::make('Localização')
                            ->schema([
                                Forms\Components\Select::make('regiao')
                                    ->label('Região')
                                    ->native(false)
                                    ->options(Comunidade::REGIOES)
                                    ->columnSpanFull()
                                    ->placeholder('Selecione uma Região')
                                    ->required(),
                                Forms\Components\TextInput::make('cidade_proxima')
                                    ->required()
                                    ->placeholder('Cidade Próxima')
                                    ->label('Cidade Próxima')
                                    ->columnSpanFull()
                                    ->maxLength(100),
                                Forms\Components\Textarea::make('descricao_localizacao')
                                    ->nullable()
                                    ->placeholder('Descrição (Ex: Ponto de Referência)')
                                    ->label('Descrição')
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('longitude')
                                    ->nullable()
                                    ->placeholder('Longitude')
                                    ->columnSpan(3)
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('latitude')
                                    ->nullable()
                                    ->placeholder('Latitude')
                                    ->columnSpan(3)
                                    ->maxLength(100),
                            ])->columns(6),
                        Forms\Components\Tabs\Tab::make('Recurso')
                            ->schema([
                                Forms\Components\Select::make('categoria_recurso_id')
                                    ->label('Recurso')
                                    ->native(false)
                                    ->options(CategoriaRecurso::pluck('nome', 'id'))
                                    ->columnSpanFull()
                                    ->placeholder('Selecione um recurso')
                                    ->required(),
                                Forms\Components\Textarea::make('descricao_recurso')
                                    ->nullable()
                                    ->placeholder('Descrição do Recurso')
                                    ->label('Descrição')
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                                Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\FileUpload::make('arquivos_imagens_evidencias')
                                            ->label('Evidências (Fotos)')
                                            ->multiple()
                                            ->image()
                                            ->imagePreviewHeight('200px')
                                            ->imageCropAspectRatio('1:1')
                                            ->directory('evidencias')
                                    ])
                            ])
                    ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome_comunidade')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nome_lider')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nome_solicitante')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge(function (SolicitacaoRecurso $solicitacaoRecurso) {
                        return $solicitacaoRecurso->status;
                    })
                    ->color(function (SolicitacaoRecurso $solicitacaoRecurso) {
                        return match ($solicitacaoRecurso->status) {
                            'Aguardando' => 'warning',
                            'Em análise' => 'warning',
                            'Aprovado' => 'success',
                            'Reprovado' => 'danger',
                        };
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('regiao')
                    ->searchable()
                    ->sortable(),
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
                Tables\Filters\SelectFilter::make('regiao')
                    ->options(Comunidade::REGIOES)
                    ->label('Região'),
                Tables\Filters\SelectFilter::make('status')
                    ->options(SolicitacaoRecurso::STATUS)
                    ->label('Status'),
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
            'index' => Pages\ListSolicitacaoRecursos::route('/'),
            'create' => Pages\CreateSolicitacaoRecurso::route('/create'),
            'edit' => Pages\EditSolicitacaoRecurso::route('/{record}/edit'),
        ];
    }
}
