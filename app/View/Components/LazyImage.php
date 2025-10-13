<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LazyImage extends Component
{
    public $src;
    public $alt;
    public $class;
    public $placeholder;
    public $width;
    public $height;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $src,
        string $alt = '',
        string $class = '',
        string $placeholder = null,
        string $width = null,
        string $height = null
    ) {
        $this->src = $src;
        $this->alt = $alt;
        $this->class = $class;
        $this->placeholder = $placeholder ?? 'data:image/svg+xml;base64,' . base64_encode(
            '<svg width="400" height="300" xmlns="http://www.w3.org/2000/svg"><rect width="100%" height="100%" fill="#f3f4f6"/><text x="50%" y="50%" text-anchor="middle" dy=".3em" fill="#9ca3af">Loading...</text></svg>'
        );
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.lazy-image');
    }
}
