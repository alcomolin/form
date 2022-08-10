$(function () {
  createTable();

  $("#regData").on("input", ":text", function (e) {
    /* valida que no se ingresen caracteres especiales en los campos */
    this.value = this.value.replace(/[^a-zA-Z ]/, "");
  });

  $("#regData").on("submit", function (e) {
    e.preventDefault();
    if (e.target[1].value === " ") {
      /* valida si ingresaron solo un espacio en el nombre*/
      Swal.fire("", "Debe ingresar un nombre", "warning");
      return false;
    }
    if (e.target[2].value === " ") {
      /* valida si ingresaron solo un espacio en el apellido*/
      Swal.fire("", "Debe ingresar un apellido", "warning");
      return false;
    }

    $.ajax({
      /* Guarda la informacion del registro */
      url: "api/functions.php",
      data: {
        /* datos que se envian al api */
        token: "cmVnaXN0cm9fYmQ=",
        function: "saveReg",
        regId: document.getElementsByName("regId")[0].value,
        regName: document.getElementsByName("regName")[0].value,
        regLastName: document.getElementsByName("regLastName")[0].value,
      },
      type: "POST",
      dataType: "json",
    }).done((data) => {
      document.getElementsByName("regId")[0].value = "";
      document.getElementsByName("regName")[0].value = "";
      document.getElementsByName("regLastName")[0].value = "";
      Swal.fire(
        "",
        data.mensaje,
        "success"
      ); /* muestra mensaje que retorno el api */
      tableRegs.ajax.reload(); /* Actualiza el listado de inventario */
    });
  });
});

var tableRegs = "";

/* Crea la tabla de registros */
function createTable() {
  $.fn.dataTable.ext.errMode = "throw";
  tableRegs = $("#tableRegs").DataTable({
    /* Define la estructura de la tabla */
    searching: false,
    paging: false,
    destroy: true,
    info: false,
    responsive: false,
    sScrollY: "390px",
    language: {
      emptyTable: "No hay registros creados",
    },
    columnDefs: [
      {
        border: "none",
        targets: "_all",
        targets: 1,
      },
    ],
    columns: [
      {
        name: "id",
        data: "id",
      },
      {
        name: "name",
        data: "name",
      },
      {
        name: "lastName",
        data: "lastName",
      },
      {
        name: "btn",
        data: "btn",
      },
    ],
    ajax: {
      /* Obtiene los datos que se mostraran en la tabla */
      url: "api/functions.php",
      type: "POST",
      data: {
        token: "cmVnaXN0cm9fYmQ=",
        function: "listRegs",
      },
      dataSrc: "tablaRegs",
      complete: function (data) {
        console.log("Data bd", data);
        data = data.responseText;
        data = JSON.parse(data);
        arrayRegs =
          data.tablaRegs; /* Almacena los registros en un arreglo, evita nuevas consultas */
      },
    },
    createdRow: function (row, data, dataIndex) {
      $(row).attr("style", "vertical-align: middle;");
    },
  });
  tableRegs.column(0).visible(false);
}

function editReg(datos) {
  var data = datos.split("|"); /* Se crea arreglo con los datos obtenidos */

  /* Se asignan los datos a los campos */
  document.getElementsByName("regId")[0].value = data[0];
  document.getElementsByName("regName")[0].value = data[1];
  document.getElementsByName("regLastName")[0].value = data[2];
}

function deleteReg(id) {
  Swal.fire({
    /* Solicita confirmacion de querer eliminar el registro */
    title: "",
    text: "¿Esta seguro que desea eliminar el registro?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Delete",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        /* Realizar la eliminacion del registro una vez lo han confirmado */
        url: "api/functions.php",
        data: {
          token: "cmVnaXN0cm9fYmQ=",
          function: "deleteReg",
          regId: id,
        },
        type: "POST",
        dataType: "json",
      }).done((data) => {
        Swal.fire({
          /* Notifica que se elimino correctamente */ title: "",
          text: data.mensaje,
          type: "success",
        });
        tableRegs.ajax.reload(); /* Recarga la tabla de inventario */
      });
    }
  });
}
