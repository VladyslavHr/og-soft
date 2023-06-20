@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center">General 1-1</h1>
    <div class="row py-5">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
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
            <input type="text" class="form-control" id="date_input" readonly
            {{-- data-seasonstart="{{ $seasonStart }}"
            data-seasonend="{{ $seasonEnd }}"
            data-disableddays="{{ $disabledDays }}"
            data-datestart="{{ $dateStart }}" --}}
            onchange="date_select()"
            placeholder="Vyberte datum">

            <script>
                $(function(){
                    var $departDateInput = $('#date_input')
                    $('#date_input').datepicker({
                        language: 'cs',
                        // startDate: $departDateInput.data('seasonstart'),
                        // endDate: $departDateInput.data('seasonend'),
                        format: 'dd-mm-yyyy',
                        // datesDisabled: $departDateInput.data('disableddays').split(','),
                        weekStart: 1,
                        // startDate: $departDateInput.data('datestart'),
                        autoclose: true,
                    });
                })
            </script>
        </div>
        <div class="col-lg-4">
            <input type="time" class="form-control" id="time_input" onchange="date_select()">
        </div>
        <div class="col-lg-4">
            <input type="number" class="form-control" id="duration_input" onchange="date_select()">
        </div>
        {{-- <div class="col-lg-4">
            <select class="form-select select-ticket-input" name="from" id="select_from" onchange="destination_select()">
                @foreach ($stops as $stop)
                    <option value="{{ $stop->id }}"> {{ $stop->name }} </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4">
            <select class="form-select select-ticket-input" name="to" id="select_to" onchange="destination_select()">
                @foreach ($stops as $stop)
                    <option {{ $loop->last ? 'selected' : '' }} value="{{ $stop->id }}"> {{ $stop->name }} </option>
                @endforeach
            </select>
        </div> --}}
    </div>

    <div class="container-wrap-bg" id="date_result">
    </div>

</div>

@endsection
