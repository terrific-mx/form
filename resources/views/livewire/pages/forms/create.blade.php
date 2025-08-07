<?php

use App\Models\Form;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';

    public function submit()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:1'],
        ]);
        Form::create(['name' => $this->name]);
    }
};
?>

<div>
    <form wire:submit.prevent="submit" class="space-y-6 max-w-md mx-auto mt-10">
        <flux:input
            wire:model="name"
            label="{{ __('Form Name') }}"
            placeholder="{{ __('Enter form name') }}"
            required
            autofocus
            class="w-full"
        />
        <flux:button type="submit" variant="primary" class="w-full">
            {{ __('Create Form') }}
        </flux:button>
    </form>
</div>
