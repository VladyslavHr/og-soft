function date_select() {

    var select_date = $('#date_input')
    var select_country = $('#country_input')
    var select_time = $('#time_input')
    var select_duraion = $('#duration_input')

    var date = select_date.val()
    var country = select_country.val()
    var time = select_time.val()
    var duration = select_duraion.val()

    $.post('/dateFilter',
    {
        country: country,
        date: date,
        time: time,
        duration: duration,
        type: 'general',
        _token: $('meta[name="csrf-token"]').attr('content'),
    }, function function_name(data) {
        if (data.status === 'ok') {
            if (data.date) {
                toastr.warning(data.date)
            }
            if (data.toastr) {
                toastr.error(data.toastr)
            }
            $('#date_result').html(data.date_view)
        }
    }, 'json')
}
