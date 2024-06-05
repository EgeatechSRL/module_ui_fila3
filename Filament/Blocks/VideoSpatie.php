<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Blocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\MediaLibrary\HasMedia;

class VideoSpatie
{
    public static function make(
        string $name = 'video_spatie',
        string $context = 'form',
    ): Block {
        return Block::make($name)
            ->schema([
                Hidden::make('img_uuid')
                    ->default(fn () => Str::uuid()->toString())
                    ->formatStateUsing(fn ($state) => $state ?? Str::uuid()->toString())
                    ->live(),
                // ->required(),

                SpatieMediaLibraryFileUpload::make('image')
                    ->live()
                    ->hiddenLabel()
                    // ->imagePreviewHeight('250')
                    // ->panelLayout('integrated')
                    ->imageResizeMode('cover')
                    ->panelAspectRatio('2:1')
                    ->maxSize(102400)
                    ->disk('local')
                    ->image()
                    // ->imageEditor()
                    ->preserveFilenames()
                    // ->columnSpanFull()
                    ->openable()
                    ->previewable()
                    ->downloadable()
                    // ->rules(Rule::dimensions()->maxWidth(600)->maxHeight(800))
                    ->collection(fn (Get $get) => $get('img_uuid'))
                    ->afterStateUpdated(
                        function (HasForms $livewire, SpatieMediaLibraryFileUpload $component, TemporaryUploadedFile $state, Get $get, HasMedia $record) {
                            $livewire->validateOnly($component->getStatePath());
                            $res = $record
                                ->addMedia($state)
                                ->withResponsiveImages()
                                ->toMediaCollection($get('img_uuid'));
                        }
                    ),
                /*
                Select::make('ratio')
                    ->options(static::getRatios())
                    ->afterStateHydrated(static fn ($state, $set) => $state || $set('ratio', '4-3')),

                TextInput::make('alt')
                    ->columnSpanFull(),
                */
                TextInput::make('caption')
                // ->columnSpanFull()
                ,

                // Filament\Forms\Components\SpatieMediaLibraryFileUpload::whereCustomProperties does not exist.
                // ->whereCustomProperties(fn(Forms\Get $get) => ['gallery_id' => $get('gallery_id')])

                // ->customProperties(fn(Forms\Get $get) => ['gallery_id' => $get('gallery_id')]),

                // Forms\Components\SpatieMediaLibraryFileUpload::make('media_id')
            ])
            ->columns('form' === $context ? 2 : 1);
    }

    public static function getRatios(): array
    {
        return [
            '4-3' => '4/3',
            '3-4' => '3/4',
            'free' => 'free',
        ];
    }

    public static function getRatioClass(string $ratio): string
    {
        return match ($ratio) {
            '4-3' => 'aspect-[4/3]',
            '3-4' => 'aspect-[3/4]',
            default => '',
        };
    }
}