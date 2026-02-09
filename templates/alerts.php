<!-- Warning Template -->
<template id="warning-template">
  <swal-icon type="warning" color="red"></swal-icon>
  <swal-param name="allowEscapeKey" value="false" />
  <swal-param
    name="customClass"
    value='{ "popup": "my-popup" }' />
  <swal-function-param
    name="didOpen"
    value="popup => console.log(popup)" />
</template>

<!-- Success Template -->
<template id="success-template">
  <swal-icon type="success" color="green"></swal-icon>
</template>

<!-- Error Template -->
<template id="error-template">
  <swal-icon type="error" color="red"></swal-icon>
</template>