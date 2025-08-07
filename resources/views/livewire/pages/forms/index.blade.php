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
    <flux:table>
        <flux:table.columns>
            <flux:table.column>Name</flux:table.column>
            <flux:table.column>Created</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach ($forms as $form)
                <flux:table.row :key="$form->id">
                    <flux:table.cell>{{ $form->name }}</flux:table.cell>
                    <flux:table.cell>{{ $form->created_at->format('Y-m-d H:i') }}</flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>
