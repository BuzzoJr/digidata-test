@extends('layouts.app')
@include('layouts.navbar')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-8 card p-5">
            <div class="d-flex">
                <div class="col-3 mb-3">
                    <label class="form-label">Selecionar Status</label>
                    <select class="form-select" onchange="reloadData(this.value)" data-column="2">
                        <option value="Todos" {{ $status == 'Todos' ? 'selected' : '' }}>Todos</option>
                        <option value="Ativo" {{ $status == 'Ativo' ? 'selected' : '' }}>Ativos</option>
                        <option value="Inativo" {{ $status == 'Inativo' ? 'selected' : '' }}>Inativos</option>
                    </select>
                </div>
                <div class="col-3 mx-5">
                    <label class="form-label">Pesquisar nome</label>
                    <input class="form-control" type="text" id="nameFilter" onkeyup="nameFilter()" placeholder="Buscar nome">
                </div>
            </div>
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tableData as $data)
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->status }}</td>
                            <td>
                                <a class="btn btn-primary mx-2" href="{{ route('login.edit', $data->id) }}">Editar</a>
                                <a class="btn btn-danger"
                                    onclick="return confirm('Deseja mesmo deletar o usuário {{ $data->name }}?')"
                                    href="{{ route('login.destroy', $data->id) }}">Deletar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                <a href="{{ route('login.create') }}" class="btn btn-primary mr-3">Cadastrar Novo</a>
                <button onclick="reloadData('Todos')" class="btn btn-secondary mx-3">Limpar</button>
            </div>
            <div class="mt-4">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        function reloadData(value) {
            if (value == 'Ativo') {
                console.log('ativo')
                window.location.href = '{{ route('dashboard.index', 'Ativo') }}'
            } else if (value == 'Inativo') {
                window.location.href = '{{ route('dashboard.index', 'Inativo') }}'
            } else {
                window.location.href = '{{ route('dashboard.index') }}'
            }
        }
    </script>

    <script>
        function nameFilter() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("nameFilter");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
