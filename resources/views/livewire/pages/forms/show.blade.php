<?php

use Livewire\Volt\Component;

use App\Models\Form;

new class extends Component {
    public Form $form;

    public function mount(Form $form)
    {
        if (auth()->id() !== $form->user_id) {
            abort(403);
        }
        $this->form = $form;
    }
}; ?>

<div>
    OK
</div>
