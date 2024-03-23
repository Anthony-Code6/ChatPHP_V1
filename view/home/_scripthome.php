<script>
    const LeerDocumento = (input) => {
        if (input.files) {
            $('#contenido-file').html(input.files[0]['name'])

            const reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function(e) {
                $('#logobase64').attr('value', e.target.result)
            }
        } else {
            $('#contenido-file').html('')
            $('#logobase64').val('')
        }
    }

    const ValidarTexto = (input) => {
        var campo = $(input).val()
        var regex = /^[a-zA-Z ]+$/;
        if (!regex.test(campo)) {
            $(input).val($(input).val().substring(0, $(input).val().length - 1));
        }
    }
</script>