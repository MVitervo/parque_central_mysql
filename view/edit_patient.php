<div class="d-flex justify-content-center card-body">
    <div class="col-12 col-md-6 col-lg-6" style="position: relative; bottom: 55px">
        <h4>Datos de la persona</h4>
        <form id="formPatient">
            <?php include ('forms/form_template.php'); ?>
            <div class="d-flex justify-content-center">
                <button type="submit" class="mt-3 btn btn-primary col-12 col-md-6 col-lg-6">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        sendForm();
    });

    function sendForm() {
        const form = $('#formPatient')[0];
        $(form).on('submit', function(event) {
            const id = <?php echo $_POST['id'] ?>;
            event.preventDefault();

            // Realizar la validación antes de enviar el formulario
            if (!form.checkValidity()) {
                event.stopPropagation();
                $(form).addClass('was-validated');
                Swal.fire({
                    template: '#warning_template',
                    title: "Campos Vacios!",
                    text: "Por favor, complete todos los campos requeridos",
                });
                return;
            }

            // Obtener los datos del formulario
            const formData = new FormData(form);
            formData.append('id', id);

            // Enviar la solicitud AJAX
            $.ajax({
                type: 'POST',
                url: '/controllers/edit_patient_controller.php',
                data: formData,
                contentType: false, // necesario para FormData()
                processData: false, // necesario para FormData()
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            template: '#success_template',
                            title: "Transacción Realizada!",
                            html: '<label style="font-size:24px; font-weight:bold">' + response.message + '</label>',
                        }).then(() => {
                            searchData();
                            $('#sectionListPatients').show();
                            $('#sectionForm').hide();
                        });
                    } else if (response.status === false) {
                        Swal.fire({
                            template: '#error_template',
                            title: "Oops!",
                            html: '<label style="font-size:24px; font-weigth:bolder">' + response.message + '</label>',
                        });
                    }
                },
                error: function(error) {
                    Swal.fire({
                        template: '#error_template',
                        title: "Oops!",
                        html: '<label style="font-size:24px; font-weigth:bolder">Hubo un error en la solicitud</label>',
                    });
                }
            });
        });
    }
</script>