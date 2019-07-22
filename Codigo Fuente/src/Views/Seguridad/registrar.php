<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/seguridad/registrar.css" ?>">

<script>
    const pathGetPartidosByProvinciaId = "<?php echo getBaseAddress() . "Seguridad/getPartidosByProvinciaId"; ?>";
    const pathGetLocalidadesByPartidoId = "<?php echo getBaseAddress() . "Seguridad/getLocalidadesByPartidoId"; ?>";
    const pathValidarRegistrar = "<?php echo getBaseAddress() . "Seguridad/registrarUsuario"; ?>";
</script>
<div class="d-flex mt-4">
    <div class="col-lg-6 col-md-8 mx-auto mt-1">
        <div class="border shadow rounded p-4 my-5 bg-white">
            <h4 class="mb-4 text-center">Regístrese</h4>

            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="inputNombre">Nombre</label>
                        <input type="text" name="nombre" id="inputNombre" class="form-control" placeholder="Ej: Pepe" maxlength="15">
                        <div id="errorNombre" class="error"><i class="fas fa-exclamation-triangle"></i> Ingrese su nombre
                        </div>
                        <div id="errorNombre2" class="error"><i class="fas fa-exclamation-triangle"></i> Su nombre debe tener mínimo 3 letras
                        </div>
                        <div id="errorNombre3" class="error"><i class="fas fa-exclamation-triangle"></i> Su nombre no debe tener mas de 15 caracteres
                        </div>
                        <div id="errorNombre4" class="error"><i class="fas fa-exclamation-triangle"></i> Formato de nombre incorrecto
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="inputApellido">Apellido</label>
                        <input type="text" name="apellido" id="inputApellido" class="form-control" placeholder="Ej: González">
                        <div id="errorApellido" class="error"><i class="fas fa-exclamation-triangle"></i> Ingrese su apellido
                        </div>
                        <div id="errorApellido2" class="error"><i class="fas fa-exclamation-triangle"></i> Su apellido debe tener mínimo 3 letras
                        </div>
                        <div id="errorApellido3" class="error"><i class="fas fa-exclamation-triangle"></i> Su apellido no
                            debe tener mas de 15 caracteres
                        </div>
                        <div id="errorApellido4" class="error"><i class="fas fa-exclamation-triangle"></i> Solo letras por
                            favor
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="">CUIT</label>
                        <input type="number" class="form-control" name="CUIT" id="inputCUIT" placeholder="Ej: ##-12345678-X">
                        <div id="errorCUIT" class="error"><i class="fas fa-exclamation-triangle"></i> CUIT Inválido
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="inputFechaNacimiento">Fecha de Nacimiento</label>
                        <div class="input-group">
                            <input type="text" name="fechaNacimiento" id="inputFechaNacimiento" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" id="btnInputFechaNacimiento" type="button"><i class="fas fa-calendar-alt"></i></button>
                            </div>
                        </div>
                        <div id="errorFechaNacimiento" class="error"><i class="fas fa-exclamation-triangle"></i> Formato de Fecha Inválido
                        </div>
                        <div id="errorFechaNacimiento2" class="error"><i class="fas fa-exclamation-triangle"></i> Debe ser mayor de 18 años
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="inputNickname">Nickname</label>
                        <input type="text" name="nickname" id="inputNickname" class="form-control" placeholder="Ej: pgonzalez">
                        <div id="errorNickname" class="error"><i class="fas fa-exclamation-triangle"></i> Ingrese su nickname
                        </div>
                        <div id="errorNickname2" class="error"><i class="fas fa-exclamation-triangle"></i> Su nickname debe tener mínimo 5 caracteres
                        </div>
                        <div id="errorNickname3" class="error"><i class="fas fa-exclamation-triangle"></i> Su NickName no
                            debe tener mas de 15 caracteres
                        </div>
                        <div id="errorNickname4" class="error"><i class="fas fa-exclamation-triangle"></i> Solo letras y
                            numero por favor
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="ejemplo@correo.com">
                        <div id="errorEmail" class="error"><i class="fas fa-exclamation-triangle"></i> Ingrese su E-Mail
                        </div>
                        <div id="errorEmail2" class="error"><i class="fas fa-exclamation-triangle"></i> Escriba su E-Mail de
                            forma correcta
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="inputPassword">Contraseña</label>
                        <div class="input-group">
                            <input type="password" name="password" id="inputPassword" class="form-control pwd" placeholder="Ej: juan1234">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="showPassword(this)"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <div id="errorPassword" class="error"><i class="fas fa-exclamation-triangle"></i> Ingrese su
                            contraseña
                        </div>
                        <div id="errorPassword2" class="error"><i class="fas fa-exclamation-triangle"></i> Su contraseña
                            debe tener entre 6 a 15 digitos
                        </div>
                        <div id="errorPassword3" class="error"><i class="fas fa-exclamation-triangle"></i> Solo letras y
                            numero por favor
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="inputRePassword">Confirmar Contraseña</label>
                        <div class="input-group">
                            <input type="password" name="rePassword" id="inputRePassword" class="form-control pwd" placeholder="Ej: juan1234" aria-describedby="helpIdInputRePassword">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="showPassword(this)"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <small id="helpIdInputRePassword" class="text-muted">Asegúrese de que coincidan</small>
                        <div id="errorRePassword" class="error"><i class="fas fa-exclamation-triangle"></i> Confirme su
                            contraseña
                        </div>
                        <div id="errorRePassword2" class="error"><i class="fas fa-exclamation-triangle"></i> Sus contraseñas
                            no coinciden
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="inputTelefonoFijo">Teléfono Fijo</label>
                        <input type="number" class="form-control" name="telefonoFijo" id="inputTelefonoFijo" aria-describedby="helpIdInputTelefono" placeholder="44448888">
                        <small id="helpIdInputTelefono" class="form-text text-muted">Sin código de área</small>
                        <div id="errorTelfonoFijo" class="error"><i class="fas fa-exclamation-triangle"></i> Debe ingresar su telefono
                        </div>
                        <div id="errorTelfonoFijo2" class="error"><i class="fas fa-exclamation-triangle"></i> Formato de teléfono fijo inválido
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="inputTelefonoCelular">Teléfono Celular</label>
                        <input type="number" class="form-control" name="telefonoCelular" id="inputTelefonoCelular" aria-describedby="helpIdInputTelefonoCelular" placeholder="111234567">
                        <small id="helpIdInputTelefonoCelular" class="form-text text-muted">Sin código de área</small>
                        <div id="errorTelfonoCelular" class="error"><i class="fas fa-exclamation-triangle"></i> Debe ingresar su telefono
                        </div>
                        <div id="errorTelfonoCelular2" class="error"><i class="fas fa-exclamation-triangle"></i> Formato de teléfono móvil inválido
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="selectGenero">Género</label>
                        <select class="form-control" name="genero" id="selectGenero">
                            <option value="0" disabled selected>Seleccione su Género</option>
                            <?php
                            foreach ($generos as $genero)
                                echo "<option value='" . $genero->getId() . "'>" . $genero->getNombre() . "</option>";
                            ?>
                        </select>
                        <div id="errorGenero" class="error"><i class="fas fa-exclamation-triangle"></i> Seleccione su Sexo
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="selectProvincia">Provincia</label>
                        <select class="form-control" name="provincia" id="selectProvincia">
                            <option value="0" disabled selected>Seleccione una Provincia</option>
                            <?php
                            foreach ($provincias as $provincia)
                                echo "<option value='" . $provincia->getId() . "'>" . $provincia->getNombre() . "</option>";
                            ?>
                        </select>
                        <div id="errorProvincia" class="error"><i class="fas fa-exclamation-triangle"></i> Seleccione una Provincia
                        </div>
                    </div>
                </div>
            </div>

            <div id="rowPartidoLocalidadSelects" class="form-row d-none">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="selectPartido">Partido</label>
                        <select class="form-control" name="partido" id="selectPartido">
                        </select>
                        <div id="errorPartido" class="error"><i class="fas fa-exclamation-triangle"></i> Seleccione un Partido
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="selectLocalidad">Localidad</label>
                        <select class="form-control" name="localidad" id="selectLocalidad">
                        </select>
                        <div id="errorLocalidad" class="error"><i class="fas fa-exclamation-triangle"></i> Seleccione una Localidad
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="inputCalle">Calle</label>
                        <input type="text" class="form-control" name="calle" id="inputCalle" placeholder="Ej: Av. Rivadavia">
                        <div id="errorCalle" class="error"><i class="fas fa-exclamation-triangle"></i> Debe ingresar una calle
                        </div>
                        <div id="errorCalle2" class="error"><i class="fas fa-exclamation-triangle"></i> Formato de calle no válido
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="inputAltura">Altura</label>
                        <input type="number" class="form-control" name="altura" id="inputAltura" placeholder="Ej: 13200">
                        <div id="errorAltura" class="error"><i class="fas fa-exclamation-triangle"></i> Debe ingresar la altura
                        </div>
                        <div id="errorAltura2" class="error"><i class="fas fa-exclamation-triangle"></i> Altura inválida
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="inputPiso">Piso</label>
                        <input type="number" class="form-control" name="piso" id="inputPiso" aria-describedby="helpIdInputPiso" placeholder="Ej: 13">
                        <small id="helpIdInputPiso" class="form-text text-muted">Opcional</small>
                        <div id="errorPiso" class="error"><i class="fas fa-exclamation-triangle"></i> Ingrese el piso
                        </div>
                        <div id="errorPiso2" class="error"><i class="fas fa-exclamation-triangle"></i> Piso inválido
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="inputDepartamento">Departamento</label>
                        <input type="text" class="form-control" name="departamento" id="inputDepartamento" aria-describedby="helpIdInputDepartamento" placeholder="Ej: A">
                        <small id="helpIdInputDepartamento" class="form-text text-muted">Opcional</small>
                        <div id="errorDepartamento" class="error"><i class="fas fa-exclamation-triangle"></i> Ingrese el departamento
                        </div>
                        <div id="errorDepartamento2" class="error"><i class="fas fa-exclamation-triangle"></i> Departamento inválido
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center my-3">
                <button type="button" name="btnRegistrar" id="btnRegistrar" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="registrarModal" tabindex="-1" role="dialog" aria-labelledby="registrarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrarModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
            </div>
            <div class="modal-footer">
                <form action="<?php echo getBaseAddress() . "Home/inicio"; ?>" method="post">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Continuar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo getBaseAddress() . "Webroot/js/seguridad/registrar.js"; ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/js/seguridad/validacionRegistrar.js"; ?>"></script>