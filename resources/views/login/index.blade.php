@extends('layouts.app')
@section('content')
    <div class="row justify-content-center" style="margin-top: 10%;">
        <div class="card col-3 p-4">
            <h3 class="mb-5">Login</h3>
            <form class="" action="{{ route('login.post') }}" method="POST">
                @csrf
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example1">Email</label>
                    <input type="email" id="form2Example1" name="email" class="form-control" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-2">
                    <label class="form-label" for="form2Example2">Senha</label>
                    <input type="password" id="form2Example2" name="password" class="form-control" />
                </div>
                <a href="{{  route('login.create') }}" class="mb-5 mx-3 float-end">Cadastrar</a>
                <!-- Submit button -->
                <div class="d-flex justify-content-center w-100">
                    <button type="submit" class="btn btn-primary btn-block mb-4 col-6">Entrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
