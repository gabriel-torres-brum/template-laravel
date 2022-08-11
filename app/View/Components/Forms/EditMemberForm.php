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

    public bool $showPhones = false;
    public $phones = [];
    public int $countPhones = 0;

    public bool $showAddresses = false;
    public $addresses = [];
    public int $countAddresses = 0;
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

    public function addPhone()
    {
        $this->countPhones++;
        array_push($this->phones, $this->countPhones);
    }

    public function removePhone($key)
    {
        unset($this->phones[$key]);
    }

    public function addAddress()
    {
        $this->countAddresses++;
        array_push($this->addresses, $this->countAddresses);
    }

    public function removeAddress($key)
    {
        unset($this->addresses[$key]);
    }

    protected function getRolesSelectArray()
    {
        $roles = Role::whereIn('gender', [$this->item->gender, 'Ambos'])->pluck('id', 'role_name');
        $rolesArray = [];
        foreach($roles as $role_name => $id) {
            $rolesArray[] = [
                'name' => $role_name,
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
