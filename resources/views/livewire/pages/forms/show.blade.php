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
            :value="route('form-submissions.store', $form)"
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
                    <flux:table.row :key="$submission->id" class="hover:bg-zinc-100 dark:hover:bg-zinc-800">
                        <flux:table.cell variant="strong" class="relative">
                            {{ $submission->getName() }}
                            <button wire:click="showSubmissionModal({{ $submission->id }})" class="absolute inset-0"></button>
                        </flux:table.cell>
                        <flux:table.cell class="relative">
                            {{ $submission->getSubject() }}
                            <button wire:click="showSubmissionModal({{ $submission->id }})" class="absolute inset-0"></button>
                        </flux:table.cell>
                        <flux:table.cell class="line-clamp-1 relative">
                            {{ $submission->getMessage() }}
                            <button wire:click="showSubmissionModal({{ $submission->id }})" class="absolute inset-0"></button>
                        </flux:table.cell>
                        <flux:table.cell class="relative">
                            {{ $submission->formatted_created_at }}
                            <button wire:click="showSubmissionModal({{ $submission->id }})" class="absolute inset-0"></button>
                        </flux:table.cell>
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
                    <flux:heading level="2" size="lg">
                        {{ $selectedSubmission->getSubject() !== '—' ? $selectedSubmission->getSubject() : __('Submission') . ' #' . $selectedSubmission->id }}
                    </flux:heading>
                    <flux:text lead class="mt-2">
                        {{ $selectedSubmission->formatted_created_at }} ({{ $selectedSubmission->created_at->diffForHumans() }})
                    </flux:text>
                </div>
                <div class="space-y-4">
                    @php $fields = $selectedSubmission->getDisplayFields(); @endphp
                    @if (!empty($fields))
                        @foreach ($fields as $field)
                            <div>
                                <flux:heading level="3" class="mb-1">{{ $field['label'] }}</flux:heading>
                                @if ($field['type'] === 'email')
                                    <flux:text class="mt-1">
                                        <flux:link href="mailto:{{ $field['value'] }}">{{ $field['value'] }}</flux:link>
                                    </flux:text>
                                @elseif ($field['type'] === 'array')
                                    <ul class="pl-4 list-disc text-sm text-zinc-700 dark:text-zinc-300">
                                        @foreach ($field['value'] as $k => $v)
                                            <li><strong>{{ ucfirst(str_replace('_', ' ', $k)) }}:</strong> {{ is_array($v) ? json_encode($v) : $v }}</li>
                                        @endforeach
                                    </ul>
                                @elseif ($field['type'] === 'longtext')
                                    <pre class="bg-zinc-50 dark:bg-zinc-900 rounded p-2 text-sm whitespace-pre-wrap">{{ $field['value'] }}</pre>
                                @else
                                    <flux:text class="mt-1">{{ $field['value'] }}</flux:text>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <flux:text>{{ __('No data available for this submission.') }}</flux:text>
                    @endif
                </div>
            </div>
        @endif
    </flux:modal>
</div>
