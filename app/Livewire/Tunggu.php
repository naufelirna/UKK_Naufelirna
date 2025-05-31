<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Tunggu extends Component
{
    public function mount(){
        //kalo user yg login uda punya role, langsung arahin ke dashboard
        if (Auth::user()->roles->isNotEmpty()){
            return redirect()->route('dashboard');
        }
    }

    //fungsi tambahan buat ngecek role seccara manual
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
