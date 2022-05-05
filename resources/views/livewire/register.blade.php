<div>
    <h4 class="card-title text-center">Registrarse</h4>
    <div class="col-md-12 d-flex justify-content-center">
        @if($finish)            
        <div>
            <div class="form-group">
                <input type="number" class="form-control @if(!$isValid) {{ empty($code) ? 'is-invalid' : '' }} @endif" wire:model="code" placeholder="Código 2FA">
            </div>
            <div class="form-group text-center">
                <button type="button" wire:click="validateRegister" class="btn btn-success">Finalizar</button>
            </div>
            <div class="form-group text-center">
                <button type="button" wire:click="resendCode" class="btn btn-info">Reenviar Código</button>
            </div>
        </div>
        @else
        <div>
            <pre>
                {{ $terms }}
            </pre>
            <div class="form-group">
                <input type="text" class="form-control @if(!$isValid) {{ empty($name) ? 'is-invalid' : '' }} @endif" wire:model="name" wire:keydown="change('name')" placeholder="Nombre/s">
            </div>
            <div class="form-group">
                <input type="text" class="form-control @if(!$isValid) {{ empty($lstname) ? 'is-invalid' : '' }} @endif" wire:model="lstname" wire:keydown="change('lstname')" placeholder="Apellido/s">
            </div>
            <div class="form-group">
                <label for="">Tipo de documentto</label>
                <select class="form-control @if(!$isValid) {{ empty($document_type) ? 'is-invalid' : '' }} @endif" wire:model="document_type" wire:change="change('document_type')">
                    <option >Seleccione una Opción</option>
                    <option value="1">Cédula de Identidad</option>
                    <option value="2">Documento de Extranjeria</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control @if(!$isValid) {{ empty($document_number) ? 'is-invalid' : '' }} @endif" wire:model="document_number" wire:keydown="change('document_number')" placeholder="Número del Documento" maxlength="10">
            </div>
            <div class="form-group">
                <input type="text" id="phone" class="form-control @if(!$isValid) {{ empty($phone) ? 'is-invalid' : '' }} @endif" wire:model="phone" wire:keydown="change('phone')" placeholder="Número de Telefono">
            </div>
            <div class="form-group">
                <input type="text" class="form-control @if(!$isValid) {{ empty($email) ? 'is-invalid' : '' }} @endif" wire:model="email" wire:keydown="change('email')" wire:change="mailValid('email')" placeholder="Correo electronico">
            </div>
            <div class="form-group">
                <input type="text" class="form-control @if(!$isValid) {{ empty($emailrep) ? 'is-invalid' : '' }} @endif" wire:model="emailrep" wire:keydown="change('emailrep')" wire:change="mailValid('emailrep')" placeholder="Repita el Correo electronico">
            </div>
            <div class="form-check">
                <input class="form-check-input @if(!$isValid) {{ empty($terms) ? 'is-invalid' : '' }} @endif" type="checkbox" wire:model="terms" wire:change="change('terms')" wire:click="change('terms')" />
                <label class="form-check-label" for="defaultCheck1">
                  Acepto los <a href="#">Términos y Condiciones</a>
                </label>
            </div>
            <div class="form-group text-center">
                <button type="button" wire:click="verifyTF" class="btn btn-success">Validar</button>
            </div>
        </div>
        @endif
    </div>
</div>

