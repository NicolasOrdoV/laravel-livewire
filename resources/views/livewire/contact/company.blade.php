<div>
    <form wire:submit.prevent="submit">
        <x-label>{{ __('Name') }}</x-label>
        <x-input type="text" wire:model='name' />
        <x-input-error for="name" />

        <x-label>{{ __('Identification') }}</x-label>
        <x-input type="text" wire:model='identificaction' />
        <x-input-error for="identificaction" />

        <x-label>{{ __('Email') }}</x-label>
        <x-input type="email" wire:model='email' />
        <x-input-error for="email" />

        <x-label>{{ __('Choices') }}</x-label>
        <select wire:model='choices'>
            <option value="">{{ __('Seleccione') }}</option>
            <option value="advert">{{ __('Advert') }}</option>
            <option value="post">{{ __('Post') }}</option>
            <option value="course">{{ __('Course') }}</option>
            <option value="other">{{ __('Other') }}</option>
        </select>
        <x-input-error for="choices" />

        <x-label>{{ __('Extra') }}</x-label>
        <x-input type="text" wire:model='extra' />
        <x-input-error for="extra" />

        <x-button type='submit'>{{ __('Send') }}</x-button>
        <x-secondary-button wire:click='back'>Atras</x-secondary-button>

    </form>
</div>
