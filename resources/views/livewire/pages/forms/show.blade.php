<?php

use Livewire\Volt\Component;

use App\Models\Form;
use App\Models\Submission;
use Livewire\Attributes\Computed;

new class extends Component {
    public Form $form;

    public function mount(Form $form)
    {
        $this->authorize('view', $form);
        $this->form = $form;
    }

    #[Computed]
    public function submissions()
    {
        return $this->form->submissions()->latest()->paginate(10);
    }
}; ?>

<div>
    <flux:input
        label="Form Submission Endpoint"
        description="Use this as the action attribute in your HTML form."
        :value="url('/f/' . $form->ulid)"
        readonly
        copyable
        class="mb-6"
    />
    <flux:heading level="1" size="xl">Submissions for Form #{{ $form->id }}</flux:heading>
    <flux:table :paginate="$this->submissions">
        <flux:table.columns>
            <flux:table.column>ID</flux:table.column>
            <flux:table.column>Submitted At</flux:table.column>
            <flux:table.column>Data</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @forelse ($this->submissions as $submission)
                <flux:table.row :key="$submission->id">
                    <flux:table.cell>{{ $submission->id }}</flux:table.cell>
                    <flux:table.cell>{{ $submission->created_at }}</flux:table.cell>
                    <flux:table.cell><pre>{{ json_encode($submission->data, JSON_PRETTY_PRINT) }}</pre></flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="3">No submissions yet.</flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>
</div>
