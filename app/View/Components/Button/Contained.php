<?php

namespace App\View\Components\Button;

use Illuminate\View\Component;

class Contained extends Component
{
    public string $color;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($variant = null)
    {
        switch ($variant) {
            case "success":
                $this->color = "green";
                break;
            case "warning":
                $this->color = "amber";
                break;
            case "info":
                $this->color = "blue";
                break;
            case "danger":
                $this->color = "red";
                break;
            default:
                $this->color = "zinc";
                break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button.contained');
    }
}
