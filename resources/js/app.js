import './bootstrap';
import toast from 'toast-me';
// import Alpine from 'alpinejs';
// import { persist } from '@alpinejs/persist';
import Sortable from 'sortablejs';

// Alpine.plugin(persist);
// window.Alpine = Alpine;
window.Sortable = Sortable;

window.toast = toast;

const options = {
    position: 'bottom'
}

Livewire.on('itemAdd', (params) => {
    toast('Item Added: ' + params[0].title, options);
})

Livewire.on('itemChange', (params) => {
    toast('Item Changed: ' + params[0].title, options);
})

Livewire.on('itemDelete', () => {
    toast('Item deleted to card', options);
})
