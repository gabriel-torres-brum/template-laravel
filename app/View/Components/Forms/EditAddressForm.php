<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class EditAddressForm extends Component
{
    public $item;
    public $key;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($item, $key)
    {
        $this->item = $item;
        $this->key = $key;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.edit-address-form');
    }
}
