<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <flux:button :href="route('forms.create')" wire:navigate variant="primary">
        New Form
    </flux:button>
    //
</div>
