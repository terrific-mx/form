<?php

use Livewire\Volt\Component;
use App\Models\Form;

new class extends Component {
    public $forms;

    public function mount()
    {
        $this->forms = Form::where('user_id', auth()->id())->get();
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
