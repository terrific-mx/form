<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.site')]
#[Title('Terrific Form — Changelog')]
class extends Component {
    //
}; ?>

<div class="space-y-8">
    <a href="{{ route('home') }}" class="block" wire:navigate>
        <x-app-logo-icon class="h-4" />
    </a>

    <h1 class="font-medium">Changelog</h1>

    <ul class="space-y-4 flex flex-col">
        <!-- <flux:link
            href="https://world.hey.com/oliver.servin/encuestas-mas-visuales-y-utiles-0a31bfeb"
            external
        >Encuestas más visuales y útiles</flux:link> -->
    </ul>
</div>
