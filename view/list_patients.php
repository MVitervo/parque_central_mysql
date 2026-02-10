<div id="sectionListPatients">
    <div class="d-flex justify-content-center">
        <!-- <button class="btn btn-success col-12 col-md-3 col-lg-md-2" onclick="addPatientForm()">Agregar</button> -->
        <button type="button" class="btn btn-success" onclick="showModal()">
            Agregar
        </button>
    </div>

    <table id="tableListPatients" class="table table-striped table-hover table-responsive" style="width:100%">
        <thead class="table-primary">
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>CURP</th>
                <th>RFC</th>
                <th>Opcion</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div id="sectionForm">

</div>


<script>
    $(document).ready(function() {
        tabla();
    });

    

    function tabla() {
        $('#tableListPatients').DataTable({
            // language: {
            //     url: '/config/datatables-bs5/language-spanish.json'
            // },
            ordering: false,
            responsive: true,
            keys: false,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            ajax: {
                url: 'controllers/list_patients_controller.php',
                type: 'GET',
                dataSrc: ''
            },
            columns: [{
                    data: 'Name'
                },
                {
                    data: 'Lastname'
                },
                {
                    data: 'CURP'
                },
                {
                    data: 'RFC'
                },
                {
                    data: 'option',
                    width: '80px',
                    render: function(data, type, row, meta) {
                        return data;
                    },
                }
            ],
            initComplete: function() {
                // let windowHeight = $(window).height();
                // let pagelen = (windowHeight * 0.62) / 29;
                // $('#tableListPatients').DataTable().page.len(pagelen).draw();
                $('.tab-1').fadeIn();
            }
        });
    }
    
    /*
    function addPatientForm() {
        $.ajax({
            url: 'view/forms/add_patient.php',
            method: 'POST',
            success: function(response) {
                $('#sectionListPatients').hide();
                $('#form_section').html(response).fadeIn();
            }
        });
    }
    */

    function editPatient (id) {
        $.ajax({
            url: '/view/edit_patient.php',
            method: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                $('#sectionListPatients').hide();
                $('#sectionForm').html(response).fadeIn();
            }
        });
    }

    function deletePatient(id) {
        Swal.fire({
            template: '#warning-template',
            title: "Eliminar?",
            text: "¿Estás seguro de eliminar este paciente?",
            reverseButtons: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
            showCancelButton: true
        }).then((action) => {
            if (action.value){
                  $.ajax({
                    url: 'controllers/delete_patients_controller.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.status == true) {
                            /*
                            Swal.fire({
                                template: '#success-template',
                                title: "Eliminado!",
                                html: '<label style="font-size:24px; font-weight:bold">' + response.message + '</label>',
                            }).then(() => {
                                $('#form_section').hide();
                                $('#sectionListPatients').show();
                                searchData();
                            });
                            */
                            toastr.success(response.message);
                            $('#form_section').hide();
                            $('#sectionListPatients').show();
                            searchData();
                        } else {
                            /*
                            Swal.fire({
                                template: '#error-template',
                                title: "Oops!",
                                html: response.message,
                            })
                            */
                           toastr.error(response.message);
                        }
                    },
                    error: function(error) {
                        /*
                        Swal.fire({
                            template: '#error-template',
                            title: "Oops!",
                            html: '<label style="font-size:24px; font-weight:bold">Hubo un error en la solicitud</label>',
                        });
                        */
                        toastr.error('Hubo un error en la solicitud');
                    }
                });

            }

        });
    }
</script>