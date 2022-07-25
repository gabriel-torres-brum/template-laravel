// import './bootstrap';
import '@fortawesome/fontawesome-free/scss/fontawesome.scss';
import '@fortawesome/fontawesome-free/scss/brands.scss';
import '@fortawesome/fontawesome-free/scss/solid.scss';

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask'
import persist from '@alpinejs/persist'
 
import Swal from 'sweetalert2'

const Toast = Swal.mixin({
  toast: true,
  position: "bottom-end",
  showConfirmButton: false,
  customClass: {
    container: "!w-full sm:!max-w-[20rem]",
    popup: "!text-xs !bg-base-100 !text-base-content !ring-2 !ring-base-300",
    icon: "brightness-125",
    timerProgressBar: "!bg-primary"
  },
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener("mouseenter", Swal.stopTimer);
    toast.addEventListener("mouseleave", Swal.resumeTimer);
  },
});

window.addEventListener('alert', ({ detail: { type, message } }) => {
  Toast.fire({
    icon: type,
    title: message
  })
})

Alpine.plugin(mask)
Alpine.plugin(persist)

window.Alpine = Alpine

Alpine.start()