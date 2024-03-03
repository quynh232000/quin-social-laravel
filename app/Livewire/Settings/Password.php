<?php

namespace App\Livewire\Settings;

use App\Models\Notification;
use Livewire\Component;
use App\Models\User;
use Hash;
use DB;

class Password extends Component
{
    public $old_password;
    public $password;
    public $password_confirmation;
    public function save()
    {
        $this->validate([
            'old_password' => "required|min:8",
            'password' => "required|min:8",
            'password_confirmation' => "required|min:8",
        ]);
        $user = User::findOrFail(auth()->id());
        // dd($user);
        if (Hash::check($this->old_password, $user->password)) {
            if ($this->password != $this->password_confirmation) {
                $this->dispatch('alert', [
                    'type' => 'error',
                    'message' => "Confirm Password doesn't match"
                ]);
            } else {
                DB::beginTransaction();
                try {
                    $user->password = Hash::make($this->password);
                    $user->save();

                    Notification::create([
                        'type' => "password_update",
                        'from_user_id' => auth()->id(),
                        'user_id' => auth()->id(),
                        'message' => 'You had changed your password successfully!',
                        'url' => "#",
                    ]);
                    $this->dispatch('alert', [
                        'type' => 'success',
                        'message' => 'Change your password successfully!'
                    ]);

                    DB::commit();
                    unset($this->old_password);
                    unset($this->password);
                    unset($this->password_confirmation);

                } catch (\Throwable $th) {
                    DB::rollBack();
                    //throw $th;
                }
            }

        } else {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => "Your old password doesn't match!"
            ]);
        }
    }
    public function render()
    {
        return view('livewire.settings.password')->extends('layouts.app');
    }
}
