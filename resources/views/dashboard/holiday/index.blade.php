@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-striped table-hover table-bordered dataTable gx-0" id="Holidays-table">
        <thead>
        <tr>
            <th class="sorting" scope="col">#</th>
            <th class="sorting" scope="col">Description</th>
            <th class="sorting" scope="col">Date</th>
            <th class="sorting" scope="col">Location</th>
            <th class="sorting" scope="col" style="width: 10%">Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="modalHoliday" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #205000; color:#ffffff;">
                <h5 class="modal-title" id="titleCadastroHoliday">Cadastro de Holiday</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="setHolidayNull()"></button>
            </div>
            <div class="modal-body">
                <form id="dataHolidays">
                    <div class="form-floating mb-3">
                        <input class="form-control" readonly="readonly" id="holidayID" name="id" type="hidden" placeholder="ID"/>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="title" type="text" name="title" placeholder="CNPJ"/>
                        <label for="title">Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="description" name="description" type="text" placeholder="CNPJ"></textarea>
                        <label for="descricao">Description</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="date" name="date" type="date" placeholder="CNPJ"/>
                        <label for="descricao">Date</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="participants" name="participants"type="text" placeholder="CNPJ"/>
                        <label for="descricao">Participants</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="BtnCloseModalCadastroHoliday" class="btn btn-secondary" data-bs-dismiss="modal"
                        onclick="setHolidayNull()">Fechar
                </button>
                <button type="button" id="save_edit" class="btn btn-primary" onclick="saveHoliday()">Save
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    var HolidayCadastroTable = null;

    function saveHoliday() {
        let idHoliday = $('#holidayID').val();

        let url = '';
        let type = 'POST';
        let urlStore = '{{route('holiday.store')}}';
        let urlUpdate = '{{route('holiday.update',['#ID#'])}}';
        let serialized = $('#dataHolidays').serialized();

        if (idHoliday.length > 0) {
            url = urlUpdate;
            url = url.replace('#ID#', idHoliday);
            type = 'PUT';
        } else {
            url = urlStore;
        }

        $.ajax({
            type: type,
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function (data) {
                console.log(data);

            },
            error: function (data) {
                console.log(data);
            }
        });
    }

    function editHoliday(prID) {
        let url = '{{route('holiday.show', ['idObjeto'])}}'
        url = url.replace('idObjeto', prID);
        $.ajax({
            type: 'GET',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                console.log(data);
                $('#modalCadastroHoliday').modal("show")
                $('#titleCadastroHoliday').text("Editar Holiday");
                $('#HolidayidHoliday').val(data._id);
                $('#codigoHoliday').val(data.ref);
                $('#Holidaydescricao').val(data.descricao);
                $('#Holidayativo').prop('checked', data.ativo);
            }
        });
    }

    function setHolidayNull() {
        $('#dataHolidays').each(function () {
            this.reset();
        })
        document.getElementById('BtnCloseModalCadastroHoliday').click();
    }
</script>
<script>
    $(function () {
        let ajaxUrl = '{!! route('holiday.create') !!}';
        HolidayCadastroTable = $('#Holidays-table').DataTable({
            autoWidth: false,
            processing: true,
            serverSide: false,
            ajax: ajaxUrl,
            order: [[0, 'desc']],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'description', name: 'description'},
                {data: 'date', name: 'date'},
                {data: 'location', name: 'location'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            dom: '<"top row"<"col-5"l><"col-5"f><"col-1"B>>' +
                'rt' +
                '<"bottom"ip>' +
                '<"clear">',
            buttons: [{
                text: 'Create',
                className: 'btn btn-outline-success',
                action: function (e, dt, node, config) {
                    $('#holidayID').val(null)
                    $('#modalHoliday').modal("show")
                }
            }],
        });
    });
</script>

@endsection