import './bootstrap';
import toast from 'toast-me';

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
