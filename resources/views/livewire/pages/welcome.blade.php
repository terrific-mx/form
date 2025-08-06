<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.site')]
#[Title('Terrific Form — Endpoints de formularios fáciles para cualquier sitio')]
class extends Component {
    public $demoSubmitted = false;

    #[Validate('required|email')]
    public $demoResponse = '';

    #[Validate('required')]
    public $demoMessage = '';

    public function demoSubmit()
    {
        $this->validate();

        $this->demoSubmitted = true;
    }
}; ?>

<div class="space-y-12">
    <header class="space-y-8">
        <a href="{{ route('home') }}" class="block" wire:navigate>
            <x-app-logo-icon class="h-4" />
        </a>
        <h1 class="font-medium">Endpoints de formularios fáciles para cualquier sitio o plataforma</h1>
    </header>

    <nav class="flex flex-wrap gap-4">
        <flux:link :href="route('pricing')" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20" wire:navigate>Tarifas</flux:link>

        <flux:link :href="route('changelog')" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20" wire:navigate>Changelog</flux:link>

        <flux:link :href="route('connect')" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20" wire:navigate>Contacto</flux:link>

        @if (Route::has('login'))
            @guest
                <flux:link href="{{ route('login') }}" variant="subtle" class="underline decoration-zinc-800/20 dark:decoration-white/20" wire:navigate>Iniciar sesión</flux:link>
            @endif
        @endif
    </nav>

    <div class="space-y-8">
        <p class="text-zinc-700 dark:text-zinc-200">Terrific Form te permite recibir envíos de formularios desde cualquier sitio estático, JAMstack, WordPress, Webflow o cualquier formulario HTML—sin necesidad de backend. Solo genera un endpoint, úsalo en el atributo <code>action</code> de tu formulario y Terrific Form se encarga del resto. Integración fácil y manejo confiable de envíos.</p>
        <div class="space-y-4 flex flex-col">
            @auth
                <flux:link href="{{ route('dashboard') }}" variant="primary">Ver envíos</flux:link>
            @else
                <flux:link href="{{ route('register') }}">Crear endpoint de formulario</flux:link>
            @endauth
            <flux:link
                href="https://github.com/terrific-mx/form"
                external
            >Proyecto en GitHub</flux:link>
        </div>
    </div>

    <flux:card class="bg-zinc-50 dark:bg-zinc-800">
        @if ($demoSubmitted)
            <div class="p-6 text-center text-zinc-700 dark:text-zinc-200">
                <strong>¡Gracias por tu envío!</strong>
                <div>Así funciona un formulario demo en Terrific Form.</div>
            </div>
        @else
            <form wire:submit="demoSubmit" class="space-y-6">
                <flux:input wire:model="demoResponse" label="Tu correo electrónico" required />
                <flux:input wire:model="demoMessage" label="Tu mensaje" required />
                <flux:button type="submit">Enviar formulario demo</flux:button>
            </form>
        @endif
    </flux:card>
</div>
