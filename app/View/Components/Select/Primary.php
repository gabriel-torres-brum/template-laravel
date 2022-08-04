<?php

namespace App\View\Components\Select;

use Illuminate\View\Component;

class Primary extends Component
{
    public string $field;
    public string | null $label;
    public string | null $placeholder;
    public bool $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($field, $label = null, $placeholder = null, $required = false)
    {
        $this->field = $field;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select.primary');
    }
}
