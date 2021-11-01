<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $form = [
        'name' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    protected $rules = [
        'form.name' => 'required',
        'form.email' => 'required|email|unique:users,email',
        'form.password' => 'required|confirmed',
    ];

    protected $messages = [
        'form.name.required' => 'The name cannot be empty.',
        'form.email.required' => 'The Email Address cannot be empty.',
        'form.email.email' => 'The Email Address format is not valid.',
        'form.password.required' => 'The password cannot be empty.',
        'form.password.confirmed' => 'password and password confirmation are not matched.',
    ];

    public function submit()
    {
        $this->validate();
        User::create($this->form);
        return $this->redirect(route('login'));
    }

    public function render()
    {
        return view('livewire.register');
    }
}
