<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contents')->schema([
                    FileUpload::make('hero_image')
                        ->label('Image')
                        ->columnSpanFull()
                        ->image()
                        ->disk('public')
                        ->directory('blog')
                        ->imageEditor(),
                    TextInput::make('title')
                        ->required(),
                    RichEditor::make('content')
                        ->columnSpanFull()
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'bulletList',
                            'orderedList',
                            'link',
                            'table',
                            'h2',
                            'h3',
                            'attachFiles',
                            'undo',
                            'redo',
                        ])
                        ->maxLength(65535)
                        ->extraAttributes(['style' => 'min-height: 400px;']),
                ])->columns(1),
                Section::make('SEO')->schema([
                    TextInput::make('meta_title')
                        ->maxLength(255),
                    Textarea::make('meta_description')
                        ->rows(3),
                ])->collapsed(),
                TextInput::make('slug')
                    ->hidden()
                    ->dehydrated(false),
            ])->columns(1);

    }
}
