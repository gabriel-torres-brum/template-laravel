<?php

namespace App\View\Components\Forms;

use App\Models\Church;
use App\Models\Role;
use Illuminate\View\Component;

class EditMemberForm extends Component
{
    public $item;
    public $roles;
    public $churchs;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        $this->item = $item;
        $this->roles = $this->getRolesSelectArray();
        $this->churchs = $this->getChurchsSelectArray();
    }

    protected function getRolesSelectArray()
    {
        $roles = Role::where('gender', $this->item->gender)->pluck('id', 'description');
        $rolesArray = [];
        foreach($roles as $description => $id) {
            $rolesArray[] = [
                'name' => $description,
                'id' => $id
            ];
        }
        return $rolesArray;
    } 

    protected function getChurchsSelectArray()
    {
        $churchs = Church::pluck('id', 'church_name');
        $churchsArray = [];
        foreach($churchs as $church_name => $id) {
            $churchsArray[] = [
                'name' => $church_name,
                'id' => $id
            ];
        }
        return $churchsArray;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.edit-member-form');
    }
}
