<?php

namespace App\Http\Livewire;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

class UsersTable extends LivewireDatatable
{
    public function builder()
    {
        //return User::all();
        return User::query();
    }

    public function columns()
    {
        //

        return [
            NumberColumn::name('id')
                ->label('ID'),
            Column::name('name')
                ->label('Name'),
            Column::name('roles.name')
                ->filterable($this->roles->pluck('name'))
                ->label('Roles'),
            // Column::name('permissions_calculated')
            //     ->filterable($this->permissions->pluck('name'))
            //     ->label('Permissions'),
            Column::callback(['id'], function ($id){
                $permissions = User::find($id)->permissions_calculated->pluck('name');
                return $permissions;
            }),

            Column::callback(['id', 'name'], function ($id, $name) {
                return view('table-actions', ['id' => $id, 'name' => $name]);
            })->unsortable(),
            //     ->filterable($this->permissions->pluck('name'))
            //     ->label('Permissions'),
            // BooleanColumn::name('email_verified_at')
            //     ->label('Email Verified')
            //     ->format()
            //     ->filterable(),

            // Column::name('name')
            //     ->defaultSort('asc')
            //     ->group('group1')
            //     ->searchable()
            //     ->hideable()
            //     ->filterable(),

            // Column::name('planet.name')
            //     ->label('Planet')
            //     ->group('group1')
            //     ->searchable()
            //     ->hideable()
            //     ->filterable($this->planets),

            // // Column that counts every line from 1 upwards, independent of content
            // Column::index($this);

            // DateColumn::name('dob')
            //     ->label('DOB')
            //     ->group('group2')
            //     ->filterable()
            //     ->hide(),

            // (new LabelColumn())
            //     ->label('My custom heading')
            //     ->content('This fixed string appears in every row'),

            // NumberColumn::name('dollars_spent')
            //     ->enableSummary(),
        ];

    }

    public function getRolesProperty()
    {
        return Role::with('permissions')->get();
    }
    public function getPermissionsProperty()
    {
        return Permission::with('roles')->get();
    }
}