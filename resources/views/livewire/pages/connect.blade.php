<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.site')]
#[Title('Terrific Form — Contacto')]
class extends Component {
    //
}; ?>

<div class="space-y-8">
    <a href="{{ route('home') }}" class="block" wire:navigate>
        <x-app-logo-icon class="h-4" />
    </a>

    <h1 class="font-medium">Contacto</h1>

    <ul class="space-y-4 flex flex-col">
        <flux:link
            href="https://x.com/oliverservinX"
            external
        >X</flux:link>
        <flux:tooltip content="oliver@terrific.com.mx">
            <flux:link
                href="mailto:oliver@terrific.com.mx"
                external
            >Email</flux:link>
        </flux:tooltip>
        <flux:tooltip content="+52 33 4474 7654">
            <flux:link
                href="tel:+52 33 4474 7654"
                external
            >Teléfono</flux:link>
        </flux:tooltip>
        <flux:link
            href="https://wa.me/523344747654"
            external
        >WhatsApp</flux:link>
    </ul>
</div>
