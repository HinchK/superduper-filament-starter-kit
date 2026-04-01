<?php

namespace App\Filament\Resources\Blog\PostResource\Pages;

use App\Filament\Resources\Blog\PostResource;
use App\Filament\Resources\Blog\PostResource\Widgets\BlogPostStatsWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getSubheading(): ?string
    {
        return 'Manage your blog posts, including drafts, scheduled, and published content.';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BlogPostStatsWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }
}
