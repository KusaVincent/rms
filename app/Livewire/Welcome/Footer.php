<?php

namespace App\Livewire\Welcome;

use Illuminate\Support\Facades\Request;
use Illuminate\View\View;
use Livewire\Component;

class Footer extends Component
{
    public $margin;

    public function mount():void
    {
        $this->margin = "";

        if(Request::is("/") || Request::is("properties")){
            $this->margin = "mt-10";
        }
    }

    public function render():View
    {
        return view('livewire.welcome.footer');
    }
}
