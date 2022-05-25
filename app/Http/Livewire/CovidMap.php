<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class CovidMap extends Component
{
    public $user;

    public function mount()
    {
        $this->permissions = Permission::all();
        $this->roles = Role::all();
        $this->user = Auth::user();

    }

    public function render()
    {
        
        return view('livewire.covid-map');
        // return <<<'blade'

        //     <div>
        //         <div>
        

        //     </div>

        // blade;
    

    }
}
