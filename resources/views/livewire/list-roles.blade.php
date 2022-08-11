@push('pagetitle', 'Cargos')

<x-table
    model-name="Role"
    :selected-rows="$selectedRows"
    :select-all="$selectAll"
    :itens="$roles"
    :itemNames="['Cargo', 'Gênero', 'Quantidade']"
    :itemValues="['description', 'gender', 'members->count()']"
/>