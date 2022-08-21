<?php

namespace App\Http\Livewire\Members;

use App\Models\Address;
use App\Models\Church;
use App\Models\Member;
use App\Models\Phone;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class Update extends Component
{
    use Actions;

    public Member $member;
    public User $user;
    
    public bool $showAddPhones = false;
    public Collection $phones;
    public bool $showAddAddresses = false;
    public Collection $addresses;

    public $roles;
    public $churches;

    public bool $show = false;

    public $rules = [
        'member.name' => 'required|min:3|max:50',
        'member.gender' => 'required|string',
        'member.birthday' => 'required|date|min:10',
        'member.tither' => 'required|boolean',
        'member.role_id' => 'nullable|exists:roles,id',
        'member.church_id' => 'nullable|exists:churches,id',
        'user.username' => 'required',
        'user.email' => 'required',
        'user.admin' => 'boolean',
        'phones.*.phone_number' => 'required|string|min:14|max:15',
        'addresses.*.address_name' => 'required|max:50',
        'addresses.*.number' => 'required|max:50',
        'addresses.*.adjunct' => 'max:50',
        'addresses.*.district' => 'required|max:50',
        'addresses.*.city' => 'required|max:50',
        'addresses.*.state' => 'required|max:2',
        'addresses.*.cep' => 'required|max:9',
    ];

    public $messages = [
        'member.name.required' => 'O campo nome é obrigatório',
        'member.name.min' => 'O campo nome deve ter, no mínimo, 3 caracteres',
        'member.name.max' => 'O campo nome não pode ser superior a 50 caracteres',
        'member.birthday.required' => 'O campo data de nascimento é obrigatório',
        'member.birthday.min' => 'O campo data de nascimento é obrigatório',
        'member.role_id.exists' => 'O cargo informado não está cadastrado no sistema',
        'member.church_id.exists' => 'A igreja informada não está cadastrada no sistema',
        'user.username.required' => 'O campo usuário é obrigatório',
        'user.username.unique' => 'Usuário já existe',
        'user.username.min' => 'O campo usuário deve ter, no mínimo, 3 caracteres',
        'user.username.max' => 'O campo usuário não pode ser superior a 50 caracteres',
        'user.admin.boolean' => 'O campo administrador deve ser informado',
        'phones.*.phone_number.required' => 'Número de telefone inválido',
        'phones.*.phone_number.min' => 'Número de telefone inválido',
        'phones.*.phone_number.max' => 'Número de telefone inválido',
        'addresses.*.address_name.required' => 'O campo endereço é obrigatório',
        'addresses.*.address_name.max' => 'O campo endereço não pode ser superior a 50 caracteres',
        'addresses.*.number.required' => 'O campo número é obrigatório',
        'addresses.*.number.max' => 'O campo número não pode ser superior a 50 caracteres',
        'addresses.*.address_name.max' => 'O campo complemento não pode ser superior a 50 caracteres',
        'addresses.*.district.required' => 'O campo bairro é obrigatório',
        'addresses.*.district.max' => 'O campo bairro não pode ser superior a 50 caracteres',
        'addresses.*.city.required' => 'O campo cidade é obrigatório',
        'addresses.*.city.max' => 'O campo cidade não pode ser superior a 50 caracteres',
        'addresses.*.state.required' => 'O campo uf é obrigatório',
        'addresses.*.state.max' => 'O campo uf não pode ser superior a 2 caracteres',
        'addresses.*.cep.required' => 'O campo cep é obrigatório',
        'addresses.*.cep.max' => 'O campo cep não pode ser superior a 9 caracteres',
    ];

    public $listeners = [
        'members::update' => 'show',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function render()
    {
        $this->roles = $this->getRolesToRenderFormSelect();
        $this->churches = $this->getChurchesToRenderFormSelect();

        return view('livewire.members.update');
    }

    public function show($id)
    {
        $this->member = Member::find($id);
        $this->user = User::find($this->member->user_id);

        $this->showAddPhones = false;
        $this->showAddAddresses = false;

        $this->phones = collect($this->member->phones->toArray());
        $this->addresses = collect($this->member->addresses->toArray());

        $this->roles = $this->getRolesToRenderFormSelect();
        $this->churches = $this->getChurchesToRenderFormSelect();

        $this->show = true;
    }

    public function addPhone()
    {
        $this->phones->push([]);
    }

    public function removePhone($key)
    {
        $this->phones->pull($key);
    }
    
    public function addAddress()
    {
        $this->addresses->push([]);
    }

    public function removeAddress($key)
    {
        $this->addresses->pull($key);
    }

    public function save()
    {
        $this->validate([
            'user.username' => [
                'required',
                'min:3',
                'max:50',
                Rule::unique('users', 'username')->ignoreModel($this->user)
            ],
            'user.email' => [
                'required',
                'email',
                'max:50',
                Rule::unique('users', 'email')->ignoreModel($this->user)
            ],
        ]);

        // $this->user->password = Hash::make('123456');

        // try {
        $this->user->save();
        
        if ($this->member->save()) {
            Phone::where('member_id', $this->member->id)->delete();
            Address::where('member_id', $this->member->id)->delete();

            foreach ($this->phones as $phone) {
                $phone['member_id'] = $this->member->id;

                Phone::create($phone);
            }
            foreach ($this->addresses as $address) {
                $address['member_id'] = $this->member->id;

                Address::create($address);
            }

            // Chamar observer que envia link de redefinição de senha por email
        }
        

        $this->notification()->success('Membro atualizado com sucesso!');
        // }
        // catch (\Throwable) {
        //     $this->notification()->error('Erro ao adicionar membro, tente novamente mais tarde.');
        // }

        $this->resetForm();
        $this->show = false;
        $this->emit('members::index::reset-table');
    }

    public function resetForm()
    {
        $this->member = new Member;
        $this->user = new User;

        $this->showAddPhones = false;
        $this->showAddAddresses = false;

        $this->fill([
            'phones' => collect([]),
            'addresses' => collect([]),
        ]);

        $this->resetErrorBag();
    }

    public function updated($field)
    {
        $this->resetErrorBag($field);
    }

    protected function getRolesToRenderFormSelect(): array
    {
        $roles = Role::query()->whereIn('gender', [$this->member->gender ?? null, 'Ambos'])->pluck('id', 'role_name');

        $rolesArray = array([
            'name' => 'Selecione',
            'id' => null
        ]);

        foreach ($roles as $role_name => $id) {
            $rolesArray[] = [
                'name' => $role_name,
                'id' => $id
            ];
        }

        return $rolesArray;
    }

    protected function getChurchesToRenderFormSelect()
    {
        $churches = Church::pluck('id', 'church_name');
        
        $churchesArray = array([
            'name' => 'Selecione',
            'id' => null
        ]);

        foreach ($churches as $church_name => $id) {
            $churchesArray[] = [
                'name' => $church_name,
                'id' => $id
            ];
        }
        return $churchesArray;
    }
}
