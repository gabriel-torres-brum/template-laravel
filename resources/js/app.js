import Alpine from 'alpinejs';
import mask from '@alpinejs/mask'
import persist from '@alpinejs/persist'
import collapse from '@alpinejs/collapse'

// import ToastComponent from '../../vendor/usernotnull/tall-toasts/resources/js/tall-toasts';
// Alpine.data('ToastComponent', ToastComponent)

Alpine.plugin(mask)
Alpine.plugin(persist)
Alpine.plugin(collapse)

window.Alpine = Alpine

Alpine.start()