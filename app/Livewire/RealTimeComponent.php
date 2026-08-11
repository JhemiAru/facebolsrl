<?php

namespace App\Livewire;

use Livewire\Component;

class RealTimeComponent extends Component
{
    /* public function render()
    {
        return view('livewire.real-time-component');
    } */

     public $messages = [];
    
    protected $listeners = ['messageReceived'];
    
    public function messageReceived($message)
    {
        $this->messages[] = $message;
    }
    
    public function render()
    {
        return view('livewire.real-time-component');
    }
}
