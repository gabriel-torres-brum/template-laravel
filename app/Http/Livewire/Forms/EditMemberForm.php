<?php

namespace App\Http\Livewire\Forms;

use App\Models\Address;
use App\Models\Church;
use App\Models\Member;
use App\Models\Phone;
use App\Models\Role;
use Livewire\Component;
use WireUi\Traits\Actions;

class EditMemberForm extends Component
{
    use Actions;

    public $item;
    public $roles;
    public $churches;

    public $phone = [
        'phone_number' => '',
    ];
    public $phones = [];
    public bool $showPhonesModal = false;

    public $addresses = [];
    public bool $showAddressesModal = false;
    
    public bool $showForm = false;

    public $listeners = [
        'modal-edit' => 'showForm',
    ];

    public $rules = [
        'item.name' => 'required|max:50',
        'item.gender' => 'required',
        'item.birthday' => 'required|date',
        'item.tither' => 'required',
        'item.user_id' => 'required|exists:users,id',
        'item.role_id' => 'exists:roles,id',
        'item.church_id' => 'required|exists:churches,id',
        'item.user.username' => 'required|max:50',
        'item.user.email' => 'required|max:50',
        'item.user.admin' => 'required|max:50',
        'phones.*.phone_number',
    ];

    public function showForm($id)
    {
        $this->item = Member::find($id)->loadMissing('user', 'phones', 'addresses');

        $this->showForm = true;

        $this->phones = Phone::where('member_id', $this->item->id)->get()->toArray();
        $this->addresses = Address::where('member_id', $this->item->id)->get()->toArray();

        $this->roles = $this->getRolesSelectArray();
        $this->churches = $this->getChurchesSelectArray();
    }

    public function addPhone()
    {
        $this->phones[] = $this->phone;
    }

    public function removePhone($key)
    {
        unset($this->phones[$key]);
    }

    public function save()
    {
        $this->validate();
        
        dd($this->phones);

        $this->showForm = false;
        
        Phone::whereIn('member_id', $this->item->id)->delete();
        
        foreach($this->phones as $phone) {
            $this->item->phones()->save((new Phone)->fill($phone));
        }

        if ($this->item->push()) {
            $this->emit('reset-table');
            return $this->notification()->success(
                $title = 'Salvo com sucesso!',
            );
        }
        $this->notification()->error(
            $title = 'Erro ao salvar, tente novamente mais tarde.',
        );
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

    protected function getChurchesSelectArray()
    {
        $churches = Church::pluck('id', 'church_name');
        $churchesArray = [];
        foreach($churches as $church_name => $id) {
            $churchesArray[] = [
                'name' => $church_name,
                'id' => $id
            ];
        }
        return $churchesArray;
    }
    public function render()
    {
        return view('livewire.forms.edit-member-form');
    }
}
