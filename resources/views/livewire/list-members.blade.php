@push('pagetitle', 'Membros')

<div>
    <x-table
        model-name="Member"
        :selected-rows="$selectedRows"
        :select-all="$selectAll"
        :itens="$members"
        :itemNames="['Nome', 'Idade', 'Gênero', 'Igreja', 'Cargo']"
        :itemValues="['name', 'birthday->age', 'gender', 'church->church_name', 'role->role_name']"
    />

    <livewire:forms.edit-member-form />
</div>