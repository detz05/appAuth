<div>
    <h4 class="card-title text-center">Editar {{ $ids }}</h4>
    <div class="col-md-12 d-flex justify-content-center">
        <div>
            <div class="form-group">
                <label for="">Categoria</label>
                <select class="form-control @if(!$isValid) {{ empty($categorie) ? 'is-invalid' : '' }} @endif" wire:model="categorie" wire:change="change('categorie')">
                    <option >Seleccione una Opción</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="text" maxlength="100" class="form-control only-string @if(!$isValid) {{ empty($name) ? 'is-invalid' : '' }} @endif" wire:model="name" wire:keydown="change('name')" placeholder="Nombre/s">
            </div>
            <div class="form-group">
                <input type="text" maxlength="100" class="form-control @if(!$isValid) {{ empty($lstname) ? 'is-invalid' : '' }} @endif" wire:model="lstname" wire:keydown="change('lstname')" placeholder="Apellido/s">
            </div>  
            <div class="form-group">
                <label for="">Tipo de documento</label>
                <select class="form-control @if(!$isValid) {{ empty($document_type) ? 'is-invalid' : '' }} @endif" wire:model="document_type" wire:change="change('document_type')">
                    <option >Seleccione una Opción</option>
                    <option value="1">Cédula de Identidad</option>
                    <option value="2">Documento de Extranjeria</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control only-num @if(!$isValid) {{ empty($document_number) ? 'is-invalid' : '' }} @endif" wire:model="document_number" wire:keydown="change('document_number')" placeholder="Número del Documento" maxlength="10">
            </div>
            <div class="form-group">
                <input type="text" id="phone" class="form-control @if(!$isValid) {{ empty($phone) ? 'is-invalid' : '' }} @endif" wire:model="phone" wire:keydown="change('phone')" placeholder="Número de Telefono">
            </div>
            <div class="form-group">
                <input type="text" maxlength="150" class="form-control @if(!$isValid) {{ empty($email) ? 'is-invalid' : '' }} @endif" wire:model="email" wire:keydown="change('email')" wire:change="mailValid('email')" placeholder="Correo electronico">
            </div>
            <div class="form-group">
                <input type="text" maxlength="150" class="form-control @if(!$isValid) {{ empty($emailrep) ? 'is-invalid' : '' }} @endif" wire:model="emailrep" wire:keydown="change('emailrep')" wire:change="mailValid('emailrep')" placeholder="Repita el Correo electronico">
            </div>
            <div class="form-group">
                <label for="">País</label>
                <select class="form-control @if(!$isValid) {{ empty($country_) ? 'is-invalid' : '' }} @endif" wire:model="country_" wire:change="change('country_')">
                    <option >Seleccione una Opción</option>
                    @foreach($country as $c)
                        <option value="{{ $c['code'] }}">{{ $c['country'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control @if(!$isValid) {{ empty($street) ? 'is-invalid' : '' }} @endif" wire:model="street" wire:keydown="change('street')" placeholder="Dirección">
            </div>
            <div class="form-group text-center">
                <button type="button" wire:click="verifyTF" class="btn btn-success">Actualizar</button>
            </div>
        </div>
    </div>
</div>

