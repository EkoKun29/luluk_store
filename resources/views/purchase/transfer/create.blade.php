@extends('purchase.create')
@push('css')
    <style>
        .select2 .selection {
            width: 100%;
            display: block !important;
        }
    </style>
@endpush
@section('name')
    Transfer
@endsection
@section('method-input')
    <input type="hidden" name="method" value="2">
@endsection

@section('method-attr-input')
    <div id="cardBank" class="card-style mb-30">
        <div class="form-group">
            <label for="bank_id">Nama Bank</label>
            <select class="form-control" name="bank_id" id="bank_id" style="width: 100% !important;" required>
                <option value="" selected disabled>Pilih Bank</option>
                @foreach ($banks as $bank)
                    <option @selected(old('bank_id' == $bank->id)) value="{{ $bank->id }}">{{ $bank->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="no_rekening_id">Nomor Rekening</label>
            <select class="form-control" name="no_rekening_id" id="no_rekening_id" style="width: 100% !important;" required>
                <option value="" selected disabled>Pilih Rekening</option>
            </select>
        </div>
        <div class="input-style-1">
            <label>Atas Nama</label>
            <input type="text" placeholder="Atas Nama Bank" name="account_name" id="account_name" readonly>
        </div>
    </div>
@endsection
@push('js')
    <script>
        async function getNoRekenings(bankId) {
            $('#account_name').attr("readonly", true)
            const response = await fetch("{{ route('banks.rekenings', ':id') }}".replace(':id',
                bankId))
            const dataJson = await response.json()
            if (dataJson.length > 0) {
                let newOption = new Option("Pilih Rekening", null, false, false)
                $("#no_rekening_id").append(newOption).trigger('change')
                for (let noRekening of dataJson) {
                    let newOption = new Option(noRekening.account_number, noRekening.id, false,
                        false)
                    newOption.setAttribute('data-name', noRekening.name)
                    $("#no_rekening_id").append(newOption).trigger('change')
                }
            }
        }
        $(document).ready(function() {
            $("#bank_id").select2({
                tags: true
            }).on('select2:select', function(e) {
                $('#no_rekening_id').val(null).trigger('change');
                $("#no_rekening_id").empty()
                $('#account_name').empty()
                $('#account_name').attr("readonly", true)
                if (e.params.data.element != undefined) {
                    getNoRekenings(e.params.data.id)
                }
            });
            $("#no_rekening_id").select2({
                tags: true
            }).on('select2:select', function(e) {
                if (e.params.data.element != undefined) {
                    $('#account_name').val($("#no_rekening_id").select2().find(":selected").data("name"))
                    $('#account_name').attr("readonly", true)
                } else {
                    $('#account_name').val("")
                    $('#account_name').attr("readonly", false)
                }
            });
        })
    </script>
@endpush
