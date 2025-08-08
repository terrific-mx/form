<?php

use Livewire\Volt\Component;
use App\Models\Form;
use App\Models\Submission;
use Livewire\Attributes\Computed;
use Flux\Flux;

new class extends Component {
    public Form $form;
    public ?Submission $selectedSubmission = null;

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

    public function showSubmissionModal(Submission $submission)
    {
        $this->authorize('view', $submission);
        $this->selectedSubmission = $submission;
        Flux::modal('submission-details')->show();
    }
}; ?>

<div>
    <div class="mb-6">
    <flux:heading level="1" size="xl">{{ $form->name }}</flux:heading>
    <flux:text class="mt-2">{{ __('Form details and recent submissions.') }}</flux:text>
</div>
    <div class="mb-6">
        <flux:input
            label="{{ __('Form Submission Endpoint') }}"
            description="{{ __('Use this as the action attribute in your HTML form.') }}"
            :value="url('/f/' . $form->ulid)"
            readonly
            copyable
        />
    </div>
    <div class="mb-6">
        <flux:heading level="2" size="lg" class="mb-4">{{ __('Submissions') }}</flux:heading>
        <flux:table :paginate="$this->submissions">
            <flux:table.columns>
                <flux:table.column>{{ __('Name') }}</flux:table.column>
                <flux:table.column>{{ __('Subject') }}</flux:table.column>
                <flux:table.column>{{ __('Message') }}</flux:table.column>
                <flux:table.column>{{ __('Date') }}</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @forelse ($this->submissions as $submission)
                    <flux:table.row :key="$submission->id">
                        <flux:table.cell>
                            <flux:button size="sm" variant="ghost" wire:click="showSubmissionModal({{ $submission->id }})">
                                 {{ $submission->getName() }}                            </flux:button>
                        </flux:table.cell>
                        <flux:table.cell>{{ $submission->getSubject() }}</flux:table.cell>
                        <flux:table.cell class="line-clamp-1">{{ $submission->getMessage() }}</flux:table.cell>
                        <flux:table.cell>{{ $submission->formatted_created_at }}</flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="3">{{ __('No submissions yet.') }}</flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>
    </div>
    <flux:modal
        name="submission-details"
        variant="flyout"
        class="md:w-96"
    >
        @if ($selectedSubmission)
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">{{ __('Submission') }} #{{ $selectedSubmission->id }}</flux:heading>
                    <flux:text class="mt-2">
                        <p><strong>{{ __('Submitted At:') }}</strong> {{ $selectedSubmission->created_at }}</p>
                    </flux:text>
                </div>
                <div>
                    <flux:heading size="md">{{ __('Data') }}</flux:heading>
                    <pre class="bg-gray-100 rounded p-2 text-xs overflow-x-auto">{{ json_encode($selectedSubmission->data, JSON_PRETTY_PRINT) }}</pre>
                </div>
                <div class="flex">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="ghost">{{ __('Close') }}</flux:button>
                    </flux:modal.close>
                </div>
            </div>
        @endif
    </flux:modal>
</div>
