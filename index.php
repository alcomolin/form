<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>

    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js\js.js" crossorigin="anonymous"></script>
    <script src="assets\DataTables-1.10.19/jquery.dataTables.min.js"></script>
    <script src="assets\DataTables-1.10.19/dataTables.bootstrap4.min.js"></script>
    <script src="assets\sweetAlert2\sweetalert2.all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets\sweetAlert2\sweetalert2.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="css\styles.css" />
    <link rel="stylesheet" href="assets\DataTables-1.10.19/dataTables.bootstrap4.min.css">
</head>

<body>
    <div class="container align-middle w-100 h-100">
        <div class="row justify-content-center align-items-center">
            <div class="w-50">
                <!-- formulario de captura de datos -->
                <form id="regData">
                    <input type="hidden" name="regId" class="form-control" value="" />
                    <label for="name"><strong>*</strong>Nombre:</label>
                    <input type="text" name="regName" class="form-control" value="" required />
                    <label for="lastName"><strong>*</strong>Apellido:</label>
                    <input type="text" name="regLastName" class="form-control" value="" required />
                    <button type="submit" class="btn btn-primary mt-1">Enviar</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-center align-items-center mt-3">
            <table id="tableRegs" class="table table-striped table-bordered align-self-center" style="font-size: 15px; border-radius:4px;">
                <thead>
                    <tr>
                        <th style="border-radius:4px;"><strong>Id</strong></th>
                        <th style="border-radius:4px;"><strong>Nombre</strong></th>
                        <th style="border-radius:4px;"><strong>Apellido</strong></th>
                        <th style="border-radius:4px;"><strong>Options</strong></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>