<div>
    <form wire:submit.prevent="submit">
        <x-label>{{ __('Extra') }}</x-label>
        <textarea wire:model='extra' placeholder="Aqui pon algo"></textarea>
        <x-input-error for="extra" />

        <x-button type='submit'>{{ __('Send') }}</x-button>
    </form>
</div>
