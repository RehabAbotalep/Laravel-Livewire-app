<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $form = [
        'email' => '',
        'password' => ''
    ];

    protected $rules = [
        'form.email' => 'required|email',
        'form.password' => 'required',
    ];

    protected $messages = [
        'form.email.required' => 'The Email Address cannot be empty.',
        'form.email.email' => 'The Email Address format is not valid.',
        'form.password.required' => 'The password cannot be empty.',
    ];

    public function submit()
    {
        $this->validate();
        if(Auth::attempt($this->form)){
            return $this->redirect(route('home'));

        }else{
            session()->flash('error', 'Email or password is incorrect :(');
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
