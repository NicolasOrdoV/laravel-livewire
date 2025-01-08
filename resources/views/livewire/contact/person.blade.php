<div>
    <form wire:submit.prevent="submit">
        <x-label>{{ __('Name') }}</x-label>
        <x-input type="text" wire:model='name' />
        <x-input-error for="name" />

        <x-label>{{ __('Surname') }}</x-label>
        <x-input type="text" wire:model='surname' />
        <x-input-error for="surname" />

        <x-label>{{ __('Choices') }}</x-label>
        <select wire:model='choices'>
            <option value="">{{ __('Seleccione') }}</option>
            <option value="advert">{{ __('Advert') }}</option>
            <option value="post">{{ __('Post') }}</option>
            <option value="movie">{{ __('Movie') }}</option>
            <option value="other">{{ __('Other') }}</option>
        </select>
        <x-input-error for="choices" />

        <x-label>{{ __('Other') }}</x-label>
        <x-input type="text" wire:model='other' />
        <x-input-error for="other" />

        <x-button type='submit'>{{ __('Send') }}</x-button>
        <x-secondary-button wire:click='back'>Atras</x-secondary-button>
    </form>
</div>

