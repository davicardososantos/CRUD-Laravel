@extends('layouts.admin')


@section('content')
    <div class="p-4 border-2 border-gray-200 rounded-lg mt-14">
        <div class="flex justify-between items-center w-full pb-5">
            <h1 class="text-3xl font-bold">Gerenciamento de Usuários</h1>
            <button type="button" id="add-user"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                data-bs-toggle="modal" data-bs-target="#adicionarModal">
                Adicionar Usuário
            </button>
        </div>

        <table id="users-table" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary edit-user"
                                data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}"
                                data-user-email="{{ $user->email }}" data-bs-toggle="modal"
                                data-bs-target="#adicionarModal">
                                Editar
                            </button>
                            <button type="button" class="btn btn-sm btn-danger delete-user"
                                data-user-id="{{ $user->id }}">
                                Excluir
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="modal fade" id="adicionarModal" tabindex="-1" aria-labelledby="adicionarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adicionarModalLabel">Adicionar Usuário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="user-form">
                            @csrf
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save-user">Salvar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete-confirmation-modal" tabindex="-1"
            aria-labelledby="delete-confirmation-modal-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delete-confirmation-modal-label">Confirmação de Exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza de que deseja excluir este usuário?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirm-delete">Confirmar Exclusão</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#users-table').DataTable();

            $('#users-table').on('click', '.delete-user', function() {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var userId = $(this).data('user-id');
                $('#delete-confirmation-modal').modal('show');

                $('#confirm-delete').click(function() {
                    $.ajax({
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        url: '/users/' +
                            userId,
                        success: function(response) {
                            console.log(response);
                            $('#delete-confirmation-modal').modal(
                                'hide');
                            location.reload()
                        },
                        error: function(xhr, status, error) {
                            console.log("Erro: " + error);
                        }
                    });
                });
            });

            $('#add-user').click(function() {
                $('#adicionarModalLabel').text('Adicionar Usuário');
                $('#user-form')[0].reset();
            });

            $('#save-user').click(function() {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var userData = {
                    user_id: $('#user_id').val(),
                    name: $('#name').val(),
                    email: $('#email').val(),
                };

                $.ajax({
                    method: 'POST',
                    url: '/users',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: userData,
                    success: function(response) {
                        console.log(response)
                        $('#adicionarModal').modal(
                            'hide');
                        location.reload()
                    },
                    error: function(xhr, status, error) {
                        console.log("Erro: " + error);
                    }
                });
            });

            $('#users-table').on('click', '.edit-user', function() {
                var userId = $(this).data('user-id');
                var userName = $(this).data('user-name');
                var userEmail = $(this).data('user-email');

                $('#adicionarModalLabel').text('Editar Usuário');
                $('#user_id').val(userId);
                $('#name').val(userName);
                $('#email').val(userEmail);
            });
        });
    </script>
@endsection
