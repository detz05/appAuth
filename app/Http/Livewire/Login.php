<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class Login extends Component
{
    public $code;
    public $validCode;
    public $email;
    public $isValid = false;
    public $isEmpty = false;
    public $data;

    public function render()
    {
        $this->data = User::get();
        return view('livewire.login');
    }

    public function verifyTF()
    {
        $this->loading = true;
        if(empty($this->email)):
            $this->isEmpty = true;

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Mal!',
                'text' => 'Por favor no dejar el campo Correo electronico vacio!',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'position' => 'top-right',
            ]);
        else:
            $this->isEmpty = true;
            $code = mt_rand(10000000, 99999999);
            $checkIfExists = User::where([["email", $this->email], ['active', 1]])->first();
            if($checkIfExists):
                User::where("email", $this->email)->update([ "code_two_fa" => $code ]);
                $this->validCode = $code;
                $this->isValid = true;
                Mail::send('mail', ["code" => $code], function ($message) {
                    $message->from("$this->email", 'Prueba 2FA');
                    $message->to($this->email)->subject('Notificación');
                });
                $this->dispatchBrowserEvent('swal', [
                    'title' => 'Genial!',
                    'text' => 'Hemos enviado un código al correo para validar tu inicio de sesión',
                    'timer' => 3000,
                    'icon' => 'success',
                    'toast' => true,
                    'position' => 'top-right',
                ]);
            else:
                $this->dispatchBrowserEvent('swal', [
                    'title' => 'Mal!',
                    'text' => 'No se ha encontrado ningún registro con el correo ingresado!',
                    'timer' => 3000,
                    'icon' => 'error',
                    'toast' => true,
                    'position' => 'top-right',
                ]);
            endif;
            /*redirect("/register");*/
        endif;
        //dd($this->email);
    }

    public function delete($id)
    {
        $del = User::where("id", $id)->delete();

        if($del):
            return $this->dispatchBrowserEvent('swal', [
                'title' => 'Genial!',
                'text' => 'El usuario ha sido eliminado!',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'position' => 'top-right',
            ]);
        else:
            return $this->dispatchBrowserEvent('swal', [
                'title' => 'Mal!',
                'text' => 'No se pudo eliminar el usuario!',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'position' => 'top-right',
            ]);
        endif;
    }

    public function change($item)
    {
        $this->{$item} = $this->{$item};
    }

    public function validateLogin()
    {
        $get = User::where("email", $this->email)->first();

        if($get->code_two_fa != $this->code):
            $this->code = "";
            $this->isValid = false;
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Mal!',
                'text' => 'El código ingresado es incorrecto!',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'position' => 'top-right',
            ]);
        else:
            if (Auth::attempt(array("email" => $this->email, "password" => "123"))):
                $this->dispatchBrowserEvent('swal', [
                    'title' => 'Genial!',
                    'text' => 'Has iniciado sesión correctamente',
                    'timer' => 3000,
                    'icon' => 'success',
                    'toast' => true,
                    'position' => 'top-right',
                ]);
                // Authentication passed...
                return redirect("/home");
            else:
                $this->dispatchBrowserEvent('swal', [
                    'title' => 'Mal!',
                    'text' => 'No se pudo iniciar sesión',
                    'timer' => 3000,
                    'icon' => 'error',
                    'toast' => true,
                    'position' => 'top-right',
                ]);
            endif;
        endif;
    }

    public function resendCode()
    {
        Mail::send('mail', ["code" => $this->validCode], function ($message) {
            $message->from("$this->email", 'Prueba 2FA');
            $message->to($this->email)->subject('Notificación');
        });
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Genial!',
            'text' => 'Hemos reenviado un código al correo para validar tu registro!',
            'timer' => 3000,
            'icon' => 'success',
            'toast' => true,
            'position' => 'top-right',
        ]);
    }
}
