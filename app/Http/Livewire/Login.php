<?php

namespace App\Http\Livewire;

use Livewire\Component;
use WireUi\Traits\Actions;

class Login extends Component
{
    use Actions;

    public $username;
    public $password;

    public $rules = [
        'username' => 'required|max:50',
        'password' => 'required|max:50'
    ];

    public function render()
    {
        return view('livewire.login');
    }

    public function updated()
    {
        $this->resetErrorBag();
    }

    public function handle()
    {
        $credentials = $this->validate();

        if (!auth()->attempt($credentials)) {

            $this->notification()->error(
                $title = 'Usuário ou senha inválidos.',
                $description = 'Verifique e tente novamente.'
            );

            return $this->addError('message', 'Usuário ou senha inválidos!');
        }

        $this->notification()->success(
            $title = 'Logado com sucesso!',
        );

        return redirect()->route('app.dashboard');
    }
}
