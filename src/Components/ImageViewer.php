<?php

namespace Firefly\FilamentBlog\Components;

use Filament\Forms\Components\Field;
use Closure;

class ImageViewer extends Field
{
    protected string $view = 'filament-blog::components.image-viewer';

    protected string | Closure $image = '';

    public function image(string | Closure $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getImage(): string|array|null
    {
        return $this->evaluate($this->image);
    }
}
