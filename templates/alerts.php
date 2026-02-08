<!-- Warning Template -->
<template id="warning-template">
  <swal-title>
    Eliminar?
  </swal-title>
  <swal-icon type="warning" color="red"></swal-icon>
  <swal-button type="confirm">
    Sí, eliminar
  </swal-button>
  <swal-button type="cancel">
    Cancelar
  </swal-button>
  <swal-param name="allowEscapeKey" value="false" />
  <swal-param
    name="customClass"
    value='{ "popup": "my-popup" }' />
  <swal-function-param
    name="didOpen"
    value="popup => console.log(popup)" />
</template>