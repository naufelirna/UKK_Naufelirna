<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Tunggu extends Component
{
    public function mount(){
        if (Auth::user()->roles->isNotEmpty()){
            return redirect()->route('dashboard');
        }
    }

    public function checkRoles(){
        if (Auth::user()->roles->isNotEmpty()){
            $this->redirectRoute('dashboard');
        }
    }
    
    public function render()
    {
        return view('livewire.tunggu');
    }
}
