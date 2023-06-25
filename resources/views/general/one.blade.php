@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center">General 1-1</h1>
    <div class="row py-5">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <label for="">Vyberte zemi</label>
            <select class="form-select text-center" name="country" id="country_input" onchange="date_select()">
                <option value="1">Česko</option>
                <option value="2">Německo</option>
                <option value="3">Nizozemsko</option>
            </select>
        </div>
        <div class="col-lg-4"></div>
    </div>

    <div class="row py-5">
        <div class="col-lg-4">
            <label for="">Vyberte datum</label>
            <input type="text" class="form-control" id="date_input" readonly
            onchange="date_select()"
            placeholder="Vyberte datum">
            <script>
                $(function(){
                    var $departDateInput = $('#date_input')
                    $('#date_input').datepicker({
                        language: 'cs',
                        format: 'dd-mm-yyyy',
                        weekStart: 1,
                        autoclose: true,
                    });
                })
            </script>
        </div>
        <div class="col-lg-4">
            <label for="">Vyberte čas</label>
            <input type="time" class="form-control" id="time_input" onchange="date_select()">
        </div>
        <div class="col-lg-4">
            <label for="">Nastavit dobu trvání úkolu v minutách</label>
            <input type="number" class="form-control" id="duration_input" onchange="date_select()">
        </div>
    </div>

    <div class="container-wrap-bg" id="date_result">
    </div>

</div>

@endsection
