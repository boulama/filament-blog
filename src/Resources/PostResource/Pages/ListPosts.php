<?php

namespace Firefly\FilamentBlog\Resources\PostResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Firefly\FilamentBlog\Resources\PostResource;
use Firefly\FilamentBlog\Resources\PostResource\Widgets\BlogPostPublishedChart;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BlogPostPublishedChart::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'published' => Tab::make('Published')
                ->modifyQueryUsing(function ($query) {
                    $query->published();
                })->icon('heroicon-o-check-badge'),
            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(function ($query) {
                    $query->pending();
                })
                ->icon('heroicon-o-clock'),
            'scheduled' => Tab::make('Scheduled')
                ->modifyQueryUsing(function ($query) {
                    $query->scheduled();
                })
                ->icon('heroicon-o-calendar-days'),
            'categories' => Tab::make('Blog Posts')
                ->modifyQueryUsing(function ($query) {
                    $query->whereDoesntHave('categories', function ($q) {
                        $q->where('slug', 'like', '%answer%');
                    });
                })
                ->icon('heroicon-o-bookmark'),
            'answers' => Tab::make('Answers')
                ->modifyQueryUsing(function ($query) {
                    $query->whereHas('categories', function ($q) {
                        $q->where('slug', 'answers');
                    });
                })
                ->icon('heroicon-o-question-mark-circle'),
        ];
    }
}
