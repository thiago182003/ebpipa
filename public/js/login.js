

$('input[type=radio][name="radio_pessoa"]').on('change', function () {
    if (this.value == 'fisica') {
        $("#divcpf").show();
        $("#divcnpj").hide();
    } else {
        $("#divcpf").hide();
        $("#divcnpj").show();
    }
})

