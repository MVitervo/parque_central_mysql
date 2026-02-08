
<div>
    <label for="strName" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="txtName" name="txtName" style="max-width: none;" required autocomplete="off">
</div>
<div>
    <label for="txtLastname" class="form-label">Apellido</label>
    <input type="text" class="form-control" id="txtLastname" name="txtLastname" style="max-width: none;" required autocomplete="off">
</div>

<div>
    <label for="txtCurp" class="form-label">CURP</label>
    <input type="text" class="form-control" id="txtCurp" name="txtCurp" style="max-width: none;" required autocomplete="off">
</div>

<div>
    <label for="txtRfc" class="form-label">RFC</label>
    <input type="text" class="form-control" id="txtRfc" name="txtRfc" style="max-width: none;" required autocomplete="off">
</div>

<script>

    $(document).ready(function() {
        getData();
    });

    function getData() {
        const id = <?php echo $_POST['id'] ?>;
        $.ajax({
            method: 'POST',
            url: '/queries/get_data_patient.php',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                if (response.status) {
                    const dataPatient = response.data;
                    $('#txtName').val(dataPatient.Name);
                    $('#txtLastname').val(dataPatient.Lastname);
                    $('#txtCurp').val(dataPatient.CURP);
                    $('#txtRfc').val(dataPatient.RFC);
                    
                } else {
                    console.error('Error:', response.message);
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                Swal.fire('Error', 'Hubo un error en la carga de datos', 'error');
            }
        });
    }

</script>