<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateUserComponent extends Component
{

    public $name;
    public $email;
    public $phone;
    public $role;
    public $password;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'phone' => 'required',
        'role' => 'required',
        'password' => 'required',
    ];

    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        //get all roles apart from admin,tenant and landlord
        $roles = Role::query()
            ->whereNotIn('name', ['admin', 'tenant', 'landlord'])
            ->get();
        return view('livewire.admin.users.create-user-component', compact('roles'));
    }

    public function submit()
    {

        $this->validate();

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'phone' => $this->phone,
            ]);

            $user->assignRole($this->role);


            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            return back()->with('error', $ex->getMessage());
        }


        $this->reset('name', 'email', 'phone','password');

//        $expiresAt = now()->addDays(setting('invitation_link_expiry_days', 365));
//        $user->sendWelcomeNotification($expiresAt);

        return redirect()->route('admin.users-management.index')
            ->with('success', __('User created successfully.'));


    }
}
