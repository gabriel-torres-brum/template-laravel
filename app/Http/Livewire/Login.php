<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class Login extends Component
{
    use WireToast;

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

            toast()
                ->warning('Usuário ou senha inválidos!', 'Erro ao fazer login')
                ->push();

            return back()->withErrors(['form.username', 'form.password']);
        }

        toast()
            ->success('Logado com sucesso!')
            ->pushOnNextPage();

        return redirect()->route('app.dashboard');
    }
}
