<script>
var idUser = <?php echo $_SESSION['id_user']; ?>;
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.1/dist/html2canvas.min.js">
</script>
<div class="intro-user-profile">
    <img style="width:200px;" src="http://localhost/IESTEventos/build/img/LogoCode.png">
</div>

<div id="rutaIndex" class="indexCalendar">
    <div onclick="window.location.href = ''">Inicio</div>
    &nbsp;<div>/</div>&nbsp;
    <div onclick="window.location.href = 'profile'">Mi perfil</div>
</div>

<div class="title-main"> Mi Perfil </div>
<div class="grid-container-profile">
    <div class="cell_profile cell1_profile">
        <img class="photo-user-profile" src="<?php echo $_SESSION['fotografia']??"https://www.citypng.com/public/uploads/preview/download-profile-user-round-orange-icon-symbol-png-11639594360ksf6tlhukf.png"; ?>">
    </div>
    <div class="cell_profile cell3_profile">
        <div class="title-profile-card">
            NOMBRE:
        </div>
    </div>
    <div class="cell_profile cell4_profile">
        <div class="content-profile-card">
            <?php echo ucwords($_SESSION['nombre']); ?>
        </div>
    </div>
    <div class="cell_profile cell5_profile">
        <div class="title-profile-card">
            ID:
        </div>
    </div>
    <div class="cell_profile cell6_profile">
        <div class="content-profile-card">
            <?php echo $_SESSION['id_user']; ?>
        </div>
    </div>
    <div class="cell_profile cell7_profile">
        <img class="qr-user-profile"src="data:image/png;base64,<?php echo $qrCode; ?>" alt="QR Code">
    </div>
    <div class="cell_profile cell8_profile">
        <div class="title-profile-card">
            CORREO:
        </div>
    </div>
    <div class="cell_profile cell9_profile">
        <div class="content-profile-card">
            <?php echo $_SESSION['correo']??'No hay, no existe :('; ?>
        </div>
    </div>
    <!-- <div class="cell_profile cell12_profile">
        <div id="triggerMyEvents" class="trigger-user-profile" onclick="triggerEvent()">
            <i class="fa-regular fa-calendar-check"></i>&nbsp;&nbsp;
            Mis Eventos
        </div>
    </div> -->
    <div class="cell_profile cell13_profile">
        <?php if($_SESSION['staff']):?>
        <div id="triggerStaff" class="trigger-user-profile" onclick="getEventosForStaff()">
            <i class="fa-solid fa-qrcode"></i>&nbsp;&nbsp;Staff
        </div>
        <?php endif;?>
    </div>
    <!-- <div class="cell_profile cell14_profile">
        <div id="triggerMyHistory" class="trigger-user-profile" onclick="triggerHistory()">
            <i class="fa-solid fa-clock-rotate-left"></i>&nbsp;&nbsp;
            Historial
        </div>
    </div> -->
</div>
<div class="card-mini-profile">
    <div id="frontID" class="card-front-mini-profile">
        <div class="grid-container-miniProfile">
            <div class="cell_miniProfile cell1_miniProfile">
            <img class="photo-user-profile" src="<?php echo $_SESSION['fotografia']??"https://www.citypng.com/public/uploads/preview/download-profile-user-round-orange-icon-symbol-png-11639594360ksf6tlhukf.png"; ?>">

            </div>
            <div class="cell_miniProfile cell2_miniProfile">
                <div class="title-miniProfile-front">
                    NOMBRE:
                </div>
            </div>
            <div class="cell_miniProfile cell3_miniProfile">
                <div class="content-miniProfile-front">
                    <?php echo ucwords($_SESSION['nombre']); ?>
                </div>
            </div>
            <div class="cell_miniProfile cell4_miniProfile">
                <div class="title-miniProfile-front">
                    ID:
                </div>
            </div>
            <div class="cell_miniProfile cell5_miniProfile">
                <div class="content-miniProfile-front">
                    <?php echo $_SESSION['id_user']; ?>
                </div>
            </div>
            <div class="cell_miniProfile cell6_miniProfile">
                <img class="qr-user-profile"src="data:image/png;base64,<?php echo $qrCode; ?>" alt="QR Code">
            </div>
            <div id="btnDownloadIDFront" class="cell_miniProfile cell7_miniProfile">
                <i class="fa-solid fa-download icon-miniProfile-front"></i>
            </div>
            <div onclick="flipCard()" class="cell_miniProfile cell8_miniProfile">
                <i class="fa-solid fa-circle-chevron-right icon-miniProfile-front"></i>
            </div>
        </div>
    </div>
    <div id="backID" class="card-back-mini-profile">
        <div class="grid-container-miniProfile">
            <div class="cell_miniProfile cell2_miniProfile">
                <div class="title-miniProfile-back">
                    CORREO:
                </div>
            </div>
            <div class="cell_miniProfile cell3_miniProfile">
                <div class="content-miniProfile-back">
                    <?php echo $_SESSION['correo']??"No disponible"; ?>
                </div>
            </div>
<!-- 
            <div class="cell_miniProfile cell6_miniProfile">
                <div id="triggerMyEvents" class="trigger-user-profile" onclick="triggerEvent()">
                    <i class="fa-regular fa-calendar-check"></i>&nbsp;&nbsp;
                    Mis Eventos
                </div>
            </div>
            <div class="cell_miniProfile cell6_miniProfile">
                <div id="triggerMyHistory" class="trigger-user-profile" onclick="triggerHistory()">
                    <i class="fa-solid fa-clock-rotate-left"></i>&nbsp;&nbsp;
                    Historial
                </div>
            </div> -->
            <div class="cell_miniProfile cell6_miniProfile">
                <?php if($_SESSION['staff']):?>
                <div id="triggerStaff" class="trigger-user-profile" onclick="getEventosForStaff()">
                    <i class="fa-solid fa-qrcode"></i>&nbsp;&nbsp;Staff
                </div>
                <?php endif;?>
            </div>
            <div id="btnDownloadIDBack" class="cell_miniProfile cell7_miniProfile">
                <i class="fa-solid fa-download icon-miniProfile-back"></i>
            </div>
            <div onclick="flipCard()" class="cell_miniProfile cell8_miniProfile">
                <i class="fa-solid fa-circle-chevron-right icon-miniProfile-back"></i>
            </div>
        </div>
    </div>
</div>

<?php $script = "
    <script src='http://localhost/IESTEventos/build/js/index/profile.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.2.0/html5-qrcode.min.js'></script>
"; ?>