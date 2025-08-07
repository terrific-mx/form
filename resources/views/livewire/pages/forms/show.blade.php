<?php

use Livewire\Volt\Component;

use App\Models\Form;

new class extends Component {
    public Form $form;

    public function mount(Form $form)
    {
        $this->authorize('view', $form);
        $this->form = $form;
    }
}; ?>

<div>
    OK
</div>
