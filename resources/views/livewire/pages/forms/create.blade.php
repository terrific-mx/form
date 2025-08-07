<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <form wire:submit="save" class="space-y-6 max-w-md mx-auto mt-10">
        <flux:input
            wire:model.defer="name"
            label="Form Name"
            placeholder="Enter form name"
            required
            autofocus
            class="w-full"
        />
        <flux:button type="submit" variant="primary" class="w-full">
            Create Form
        </flux:button>
    </form>
</div>
