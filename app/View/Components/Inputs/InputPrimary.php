<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class InputPrimary extends Component
{
    public string $field;
    public string $label;
    public string $type;
    public string | null $placeholder;
    public bool $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($field, $label, $type = "text", $placeholder = null, $required = false)
    {
        $this->field = $field;
        $this->label = $label;
        $this->type = $type;
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
        return view('components.inputs.input-primary');
    }
}
