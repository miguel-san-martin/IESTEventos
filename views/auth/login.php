<div class="content">
    <div class="wrapper">
        <img id="icon_iest" src="https://upload.wikimedia.org/wikipedia/commons/2/24/IEST_An%C3%A1huac.jpg" alt="">
        <div class="formulario-contenedor">
            <br>
            <!-- <div class="slide-controls">
                <input type="radio" class="" name="slide" id="login" checked>
                <label for="login" class="slide login ">Iniciar Sesión</label>
                <div class="slider-tab"></div>
            </div> -->
            <div class="formulario-contenido">
                <div class="formulario login">
                    <div class="campo">
                        <input type="text" id="loginUser" placeholder="Correo/Usuario" required>
                    </div>
                    <div class="campo">
                        <input type="password" id="loginContraseña" placeholder="Contraseña" required>
                    </div>
                    <!-- <div class="pass-link">
                            <a href="recovery">¿Olvidaste la contraseña?</a>
                        </div> -->
                    <div class="campo btn">
                        <div class="btn-layer"></div>
                        <input id="btnLogin" value="Iniciar Sesión" type="submit">
                    </div>
                </div>
                <!-- <div class="formulario signup">
                    <div class="campo">
                        <input type="text" id="registro_nombre" placeholder="Nombre" required>
                    </div>
                    <div class="campo">
                        <input type="text" id="registro_apellidoP" placeholder="Apellido Paterno" required>
                    </div>
                    <div class="campo">
                        <input type="text" id="registro_apellidoM" placeholder="Apellido Materno" required>
                    </div>
                    <div class="campo">
                        <input type="text" id="registro_correo" placeholder="correo@iest.edu.mx" required>
                    </div>

                    <div class="campo">
                        <input type="password" id="registro_contraseña" placeholder="Contraseña" required>
                    </div>
                    <div class="campo">
                        <input type="text" id="idiest" placeholder="IDIEST 18823" maxlength="5" pattern="[0-9]{5}" required>
                    </div>
                    <div class="campo btn">
                        <div class="btn-layer"></div>
                        <input id="registrarse" type="submit">
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
<?php $script = "
    <script src='https://sie.iest.edu.mx/IESTEventos/build/js/animacion/login.js'></script>
    <script src='https://sie.iest.edu.mx/IESTEventos/build/js/auth/login.js'></script>

"; ?>