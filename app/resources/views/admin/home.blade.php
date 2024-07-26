@extends('layouts.admin')

@section('content')
    <div class="p-4 border-2 border-gray-200 rounded-lg mt-14">
        <div class="flex justify-between items-center w-full pb-5">
            <h1 class="text-3xl font-bold">Pesquisas</h1>
            <button type="button" id="add-survey"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                data-bs-toggle="modal" data-bs-target="#adicionarModal">
                Adicionar Pesquisa
            </button>
        </div>
        <div class="card-body">
            <table id="surveys-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Idade</th>
                        <th>Sexo</th>
                        <th>Cor</th>
                        <th>Animal</th>
                        <th>Mensagem</th>
                        <th>Data</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surveys as $survey)
                        <tr>
                            <td>{{ $survey->name }}</td>
                            <td>{{ $survey->age }}</td>
                            <td>{{ $survey->gender }}</td>
                            <td>{{ $survey->favorite_color }}</td>
                            <td>
                                <ul>
                                    @foreach ($survey->favorite_animals as $animal)
                                        <li class="my-1 flex w-1/2 items-center">
                                            <svg class="mr-2 flex-shrink-0 text-blue-500" width="20" height="20"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $animal }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $survey->message }}</td>
                            <td>{{ $survey->created_at->subHours(3)->format('d/m/Y H:i') }}</td>
                            <td>
                                <button type="button"
                                    class="btn btn-sm btn-{{ $survey->tag ? 'primary' : 'primary' }} edit-survey"
                                    data-survey-id="{{ $survey->id }}" data-survey-name="{{ $survey->name }}"
                                    data-survey-age="{{ $survey->age }}" data-survey-gender="{{ $survey->gender }}"
                                    data-survey-favorite_color="{{ $survey->favorite_color }}"
                                    data-survey-favorite_animals="{{ json_encode($survey->favorite_animals) }}"
                                    data-survey-message="{{ $survey->message }}" data-bs-toggle="modal"
                                    data-bs-target="#adicionarModal">
                                    Editar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <div class="modal fade" id="adicionarModal" tabindex="-1" aria-labelledby="adicionarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adicionarModalLabel">Adicionar Pesquisa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="survey-form">
                        @csrf
                        <input type="hidden" name="survey_id" id="survey_id">
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" class="form-control" name="name" id="name" maxlength="7">
                        </div>
                        <div class="form-group">
                            <label for="age">Idade:</label>
                            <input type="text" class="form-control" name="age" id="age" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label for="gender">Sexo:</label>
                            <select class="form-control" name="gender" id="gender">
                                <option value="">Selecione o sexo</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Qual é a sua cor favorita?</label>
                            <div class="flex mb-2">
                                <label for="color-red" class="mr-4">
                                    <input type="radio" id="color-red" name="color" value="Vermelho"
                                        class="mr-2">Vermelho
                                </label>
                                <label for="color-blue" class="mr-4">
                                    <input type="radio" id="color-blue" name="color" value="Azul" class="mr-2">Azul
                                </label>
                                <label for="color-green" class="mr-4">
                                    <input type="radio" id="color-green" name="color" value="Verde"
                                        class="mr-2">Verde
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Qual é o seu animal favorito?</label>
                            <div class="flex mb-2">
                                <label for="animal-cat" class="mr-4">
                                    <input type="checkbox" id="animal-cat" name="animal[]" value="Gato"
                                        class="mr-2">Gato
                                </label>
                                <label for="animal-dog" class="mr-4">
                                    <input type="checkbox" id="animal-dog" name="animal[]" value="Cachorro"
                                        class="mr-2">Cachorro
                                </label>
                                <label for="animal-bird" class="mr-4">
                                    <input type="checkbox" id="animal-bird" name="animal[]" value="Pássaro"
                                        class="mr-2">Pássaro
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Mensagem:</label>
                            <textarea id="message" name="message"
                                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-survey">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            var __table = $('#surveys-table').DataTable({
                dom: 'lBfrtip',

                "ordering": true,
                "oLanguage": {
                    "sLengthMenu": 'Exibindo <select>' +
                        '<option value="10">10</option>' +
                        '<option value="50">50</option>' +
                        '</select>' + ' resultados'
                },
                responsive: true,

                aaSorting: [
                    [6, "desc"]
                ],

                buttons: [{
                        text: 'Visualizar Todos',
                        className: 'btn btn-primary btn-all btn-filters btn-sm',
                        action: function(e, dt, node, config) {
                            __table.columns(3).search("").draw();
                            $(".btn-filters").addClass('btn-outline-primary');
                            $(".btn-filters").removeClass('btn-primary');
                            $(".btn-all").removeClass('btn-outline-primary');
                            $(".btn-all").addClass('btn-primary');
                        }
                    },
                    {
                        text: 'Vermelho',
                        className: 'btn btn-outline-primary btn-color-red btn-filters btn-sm',
                        action: function(e, dt, node, config) {
                            var regex = "^(?![0-9].*$)";
                            __table.columns(3).search("Vermelho").draw();
                            $(".btn-filters").addClass('btn-outline-primary');
                            $(".btn-filters").removeClass('btn-primary');
                            $(".btn-color-red").removeClass('btn-outline-primary');
                            $(".btn-color-red").addClass('btn-primary');
                        }
                    },
                    {
                        text: 'Azul',
                        className: 'btn btn-outline-primary btn-color-blue btn-filters btn-sm',
                        action: function(e, dt, node, config) {
                            var regex = "^(?![0-9].*$)";
                            __table.columns(3).search("Azul").draw();
                            $(".btn-filters").addClass('btn-outline-primary');
                            $(".btn-filters").removeClass('btn-primary');
                            $(".btn-color-blue").removeClass('btn-outline-primary');
                            $(".btn-color-blue").addClass('btn-primary');
                        }
                    },
                    {
                        text: 'Verde',
                        className: 'btn btn-outline-primary btn-color-green btn-filters btn-sm',
                        action: function(e, dt, node, config) {
                            var regex = "^(?![0-9].*$)";
                            __table.columns(3).search("Verde").draw();
                            $(".btn-filters").addClass('btn-outline-primary');
                            $(".btn-filters").removeClass('btn-primary');
                            $(".btn-color-green").removeClass('btn-outline-primary');
                            $(".btn-color-green").addClass('btn-primary');
                        }
                    },
                    {
                        extend: 'excel',
                        autoFilter: true,
                        text: 'Salvar Excel',
                        title: 'Cadastros',
                        className: 'btn  btn-outline-success btn-sm',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }
                ],
                initComplete: function() {
                    console.log("FIM");
                    $('div.dataTables_filter input').addClass("form-control");
                    $('div.dataTables_filter input').addClass("input-sm");
                    $('div.dataTables_length select').addClass("form-control");
                    $('div.dataTables_length select').addClass("input-sm");
                },
            });

            $('#save-survey').click(function() {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var surveyData = {
                    survey_id: $('#survey_id').val(),
                    name: $('#name').val(),
                    age: $('#age').val(),
                    gender: $('#gender').val(),
                    color: $('input[name="color"]:checked').val(),
                    animal: $('input[name="animal[]"]:checked').map(function() {
                        return this.value;
                    }).get(),
                    message: $('#message').val(),
                };

                $.ajax({
                    method: 'POST',
                    url: '/survey',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    contentType: 'application/json',
                    data: JSON.stringify(surveyData),
                    success: function(response) {
                        console.log("Resultado" + response)
                        $('#adicionarModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log("Erro: " + error);
                    }
                });
            });

            $('#add-survey').click(function() {
                $('#adicionarModalLabel').text('Adicionar Cadastro');
                $('#survey-form')[0].reset();
            });

            $('#surveys-table').on('click', '.edit-survey', function() {
                var surveyId = $(this).data('survey-id');
                var surveyName = $(this).data('survey-name');
                var surveyAge = $(this).data('survey-age');
                var surveyGender = $(this).data('survey-gender');
                var surveyFavoriteColor = $(this).data('survey-favorite_color');
                var surveyFavoriteAnimals = $(this).data('survey-favorite_animals');
                var surveyMessage = $(this).data('survey-message');

                $('#adicionarModalLabel').text('Editar Cadastro');
                $('#survey_id').val(surveyId);
                $('#name').val(surveyName);
                $('#age').val(surveyAge);
                $('#gender').val(surveyGender);
                $('#message').val(surveyMessage);

                $('input[name="color"][value="' + surveyFavoriteColor + '"]').prop('checked', true);
                $('input[name="animal[]"]').each(function() {
                    $(this).prop('checked', surveyFavoriteAnimals.includes($(this).val()));
                });
            });
        });
    </script>
@endsection
