<?php

namespace App\View\Components\Public;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Seo extends Component
{
    /** @param array<string, mixed>|null $schema */
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public ?string $image = null,
        public string $type = 'website',
        public ?string $canonical = null,
        public ?array $schema = null,
    ) {
        $this->title = $title ?: config('app.name');
        $this->description = $description ?: 'Authentic yoga classes, pranayama, meditation, and holistic wellness guidance with Yogacharya Deepashree Gaur.';
        $this->image = $image ?: asset('images/og-wellness.jpg');
        $this->canonical = $canonical ?: url()->current();
    }

    public function render(): View
    {
        return view('components.public.seo');
    }
}
