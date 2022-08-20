<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class Navbar extends Component
{
    public string $nameOfUser;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->nameOfUser = (new User)->getNameOfUser();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar');
    }
}
