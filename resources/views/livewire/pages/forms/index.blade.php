<?php

use Livewire\Volt\Component;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    #[\Livewire\Attributes\Computed]
    public function forms()
    {
        return Auth::user()->forms()
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);
    }
}; ?>

<div>
    <flux:heading level="1" size="xl">{{ __('Your Forms') }}</flux:heading>
    <flux:text class="mt-2 mb-6">{{ __('View and manage all forms you’ve created.') }}</flux:text>
    <flux:button :href="route('forms.create')" wire:navigate variant="primary" class="mb-6">
        {{ __('Create Form') }}
    </flux:button>
    <flux:table :paginate="$this->forms">
        <flux:table.columns>
            <flux:table.column
                sortable
                :sorted="$sortBy === 'name'"
                :direction="$sortDirection"
                wire:click="sort('name')"
            >{{ __('Name') }}</flux:table.column>
            <flux:table.column
                sortable
                :sorted="$sortBy === 'created_at'"
                :direction="$sortDirection"
                wire:click="sort('created_at')"
            >{{ __('Created') }}</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach ($this->forms as $form)
                <flux:table.row :key="$form->id">
                    <flux:table.cell>
                        <flux:link :href="route('forms.show', $form)" wire:navigate>
                            {{ $form->name }}
                        </flux:link>
                    </flux:table.cell>
                    <flux:table.cell>{{ $form->created_at->format('Y-m-d H:i') }}</flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>
