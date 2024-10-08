<?php 
    $auth= $_SESSION['auth']??null;
    if($auth){
        $tipo=intval($_SESSION['tipo']);
    }
    $version = isset($_SESSION['version']) ? $_SESSION['version'] : '0.10.0';
    $_SESSION['version'] = ++$version;
?>
<!DOCTYPE html>
<html lang="es-Mx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IestEventos</title>
    <link rel="stylesheet" href="http://localhost/IESTEventos/build/css/app.css?v=<?php echo $version; ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="http://localhost/IESTEventos/build/img/index/logo.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    $currentURL = $_SERVER['REQUEST_URI'];
    if (strpos($currentURL, '/eventos') !== false) : ?>
    <?php elseif (strpos($currentURL, '/evento') !== false) : ?>
        <!-- INICIO -->
        <?php if ($_SESSION['tipo'] ?? null == 5) :; ?>
            <div class="ocultar" id="division" value="<?php echo $_SESSION['division']??null ?>"><?php echo $_SESSION['division']??null ?></div>
        <?php endif; ?>
        <div class="ocultar" id="id_user" value="<?php echo $_SESSION['id_user']??null?>"><?php echo $_SESSION['id_user']??null?></div>
        <div class="grid-contenedor-navbarSUGeneral">
                <div class="cell_navbarSUGeneral cell1_navbarSUGeneral"  onclick="location.href='http://localhost/IESTEventos/';">
                    <span class="cell1_orange">IEST</span><span class="cell1_white">Eventos</span>
                </div>
                <div class="cell_navbarSUGeneral cell2_navbarSUGeneral">
                    <div><a href="calendar" class="cell2_menuIndex">
                        <i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</a>
                    </div>&nbsp;
                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                        <div><a href="DashboardRh" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                        <div><a href="Coordinador" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                        <div><a href="Vicerector" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                        <div><a href="AdminEventos" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="cell2_menuIndex">
                            <i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="cell2_menuIndexLogin">
                            Cerrar Sesión&nbsp;&nbsp;
                            <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        </div>&nbsp;
                        <?php else : ?>
                        <div><a href="login" class="cell2_menuIndexLogin">
                        Iniciar Sesión&nbsp;
                        <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                        </div>&nbsp;
                    <?php endif; ?> 
                    <button id="buttonMenuLPO" class="button-burger-LP">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                    </button>
                    <button id="buttonMenuLPC" class="button-burger-LPC">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                    </button>
                </div>
                <div id="infoMenuGeneral" class="cell_navbarSUGeneral cell_infoMenuGeneral">
                    <div><a href="calendar" class="infoMenuGeneral">
                        <div><i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</div>
                        <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                            <div><a href="DashboardRh" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                            <div><a href="Coordinador" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                            <div><a href="Vicerector" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                            <div><a href="AdminEventos" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-rectangle-xmark"></i>&nbsp;
                            Cerrar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php else : ?>
                        <div id="buttonUser"><a href="login" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;
                            Iniciar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    <?php endif; ?> 
                </div>
            </div>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">

    <?php elseif (strpos($currentURL, '/profile') !== false) : ?>
        <!-- INICIO -->
        <?php if ($_SESSION['tipo'] ?? null == 5) :; ?>
            <div class="ocultar" id="division" value="<?php echo $_SESSION['division']??null ?>"><?php echo $_SESSION['division']??null ?></div>

        <?php endif; ?>
        <div class="ocultar" id="id_user" value="<?php echo $_SESSION['id_user']??null?>"><?php echo $_SESSION['id_user']??null?></div>
        <div class="grid-contenedor-navbarSUGeneral">
                <div class="cell_navbarSUGeneral cell1_navbarSUGeneral"  onclick="location.href='http://localhost/IESTEventos/';">
                    <span class="cell1_orange">IEST</span><span class="cell1_white">Eventos</span>
                </div>
                <div class="cell_navbarSUGeneral cell2_navbarSUGeneral">
                    <div><a href="calendar" class="cell2_menuIndex">
                        <i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</a>
                    </div>&nbsp;
                    
                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                        <div><a href="DashboardRh" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                        <div><a href="Coordinador" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                        <div><a href="Vicerector" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                        <div><a href="AdminEventos" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="cell2_menuIndex">
                            <i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="cell2_menuIndexLogin">
                            Cerrar Sesión&nbsp;&nbsp;
                            <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        </div>&nbsp;
                        <?php else : ?>
                        <div><a href="login" class="cell2_menuIndexLogin">
                        Iniciar Sesión&nbsp;
                        <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                        </div>&nbsp;
                    <?php endif; ?> 
                    <button id="buttonMenuLPO" class="button-burger-LP">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                    </button>
                    <button id="buttonMenuLPC" class="button-burger-LPC">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                    </button>
                </div>
                <div id="infoMenuGeneral" class="cell_navbarSUGeneral cell_infoMenuGeneral">
                    <div><a href="calendar" class="infoMenuGeneral">
                        <div><i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</div>
                        <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                    
                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                            <div><a href="DashboardRh" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                            <div><a href="Coordinador" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                            <div><a href="Vicerector" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                            <div><a href="AdminEventos" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-rectangle-xmark"></i>&nbsp;
                            Cerrar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php else : ?>
                        <div id="buttonUser"><a href="login" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;
                            Iniciar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    <?php endif; ?> 
                </div>
            </div>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
    <?php elseif (strpos($currentURL, '/DashboardRh') !== false) : ?>
        <!-- INICIO -->
        <?php if ($_SESSION['tipo'] ?? null == 5) :; ?>
            <div class="ocultar" id="division" value="<?php echo $_SESSION['division']??null ?>"><?php echo $_SESSION['division']??null ?></div>

        <?php endif; ?>
        <div class="ocultar" id="id_user" value="<?php echo $_SESSION['id_user']??null?>"><?php echo $_SESSION['id_user']??null?></div>
        <div class="grid-contenedor-navbarSUGeneral">
                <div class="cell_navbarSUGeneral cell1_navbarSUGeneral"  onclick="location.href='http://localhost/IESTEventos/';">
                    <span class="cell1_orange">IEST</span><span class="cell1_white">Eventos</span>
                </div>
                <div class="cell_navbarSUGeneral cell2_navbarSUGeneral">
                    <div><a href="calendar" class="cell2_menuIndex">
                        <i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</a>
                    </div>&nbsp;
                    
                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                        <div><a href="DashboardRh" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                        <div><a href="Coordinador" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                        <div><a href="Vicerector" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                        <div><a href="AdminEventos" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="cell2_menuIndex">
                            <i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="cell2_menuIndexLogin">
                            Cerrar Sesión&nbsp;&nbsp;
                            <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        </div>&nbsp;
                        <?php else : ?>
                        <div><a href="login" class="cell2_menuIndexLogin">
                        Iniciar Sesión&nbsp;
                        <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                        </div>&nbsp;
                    <?php endif; ?> 
                    <button id="buttonMenuLPO" class="button-burger-LP">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                    </button>
                    <button id="buttonMenuLPC" class="button-burger-LPC">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                    </button>
                </div>
                <div id="infoMenuGeneral" class="cell_navbarSUGeneral cell_infoMenuGeneral">
                    <div><a href="calendar" class="infoMenuGeneral">
                        <div><i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</div>
                        <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                            <div><a href="DashboardRh" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                            <div><a href="Coordinador" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                            <div><a href="Vicerector" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                            <div><a href="AdminEventos" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-rectangle-xmark"></i>&nbsp;
                            Cerrar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php else : ?>
                        <div id="buttonUser"><a href="login" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;
                            Iniciar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    <?php endif; ?> 
                </div>
            </div>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">

    <?php elseif (strpos($currentURL, '/Coordinador') !== false) : ?>
        <!-- INICIO -->
        <?php if ($_SESSION['tipo'] ?? null == 5) :; ?>
            <div class="ocultar" id="division" value="<?php echo $_SESSION['division']??null ?>"><?php echo $_SESSION['division']??null ?></div>

        <?php endif; ?>
        <div class="ocultar" id="id_user" value="<?php echo $_SESSION['id_user']??null?>"><?php echo $_SESSION['id_user']??null?></div>
        <div class="grid-contenedor-navbarSUGeneral">
                <div class="cell_navbarSUGeneral cell1_navbarSUGeneral"  onclick="location.href='http://localhost/IESTEventos/';">
                    <span class="cell1_orange">IEST</span><span class="cell1_white">Eventos</span>
                </div>
                <div class="cell_navbarSUGeneral cell2_navbarSUGeneral">
                    <div><a href="calendar" class="cell2_menuIndex">
                        <i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</a>
                    </div>&nbsp;

                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                        <div><a href="DashboardRh" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                        <div><a href="Coordinador" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                        <div><a href="Vicerector" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                        <div><a href="AdminEventos" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="cell2_menuIndex">
                            <i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="cell2_menuIndexLogin">
                            Cerrar Sesión&nbsp;&nbsp;
                            <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        </div>&nbsp;
                        <?php else : ?>
                        <div><a href="login" class="cell2_menuIndexLogin">
                        Iniciar Sesión&nbsp;
                        <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                        </div>&nbsp;
                    <?php endif; ?> 
                    <button id="buttonMenuLPO" class="button-burger-LP">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                    </button>
                    <button id="buttonMenuLPC" class="button-burger-LPC">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                    </button>
                </div>
                <div id="infoMenuGeneral" class="cell_navbarSUGeneral cell_infoMenuGeneral">
                    <div><a href="calendar" class="infoMenuGeneral">
                        <div><i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</div>
                        <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                    
                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                            <div><a href="DashboardRh" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                            <div><a href="Coordinador" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                            <div><a href="Vicerector" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                            <div><a href="AdminEventos" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-rectangle-xmark"></i>&nbsp;
                            Cerrar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php else : ?>
                        <div id="buttonUser"><a href="login" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;
                            Iniciar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    <?php endif; ?> 
                </div>
            </div>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
        <iframe id="miIframe" src="http://localhost:4200/panel/view" width="100%" style="height: 90vh"></iframe>
    <?php elseif (strpos($currentURL, '/Vicerector') !== false) : ?>
        <!-- INICIO -->
        <?php if ($_SESSION['tipo'] ?? null == 5) :; ?>
            <div class="ocultar" id="division" value="<?php echo $_SESSION['division']??null ?>"><?php echo $_SESSION['division']??null ?></div>

        <?php endif; ?>
        <div class="ocultar" id="id_user" value="<?php echo $_SESSION['id_user']??null?>"><?php echo $_SESSION['id_user']??null?></div>
        <div class="grid-contenedor-navbarSUGeneral">
                <div class="cell_navbarSUGeneral cell1_navbarSUGeneral"  onclick="location.href='http://localhost/IESTEventos/';">
                    <span class="cell1_orange">IEST</span><span class="cell1_white">Eventos</span>
                </div>
                <div class="cell_navbarSUGeneral cell2_navbarSUGeneral">
                    <div><a href="calendar" class="cell2_menuIndex">
                        <i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</a>
                    </div>&nbsp;

                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                        <div><a href="DashboardRh" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                        <div><a href="Coordinador" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                        <div><a href="Vicerector" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                        <div><a href="AdminEventos" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="cell2_menuIndex">
                            <i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="cell2_menuIndexLogin">
                            Cerrar Sesión&nbsp;&nbsp;
                            <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        </div>&nbsp;
                        <?php else : ?>
                        <div><a href="login" class="cell2_menuIndexLogin">
                        Iniciar Sesión&nbsp;
                        <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                        </div>&nbsp;
                    <?php endif; ?> 
                    <button id="buttonMenuLPO" class="button-burger-LP">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                    </button>
                    <button id="buttonMenuLPC" class="button-burger-LPC">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                    </button>
                </div>
                <div id="infoMenuGeneral" class="cell_navbarSUGeneral cell_infoMenuGeneral">
                    <div><a href="calendar" class="infoMenuGeneral">
                        <div><i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</div>
                        <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                   
                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                            <div><a href="DashboardRh" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                            <div><a href="Coordinador" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                            <div><a href="Vicerector" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                            <div><a href="AdminEventos" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-rectangle-xmark"></i>&nbsp;
                            Cerrar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php else : ?>
                        <div id="buttonUser"><a href="login" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;
                            Iniciar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    <?php endif; ?> 
                </div>
            </div>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
    <?php elseif (strpos($currentURL, '/AdminEventos') !== false) : ?>
        <!-- INICIO -->
        <?php if ($_SESSION['tipo'] ?? null == 5) :; ?>
            <div class="ocultar" id="division" value="<?php echo $_SESSION['division']??null ?>"><?php echo $_SESSION['division']??null ?></div>

        <?php endif; ?>
        <div class="ocultar" id="id_user" value="<?php echo $_SESSION['id_user']??null?>"><?php echo $_SESSION['id_user']??null?></div>
        <div class="grid-contenedor-navbarSUGeneral">
                <div class="cell_navbarSUGeneral cell1_navbarSUGeneral"  onclick="location.href='http://localhost/IESTEventos/';">
                    <span class="cell1_orange">IEST</span><span class="cell1_white">Eventos</span>
                </div>
                <div class="cell_navbarSUGeneral cell2_navbarSUGeneral">
                    <div><a href="calendar" class="cell2_menuIndex">
                        <i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</a>
                    </div>&nbsp;

                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                        <div><a href="DashboardRh" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                        <div><a href="Coordinador" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                        <div><a href="Vicerector" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                        <div><a href="AdminEventos" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="cell2_menuIndex">
                            <i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="cell2_menuIndexLogin">
                            Cerrar Sesión&nbsp;&nbsp;
                            <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        </div>&nbsp;
                        <?php else : ?>
                        <div><a href="login" class="cell2_menuIndexLogin">
                        Iniciar Sesión&nbsp;
                        <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                        </div>&nbsp;
                    <?php endif; ?> 
                    <button id="buttonMenuLPO" class="button-burger-LP">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                    </button>
                    <button id="buttonMenuLPC" class="button-burger-LPC">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                    </button>
                </div>
                <div id="infoMenuGeneral" class="cell_navbarSUGeneral cell_infoMenuGeneral">
                    <div><a href="calendar" class="infoMenuGeneral">
                        <div><i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</div>
                        <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                   
                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                            <div><a href="DashboardRh" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                            <div><a href="Coordinador" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                            <div><a href="Vicerector" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                            <div><a href="AdminEventos" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-rectangle-xmark"></i>&nbsp;
                            Cerrar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php else : ?>
                        <div id="buttonUser"><a href="login" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;
                            Iniciar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    <?php endif; ?> 
                </div>
            </div>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
    <?php elseif (strpos($currentURL, '/calendar') !== false) : ?>
        <!-- INICIO -->
        <?php if ($_SESSION['tipo'] ?? null == 5) :; ?>
            <div class="ocultar" id="division" value="<?php echo $_SESSION['division']??null ?>"><?php echo $_SESSION['division']??null ?></div>

        <?php endif; ?>
        <div class="ocultar" id="id_user" value="<?php echo $_SESSION['id_user']??null?>"><?php echo $_SESSION['id_user']??null?></div>
        <div class="video-container">
            <video autoplay loop muted>
                <source src="http://localhost/IESTEventos/build/img/index/Banner_Calendario.mp4" type="video/mp4">
            </video>
            <div class="grid-contenedor-navbarCalendar">
                <div class="cell_navbarCalendar cell1_navbarCalendar" onclick="window.location.href = 'http://localhost/IESTEventos/'">
                    <span class="cell1_orange">IEST</span><span class="cell1_white">Eventos</span>
                </div>
                <div class="cell_navbarCalendar cell2_navbarCalendar">
                    <div><a href="calendar" class="cell2_menuIndex">
                        <i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</a>
                    </div>&nbsp;
                   
                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                        <div><a href="DashboardRh" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                        <div><a href="Coordinador" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                        <div><a href="Vicerector" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                        <div><a href="AdminEventos" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="cell2_menuIndex">
                            <i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="cell2_menuIndexLogin">
                            Cerrar Sesión&nbsp;&nbsp;
                            <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        </div>&nbsp;
                        <?php else : ?>
                        <div><a href="login" class="cell2_menuIndexLogin">
                            Iniciar Sesión&nbsp;
                            <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                        </div>&nbsp;
                        <?php endif; ?>
                    <button id="buttonMenuLPO" class="button-burger-LP">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                    </button>
                    <button id="buttonMenuLPC" class="button-burger-LPC">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                    </button>
                </div>
                <div id="infoMenuCalendar" class="cell_navbarCalendar cell_infoMenuCalendar">
                    <div><a href="calendar" class="infoMenuCalendar">
                        <div><i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</div>
                        <i class="fa-solid fa-chevron-right"></i></a>
                    </div>

                    <?php if ($auth) : ?>
                        <?php if ($tipo >= 3) : ?>
                        <div><a href="DashboardRh" class="infoMenuCalendar">
                            <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="infoMenuCalendar">
                            <div><i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="infoMenuCalendar">
                            <div><i class="fa-solid fa-rectangle-xmark"></i>&nbsp;
                            Cerrar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php else : ?>
                        <div id="buttonUser"><a href="login" class="infoMenuCalendar">
                            <div><i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;
                            Iniciar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="cell_navbarCalendar cell3_navbarCalendar">
                    <div class="cell3_TitleCalendar"><span class="cell1_white">Calendario de Eventos</span></div>
                </div>
            </div>
        </div>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
    <?php elseif (strpos($currentURL, '/login') !== false ||strpos($currentURL, '/login') !== false ||strpos($currentURL, '/escaner') !== false || strpos($currentURL, '/AdminEventos') !== false || strpos($currentURL, '/Coordinador') !== false || strpos($currentURL, '/Coordinador/editarevento') !== false || strpos($currentURL, '/Vicerector') !== false): ?>
        <!-- INICIO -->
        <?php if ($_SESSION['tipo'] ?? null == 5) :; ?>
            <div class="ocultar" id="division" value="<?php echo $_SESSION['division']??null ?>"><?php echo $_SESSION['division']??null ?></div>

        <?php endif; ?>
        <div class="ocultar" id="id_user" value="<?php echo $_SESSION['id_user']??null?>"><?php echo $_SESSION['id_user']??null?></div>
        <div class="grid-contenedor-navbarSUGeneral">
                <div class="cell_navbarSUGeneral cell1_navbarSUGeneral"  onclick="location.href='http://localhost/IESTEventos/';">
                    <span class="cell1_orange">IEST</span><span class="cell1_white">Eventos</span>
                </div>
                <div class="cell_navbarSUGeneral cell2_navbarSUGeneral">
                    <div><a href="calendar" class="cell2_menuIndex">
                        <i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</a>
                    </div>&nbsp;

                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                        <div><a href="DashboardRh" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                        <div><a href="Coordinador" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                        <div><a href="Vicerector" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                        <div><a href="AdminEventos" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="cell2_menuIndex">
                            <i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="cell2_menuIndexLogin">
                            Cerrar Sesión&nbsp;&nbsp;
                            <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        </div>&nbsp;
                        <?php else : ?>
                        <div><a href="login" class="cell2_menuIndexLogin">
                        Iniciar Sesión&nbsp;
                        <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                        </div>&nbsp;
                    <?php endif; ?> 
                    <button id="buttonMenuLPO" class="button-burger-LP">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                    </button>
                    <button id="buttonMenuLPC" class="button-burger-LPC">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                    </button>
                </div>
                <div id="infoMenuGeneral" class="cell_navbarSUGeneral cell_infoMenuGeneral">
                    <div><a href="calendar" class="infoMenuGeneral">
                        <div><i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</div>
                        <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                            <div><a href="DashboardRh" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                            <div><a href="Coordinador" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                            <div><a href="Vicerector" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                            <div><a href="AdminEventos" class="infoMenuGeneral">
                                <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                                Panel</div>
                                <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-rectangle-xmark"></i>&nbsp;
                            Cerrar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php else : ?>
                        <div id="buttonUser"><a href="login" class="infoMenuGeneral">
                            <div><i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;
                            Iniciar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    <?php endif; ?> 
                </div>
            </div>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
    <?php elseif (strpos($currentURL, '/') !== false) : ?>
        <!-- INICIO -->
        <?php if ($_SESSION['tipo'] ?? null == 5) :; ?>
        <div class="ocultar" id="division" value="<?php echo $_SESSION['division'] ?>"><?php echo $_SESSION['division'] ?></div>
        <?php endif; ?>
        <div class="ocultar" id="id_user" value="<?php echo $_SESSION['id_user']??null ?>"><?php echo $_SESSION['id_user']??null ?></div>
        <div class="video-container" style="max-height: 52vh;">
            <video autoplay loop muted>
                <source src="http://localhost/IESTEventos/build/img/index/ejemplovideo2.mp4" type="video/mp4">
            </video>
            <div class="grid-contenedor-navbarLPGeneral">
                <div class="cell_navbarLPGeneral cell1_navbarLPGeneral" onclick="window.location.href = 'http://localhost/IESTEventos/'">
                    <span class="cell1_orange">IEST</span><span class="cell1_white">Eventos</span>
                </div>
                <div class="cell_navbarLPGeneral cell2_navbarLPGeneral">
                    <div><a href="calendar" class="cell2_menuIndex">
                        <i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</a>
                    </div>&nbsp;

                    <?php if ($auth) : ?>
                        <?php if ($tipo == 3) : ?>
                        <div><a href="DashboardRh" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 5) : ?>
                        <div><a href="Coordinador" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 6) : ?>
                        <div><a href="Vicerector" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo == 7) : ?>
                        <div><a href="AdminEventos" class="cell2_menuIndex">
                            <i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="cell2_menuIndex">
                            <i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</a>
                        </div>&nbsp;
                        <?php endif; ?>
                        <div id="buttonUser"><a href="logout" class="cell2_menuIndexLogin">
                            Cerrar Sesión&nbsp;&nbsp;
                            <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        </div>&nbsp;
                        <?php else : ?>
                        <div><a href="login" class="cell2_menuIndexLogin">
                            Iniciar Sesión&nbsp;
                            <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                        </div>&nbsp;
                        <?php endif; ?>
                    <button id="buttonMenuLPO" class="button-burger-LP">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                    </button>
                    <button id="buttonMenuLPC" class="button-burger-LPC">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                    </button>
                </div>
                <div id="infoMenu" class="cell_navbarLPGeneral cell_infoMenu">
                    <div><a href="calendar" class="infoMenu">
                        <div><i class="fa-solid fa-calendar-days"></i>&nbsp;
                        Calendario de Eventos</div>
                        <i class="fa-solid fa-chevron-right"></i></a>
                    </div>

                    <?php if ($auth) : ?>
                        <?php if ($tipo >= 3) : ?>
                        <div><a href="DashboardRh" class="infoMenu">
                            <div><i class="fa-solid fa-table-list"></i>&nbsp;    
                            Panel</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php endif; ?>
                        <?php if ($tipo >= 2) : ?>
                        <div><a href="profile" class="infoMenu">
                            <div><i class="fa-solid fa-user"></i>&nbsp;    
                            Mi Perfil</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php endif; ?>
                        <div id="buttonUser"><a ="logout" class="infoMenu">
                            <div><i class="fa-solid fa-rectangle-xmark"></i>&nbsp;
                            Cerrar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <?php else : ?>
                        <div id="buttonUser"><a href="login" class="infoMenu">
                            <div><i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;
                            Iniciar Sesión</div>
                            <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="cell_navbarLPGeneral cell3_navbarLPGeneral">
                    <div class="cell3_Title"><span class="cell1_orange">IEST</span><span class="cell1_white">Eventos</span></div>
                    <?php if (!$auth) : ?>
                    <div>
                        <a href="login"><div class="cell3_Login">Iniciar Sesión</div></a>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="cell_navbarLPGeneral cell4_navbarLPGeneral"></div>
            </div>
        </div>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
    <?php else : ?>
    <?php endif; ?>


    <?php echo $contenido; ?>

    <?php echo $script ?? ''; ?>
    <script src='http://localhost/IESTEventos/build/js/index/navbar.js'></script>
    <script src="http://localhost/IESTEventos/build/js/general/variables.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const iframe = document.getElementById('miIframe');
            if(iframe){
                iframe.onload = () => {
                    // Enviar un mensaje al iframe con el valor del padre
                    const mensaje = document.getElementById('id_user').textContent;
                    iframe.contentWindow.postMessage(mensaje, 'http://localhost:4200'); // Asegúrate de usar el origen correcto
                    console.log("Se envio el mensaje")
                };
            }
        });

    </script>
    <footer class="footer-section">
    <div class="contenedor">
              <div class="footer-content pt-5 pb-1">
                  <div class="row">
                      <div class="col-xl-4 col-lg-4 mb-50">
                          <div class="footer-widget">
                              <div class="footer-text">
                                  <p>Instituto de Estudios Superiores de Tamaulipas, es una institución acreditada lisa <br> y llana por la Federación de Instituciones Mexicanas Particulares de Educación Superior A.C.</p>
                              </div>
                              <div class="footer-social-icon">
                                </a>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
          </div>

</footer>
</body>


</html>