<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Login extends Component
{
    public $form = [
        'username' => '',
        'password' => ''
    ];

    public function render()
    {
        return view('livewire.login');
    }

    public function updated($form)
    {
        $this->resetErrorBag($form);
    }

    public function handle()
    {
        $this->validate([
            'form.username' => 'required|max:50',
            'form.password' => 'required|max:50'
        ]);

        if (!auth()->attempt($this->form)) {

            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => "Usuário ou senha inválidos!"
            ]);

            return back()->withErrors(['form.username', 'form.password']);
        }
        return redirect()->route('app.dashboard')->with(['success' => "Bem vindo !"]);
    }
}
