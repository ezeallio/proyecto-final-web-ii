<script>
    const pathAccionFacturacionMensual = "<?php echo getBaseAddress() . "DashBoard/generarFacturacionMensual"; ?>";
    const fechaMasAntiguaCompra = "<?php echo $fechaCompraMasAntigua; ?>";
    const pathGetFacturacionesPendientes = "<?php echo getBaseAddress() . "DashBoard/getFacturacionesPendientes"; ?>";
</script>

<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo getBaseAddress() . "DashBoard/inicio" ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Facturaciones Mensuales</li>
        </ol>

        <div id="divFormGroupRangoFacturacion" class="form-group w-25 ml-auto">
            <label for="inputRangoFacturacion">Seleccione un Rango:</label>
            <div class="input-group">
                <input type="text" id="inputRangoFacturacion" class="form-control bg-white text-dark" disabled>
                <div class="input-group-append">
                    <button type="button" id="btnInputRangoFacturacion" class="btn btn-outline-secondary">
                        <i class="fas fa-calendar-alt"></i>
                    </button>
                </div>
            </div>
        </div>

        <h4 id="advertencia" class="d-none text-black-50 text-center mx-auto">No hay compras a facturar</h4>
        <h4 id="advertencia2" class="d-none text-black-50 text-center mx-auto">No hay facturaciones pendientes en el rango seleccionado</h4>
        <!-- DataTables Example -->
        <div id="divCardsContainer" class="d-none flex-column justify-content-center align-items-center">
        </div>


    </div>

    <script src="<?php echo getBaseAddress() . "Webroot/js/dashboard/facturacionesMensuales.js"; ?>"></script>