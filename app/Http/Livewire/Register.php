<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class Register extends Component
{
    public $name;
    public $lstname;
    public $document_type;
    public $document_number;
    public $phone;
    public $email;
    public $emailrep;
    public $terms = 0;
    public $code;
    public $codeVerify;
    public $isValid = true;
    public $finish = false;


    public function render()
    {
        return view('livewire.register');
    }

    public function verifyTF()
    {
        if(empty($this->name) && empty($this->lstname) && empty($this->document_type) && empty($this->document_number) && empty($this->phone) && empty($this->email) && empty($this->emailrep) && $this->terms != 1):
            $this->isValid = false;
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Mal!',
                'text' => 'Por favor no dejar campos vacios!',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'position' => 'top-right',
            ]);
        else:
            if($this->email != $this->emailrep):
                $this->emailrep = "";
                $this->email = "";
                $this->isValid = false;
                $this->dispatchBrowserEvent('swal', [
                    'title' => 'Mal!',
                    'text' => 'Los correo ingresado no coinciden!',
                    'timer' => 3000,
                    'icon' => 'error',
                    'toast' => true,
                    'position' => 'top-right',
                ]);
            else:
                $checkIfExist = User::where([["email", $this->email], ['active', 1]])->orWhere("document_number", $this->document_number)->first();
                if($checkIfExist):
                    $this->dispatchBrowserEvent('swal', [
                        'title' => 'Mal!',
                        'text' => 'El correo o número de documento ya está registrado en el sistema!',
                        'timer' => 3000,
                        'icon' => 'error',
                        'toast' => true,
                        'position' => 'top-right',
                    ]);
                else:
                    $code = mt_rand(10000000, 99999999);
                    $re = User::insertGetId([
                        'name' => $this->name,
                        'lstname' => $this->lstname,
                        'document_type' => $this->document_type,
                        'document_number' => $this->document_number,
                        'phone' => $this->phone,
                        'email' => $this->email,
                        'code_two_fa' => $code,
                        'active' => false
                    ]);
    
                    if(is_numeric($re)):
                        Mail::send('mail', ["code" => $code], function ($message) {
                            $message->from("$this->email", 'Prueba 2FA');
                            $message->to($this->email)->subject('Notificación');
                        });
                        $this->finish = true;
                        $this->codeVerify = $code;
                        $this->dispatchBrowserEvent('swal', [
                            'title' => 'Genial!',
                            'text' => 'Hemos enviado un código al correo para validar tu registro!',
                            'timer' => 3000,
                            'icon' => 'success',
                            'toast' => true,
                            'position' => 'top-right',
                        ]);
                    else:
                        $this->dispatchBrowserEvent('swal', [
                            'title' => 'Mal!',
                            'text' => 'Se produjo un problema al registrarse, por favor intente nuevamente!',
                            'timer' => 3000,
                            'icon' => 'error',
                            'toast' => true,
                            'position' => 'top-right',
                        ]);
                    endif;
                endif;

            endif;
        endif;
    }

    public function validateRegister()
    {
        $get = User::select("code_two_fa")->where([["document_number", $this->document_number], ['email', $this->email]])->first();

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
            User::where([["document_number", $this->document_number], ['email', $this->email]])->update([ "active" => 1 ]);
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Genial!',
                'text' => 'Su registro ha sido completado',
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'position' => 'top-right',
            ]);
            
            sleep(2);

            redirect("/");
        endif;
    }

    public function resendCode()
    {
        Mail::send('mail', ["code" => $this->codeVerify], function ($message) {
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

    public function change($item)
    {
        $this->{$item} = $this->{$item};
    }

    public function mailValid($item)
    {
        $verify = filter_var($this->{$item}, FILTER_VALIDATE_EMAIL);
        if(!$verify):
            $this->{$item} = "";
            $this->isValid = false;
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Mal!',
                'text' => 'El formato del correo ingresado es incorrecto!',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'position' => 'top-right',
            ]);
        endif;
    }
}
