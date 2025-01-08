<div>
    <div class="flex">
        <div class="flex mx-auto flex-col sm:flex-row" x-data="{ active: @entangle('step') }">
            <div class="step" :class="{ 'active': parseInt(active) == 1 }">
                {{__('STEP 1')}}
            </div>
            <div class="step" :class="{ 'active': parseInt(active) == 2 || parseInt(active) == 2.5}">
                {{__('STEP 2')}}
            </div>
            <div class="step" :class="{ 'active': parseInt(active) == 3 }">
                {{__('STEP 3')}}
            </div>
        </div>
    </div>


    @if ($step == 1)
        <form wire:submit.prevent="submit" class="flex flex-col max-w-sm mx-auto">
            <x-label>{{ __('Subject') }}</x-label>
            <x-input type="text" wire:model='subject' />
            <x-input-error for="subject" />

            <x-label>{{ __('Type') }}</x-label>
            <select wire:model='type'>
                <option value="">{{ __('Seleccione') }}</option>
                <option value="person">{{ __('Person') }}</option>
                <option value="company">{{ __('Company') }}</option>
            </select>
            <x-input-error for="type" />

            <x-label>{{ __('Message') }}</x-label>
            <textarea wire:model='message'></textarea>
            <x-input-error for="message" />

            <x-button type='submit'>{{ __('Send') }}</x-button>
        </form>
    @elseif($step == 2)
        @livewire('contact.company', ['parentId' => $pk])
    @elseif($step == 2.5)
        @livewire('contact.person', ['parentId' => $pk])
    @elseif($step == 3)
        @livewire('contact.detail', ['parentId' => $pk])
    @else
        END
    @endif
</div>
