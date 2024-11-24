<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalDelete extends Component
{
    protected string $message;
    protected string $url;

    /**
     * Create a new component instance.
     */
    public function __construct(string $message = "", string $url = "")
    {
        $this->message = $message;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-delete', [
            'message' => $this->message,
            'url' => $this->url
        ]);
    }
}
