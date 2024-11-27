<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteConfirmation extends Component
{

    public $action;
    public $message;
    public $title;
    /**
     * Create a new component instance.
     */
    public function __construct($action, $message, $title = 'Are you sure?')
    {
        $this->action = $action;
        $this->message = $message;
        $this->title = $title;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-confirmation');
    }
}
