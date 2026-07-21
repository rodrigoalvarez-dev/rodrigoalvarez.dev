<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contenido')->schema([
                    FileUpload::make('hero_image')
                        ->columnSpanFull()
                        ->image()
                        ->disk('public')
                        ->directory('pages')
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
                    Select::make('parent_id')
                        ->relationship('parent', 'title')
                        ->searchable()
                        ->preload()
                        ->default(null),
                    Toggle::make('in_menu')
                        ->default(true)
                        ->required(),
                ])->columns(2),
                Section::make('SEO')->schema([
                    TextInput::make('meta_title')
                        ->maxLength(255),
                    Textarea::make('meta_description')
                        ->rows(3),
                    TextInput::make('slug')
                        ->required(),
                ])->collapsed(),
            ])->columns(1);
    }
}
