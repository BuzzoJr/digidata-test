@extends('layouts.app')
@section('content')
    <div class="row justify-content-center" style="margin-top: 10%;">
        <div class="card col-3 p-4">
            <h3 class="mb-5">{{ isset($isEdit) ? "Atualização de Cadastro" : 'Cadastro' }}</h3>
            <form action="{{ isset($isEdit) ? route('login.update') : route('login.store') }}" method="POST" id="register-form">
                @csrf
                <div class="form-outline mb-4">
                    <label class="form-label" for="name">Nome</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{ isset($editData) ? old('name', $editData->name) : ''}}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="email_address">E-Mail</label>
                    <input type="text" id="email_address" class="form-control" name="email" value="{{ isset($editData) ? old('email', $editData->email) : ''}}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="password">Senha</label>
                    <input type="password" id="password" class="form-control" name="password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="password_confirmation">Confirmar Senha</label>
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                        required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                @isset($isEdit)
                    <div class="form-outline mb-4">
                        <label class="form-label" for="password_confirmation">Status</label>
                        <select class="form-select" value="{{ isset($editData) ? old('status', $editData->status) : ''}}">
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                    </div>
                @endif
                    <div class="d-flex justify-content-between w-100 mt-5">
                        <a href="{{  route('dashboard.index') }}" type="button" class="btn btn-light mx-3">
                            Voltar
                        </a>
                        @if(!isset($isEdit))
                        <button type="button" class="btn btn-light mx-3" onclick="clearform()">
                            Limpar
                        </button> 
                        @endif
                        <button type="submit" class="btn btn-primary mx-3">
                            {{ isset($isEdit) ? 'Salvar' : 'Cadastrar' }}
                        </button>
                    </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function clearform(){
        document.getElementById("register-form").reset();
    }
</script>
@endsection
