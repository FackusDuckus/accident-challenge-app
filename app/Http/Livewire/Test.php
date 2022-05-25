<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class Test extends Component
{
    public function mount()
    {
        $this->permissions = Permission::all();
        $this->roles = Role::all();
        $this->users = User::all();

    }

    public function render()
    {

        // return view('livewire.show-permissions',compact('permissions', 'roles'));
        return <<<'blade'

            <div>

                {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

                <livewire:users-table name="all-users" model="App\Models\User" />
        

            </div>

        blade;
    

    }
}
