<?php

namespace App\Http\Livewire;

use App\User;
use App\categorie;
use GuzzleHttp\Client;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;    

class Edit extends Component
{
    public $ids;
    public $name;
    public $lstname;
    public $document_type;
    public $country_;
    public $street;
    public $categorie;
    public $document_number;
    public $phone;
    public $email;
    public $emailrep;
    public $terms = 0;
    public $isValid = true;
    public $finish = false;

    public $country = array();
    public $categories = array();
    public $user_country = array();


    public function mount()
    {
        $this->ids = request()->ids;
        $user = User::where("id", $this->ids)->first();
        $this->name = $user->name;
        $this->lstname = $user->lstname;
        $this->country_ = $user->country;
        $this->street = $user->street;
        $this->categorie = $user->categories_id;
        $this->document_number = $user->document_number;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->emailrep = $user->email;
        $this->document_type = $user->document_type;
        
        $this->country = array();
        $client = new Client();
        $res = $client->request('GET', 'https://api.first.org/data/v1/countries?region=South%20America');
        //dd(json_decode($res->getBody()));
        $data = json_decode($res->getBody());
        foreach ($data->data as $key => $value) {
            array_push($this->country, [
                "code" => $key,
                "country" => $value->country
            ]);
        }
        $this->categories = categorie::get();
    }

    public function render()
    {
        return view('livewire.edit');
    }

    public function verifyTF()
    {

        if(strlen($this->name) > 100 || strlen($this->lstname) > 100):
            $this->isValid = false;
            return $this->dispatchBrowserEvent('swal', [
                'title' => 'Mal!',
                'text' => 'El nombre y apellido no puede ser mayor a 100 caracteres!',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'position' => 'top-right',
            ]);
        endif;

        if(strlen($this->name) < 5 || strlen($this->lstname) < 5):
            $this->isValid = false;
            return $this->dispatchBrowserEvent('swal', [
                'title' => 'Mal!',
                'text' => 'El nombre y apellido debe tener mínimo 5 caracteres!',
                'timer' => 3000,
                'icon' => 'error',
                'toast' => true,
                'position' => 'top-right',
            ]);
        endif;


        if(empty($this->name) && empty($this->lstname) && 
            empty($this->document_type) && empty($this->document_number) && 
            empty($this->phone) && empty($this->email) && 
            empty($this->emailrep) && $this->terms != 1 &&
            empty($this->country_) && empty($this->street) &&
            empty($this->categorie)):
            $this->isValid = false;
            return $this->dispatchBrowserEvent('swal', [
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
                return $this->dispatchBrowserEvent('swal', [
                    'title' => 'Mal!',
                    'text' => 'Los correo ingresado no coinciden!',
                    'timer' => 3000,
                    'icon' => 'error',
                    'toast' => true,
                    'position' => 'top-right',
                ]);
            else:
                $checkMail = User::where("email", $this->email)->first();

                if(!empty($checkMail)):
                    $re = DB::table("users")->where("id", $this->ids)->update([
                        'name' => $this->name,
                        'lstname' => $this->lstname,
                        'document_type' => $this->document_type,
                        'document_number' => $this->document_number,
                        'phone' => $this->phone,
                        'email' => $this->email,
                        'categories_id' => $this->categorie,
                        'street' => $this->street,
                        'country' => $this->country_
                    ]);
    
                    if($re):

                        $this->finish = true;
                        $this->dispatchBrowserEvent('swal', [
                            'title' => 'Genial!',
                            'text' => 'Se ha actualizado el usuario correctamente!',
                            'timer' => 3000,
                            'icon' => 'success',
                            'toast' => true,
                            'position' => 'top-right',
                        ]);

                        sleep(1);
                        return redirect(request()->header('Referer'));
                    else:
                        return $this->dispatchBrowserEvent('swal', [
                            'title' => 'Mal!',
                            'text' => 'Se produjo un problema al actualizar el usuario, por favor intente nuevamente!',
                            'timer' => 3000,
                            'icon' => 'error',
                            'toast' => true,
                            'position' => 'top-right',
                        ]);
                    endif;
                else:
                    $checkIfExist = User::where("email", $this->email)->orWhere("document_number", $this->document_number)->first();
                    if($checkIfExist):
                        return $this->dispatchBrowserEvent('swal', [
                            'title' => 'Mal!',
                            'text' => 'El correo o número de documento ya está registrado en el sistema!',
                            'timer' => 3000,
                            'icon' => 'error',
                            'toast' => true,
                            'position' => 'top-right',
                        ]);
                    else:
                        $re = User::where("id", request("ids"))->update([
                            'name' => $this->name,
                            'lstname' => $this->lstname,
                            'document_type' => $this->document_type,
                            'document_number' => $this->document_number,
                            'phone' => $this->phone,
                            'email' => $this->email,
                            'categories_id' => $this->categorie,
                            'street' => $this->street,
                            'country' => $this->country_
                        ]);
        
                        if($re):
    
                            $this->finish = true;
                            $this->dispatchBrowserEvent('swal', [
                                'title' => 'Genial!',
                                'text' => 'Se ha actualizado el usuario correctamente!',
                                'timer' => 3000,
                                'icon' => 'success',
                                'toast' => true,
                                'position' => 'top-right',
                            ]);
    
                            sleep(1);
                            return redirect(request()->header('Referer'));
                        else:
                            return $this->dispatchBrowserEvent('swal', [
                                'title' => 'Mal!',
                                'text' => 'Se produjo un problema al actualizar el usuario, por favor intente nuevamente!',
                                'timer' => 3000,
                                'icon' => 'error',
                                'toast' => true,
                                'position' => 'top-right',
                            ]);
                        endif;
                    endif;
                endif;
                

            endif;
        endif;
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
