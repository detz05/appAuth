<div>
    <h4 class="card-title text-center">Iniciar Sesión</h4>
    <div class="col-md-12 d-flex justify-content-center">
        <div>
            @if($isValid)
            <div class="form-group">
                <input type="text" class="form-control @if(!$isEmpty) {{ empty($code) ? 'is-invalid' : '' }} @endif" wire:model="code" placeholder="Código de verificación">
            </div>
            <div class="form-group text-center">
                <button type="button" wire:click="validateLogin" class="btn btn-success">Entrar</button>
            </div>
            <div class="form-group text-center">
                <button type="button" wire:click="resendCode" class="btn btn-info">Reenviar Código</button>
            </div>
            @else
            <div class="form-group">
                <input type="text" class="form-control @if(!$isEmpty) {{ empty($email) ? 'is-invalid' : '' }} @endif" wire:model="email" wire:keydown="change('email')" placeholder="Correo electronico">
            </div>
            <div class="form-group text-center">
                <button type="button" wire:click="verifyTF" class="btn btn-success">Validar</button>
            </div>
            @endif
        </div>
    </div>
</div>
