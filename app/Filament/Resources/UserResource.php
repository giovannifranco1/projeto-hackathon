<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = 'Administrativo';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $label = 'Usuário';
    protected static ?string $navigationLabel = 'Usuários';
    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationBadge(): ?string
    {
        return User::count();
    }

    public static function isEditing()
    {
        return static::hasPage('edit');
    }

    public static function form(Form $form): Form
    {
        $ignoredUser = null;

        return $form
            ->schema([
                Grid::make(6)->schema([
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('name')
                            ->autofocus()
                            ->label('Nome')
                            ->required()
                            ->placeholder(__('Nome'))
                            ->columnSpan(3),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->label('E-mail')
                            ->required()
                            ->unique(column: 'email', ignorable: fn (User $user) => $user)
                            ->placeholder(__('E-mail'))
                            ->columnSpan(3),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->label('Senha')
                            ->autocomplete('new-password')
                            ->confirmed()
                            ->dehydrated(fn ($state) => filled($state))
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->required(fn (User $user) => !$user->exists)
                            ->placeholder(__('Senha'))
                            ->columnSpan(6),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->password()
                            ->label('Confirme a senha')
                            ->autocomplete('new-password')
                            ->placeholder(__('Confirme a senha'))
                            ->columnSpan(6),
                    ])->columnSpan([
                        'md' => 'full',
                        'lg' => 4
                    ]),
                    Grid::make()->schema([
                        Forms\Components\FileUpload::make('arquivo_avatar')
                            ->directory('images')
                            ->label(__('Avatar'))
                            ->image()
                            ->columnSpanFull()
                            ->imagePreviewHeight('220px')
                            ->preserveFilenames()

                    ])->columnSpan([
                        'md' => 'full',
                        'lg' => 2
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('arquivo_avatar')
                    ->label(__('Avatar'))
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label('Verificado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
