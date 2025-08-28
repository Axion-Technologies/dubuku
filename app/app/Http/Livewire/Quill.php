<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Quill extends Component
{
    public const EVENT_VALUE_UPDATED = 'quill_value_updated';

    public $value = '';
    public $quillId;

    public function mount($value = '')
    {
        $this->value = $value;
        $this->quillId = 'quill-' . uniqid();
    }

    public function updatedValue($value)
    {
        // emit to parent so it can update its property
        $this->emit(self::EVENT_VALUE_UPDATED, $this->value);
    }

    public function render()
    {
        return view('livewire.quill');
    }
}
