<?php

use Livewire\Volt\Component;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public $forms;

    public function mount()
    {
        $this->forms = Auth::user()->forms;
    }
}; ?>

<div>
    <flux:button :href="route('forms.create')" wire:navigate variant="primary">
        New Form
    </flux:button>
    <ul>
        @foreach ($forms as $form)
            <li>{{ $form->name }}</li>
        @endforeach
    </ul>
</div>
