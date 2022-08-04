import Alpine from 'alpinejs';
import mask from '@alpinejs/mask'
import persist from '@alpinejs/persist'

// import ToastComponent from '../../vendor/usernotnull/tall-toasts/resources/js/tall-toasts';
import './../../vendor/power-components/livewire-powergrid/dist/powergrid'
// Alpine.data('ToastComponent', ToastComponent)

Alpine.plugin(mask)
Alpine.plugin(persist)

window.Alpine = Alpine

Alpine.start()