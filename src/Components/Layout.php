<?php

namespace Firefly\FilamentBlog\Components;

use Firefly\FilamentBlog\Models\Setting;
use Illuminate\View\Component;

class Layout extends Component
{

    public function __construct(
        public $post = null,
        public $og = null,
        public $data = null
    ){}

    public function render()
    {
        $setting = Setting::first();
        if($post !== null) {
            $this->og['title'] = $post->seo_detail->title ?? $post->title;
            $this->og['description'] = $post->seo_detail->description ?? $post->sub_title;
            $this->og['image'] = $post->featurePhoto ?? Storage::disk(config(('FILAMENT_FILESYSTEM_DISK')))->url($post->cover_photo_path);
        }

        return view('filament-blog::layouts.app', ['setting' => $setting, 'og' => $this->og]);
    }
}
