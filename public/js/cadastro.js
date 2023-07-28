
$('input[type=radio][name="radio_pessoa"]').on('change', function () {
    if (this.value == 'fisica') {
        $("#divcpf").show();
        $("#divcnpj").hide();
        $("#cnpj").val("");
        $("#razaosocial").val("");
    } else {
        $("#divcpf").hide();
        $("#divcnpj").show();
        $("#cpf").val("");
        $("#nome").val("");
    }
})