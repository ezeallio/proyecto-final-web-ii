<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cerrar Sesion <i class="fas fa-sign-out-alt"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <i class="fa fa-question-circle"></i> ¿Estas seguro que deseas cerrar sesion?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="<?php echo getBaseAddress() . "Seguridad/cerrarSession" ?>" method="post">
                    <button type="submit" class="btn btn-primary">Cerrar Sesion</button>
                </form>
            </div>
        </div>
    </div>
</div>