@push('pagetitle', 'Lista de cargos')

<x-table
    model-name="Role"
    :selected-rows="$selectedRows"
    :select-all="$selectAll"
    :itens="$roles"
    :itemNames="['Descrição','Gênero']"
    :itemValues="['description','gender']"
/>