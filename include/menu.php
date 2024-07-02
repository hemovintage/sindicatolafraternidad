<?php
/* LINKS PARA MENU */

/* Aca declaro todas las variables que se usaran para los links de Menu */
$menu_base = 'index.php?p=';

$menu_void =                'javascript:void(0);';

$menu_inicio =              $menu_base . 'inicio';
$menu_nuestraHistoria =     $menu_base . 'nuestraHistoria';
$menu_comisionDirectiva =   $menu_base . 'comisionDirectiva';
$menu_aQuienesAyudamos =    $menu_base . 'aQuienesAyudamos';
$menu_listadoDeEscuelas =   $menu_base . 'listadoDeEscuelas';
$menu_quienesNosAyudan =    $menu_base . 'quienesNosAyudan';
$menu_becas =               $menu_base . 'becas';
$menu_descargas =           $menu_base . 'descargas';
$menu_contacto =            'action/tb/contacto.php?height=420&width=400';
$menu_comoColaboro =        $menu_base . 'comoColaboro';
$menu_cursoDeMotos =        $menu_base . 'cursoDeMotos';

/* Capturo el flag de seccion actual, en caso que no exista uno declarado será ´inicio´ */
if(empty($_REQUEST['p']))
{
    $actualSeleccion = $menu_base . 'inicio';    
}
else
{
    $actualSeleccion = $menu_base . $_REQUEST['p'];
}
?>
			<div class="menu">
            	<ul>
                	<li class="menu-espacio-inicial"></li>
                	<li class="menu-logo">
                    	<img src="img/<?php echo $content_logo; ?>" alt="" title="" />  
                    </li>
                	<li class="menu-item menu-li-fix">
                        <span class="span-orange" style="<?php if($actualSeleccion == $menu_inicio){ echo 'display:block; '; } ?> width: 65px; margin-left: -5px;"></span>
                    	<a href="<?php echo $menu_inicio; ?>">Inicio</a>
                    </li>
                    <li class="menu-item menu-li-fix separadorMenu"></li>
                	<li class="menu-item menu-li-fix menu_item" id="quienessomos">
                        <span class="span-orange" style="<?php if( ($actualSeleccion == $menu_nuestraHistoria) || ($actualSeleccion == $menu_comisionDirectiva) || ($actualSeleccion == $menu_aQuienesAyudamos) ){ echo 'display:block; '; } ?> width: 120px; margin-left: 2px;"></span>
                    	<a href="<?php echo $menu_void; ?>">¿Quiénes Somos?</a>
                    </li>
                    <li class="menu-item menu-li-fix separadorMenu"></li>
                	<li class="menu-item menu-li-fix menu_item" id="lasescuelas">
                        <span class="span-orange" style="<?php if( ($actualSeleccion == $menu_listadoDeEscuelas) || ($actualSeleccion == $menu_quienesNosAyudan) || ($actualSeleccion == $menu_becas) ){ echo 'display:block; '; } ?> width: 94px; margin-left: 2px;"></span>
                    	<a href="<?php echo $menu_void; ?>">Las Escuelas</a>
                    </li>
                    <li class="menu-item menu-li-fix separadorMenu"></li>
                	<li class="menu-item menu-li-fix">
                        <span class="span-orange" style="<?php if($actualSeleccion == $menu_descargas){ echo 'display:block; '; } ?> width: 94px; margin-left: 3px;"></span>
                    	<a href="<?php echo $menu_descargas; ?>">DESCARGAS</a>
                    </li>
                    <li class="menu-item menu-li-fix separadorMenu"></li>
                	<li class="menu-item menu-li-fix">
                    	<a href="<?php echo $menu_contacto; ?>" class="thickboxC">Contacto</a>
                    </li>
					<li class="menu-item-ultimo menu-li-fix separadorMenu"></li>
                	<li class="menu-item-ultimo menu-li-fix">
                        <span class="span-black" style="<?php if($actualSeleccion == $menu_comoColaboro){ echo 'display:block; '; } ?> width: 105px; margin-left: 12px;"></span>
                    	<a href="<?php echo $menu_comoColaboro; ?>">¿Cómo Colaboro?</a>
                    </li>
                </ul>
            </div>
            <!-- SUBMENU -->
            <div class="submenu menu_tray" id="menu_quienessomos" >
            	<ul style="margin-left: 248px;">
                	<li>
                        <a href="<?php echo $menu_nuestraHistoria; ?>">Nuestra Historia</a>
                    </li>
                	<li>
                        <a href="<?php echo $menu_comisionDirectiva; ?>">Comisión Directiva</a>
                    </li>
                	<li>
                        <a href="<?php echo $menu_aQuienesAyudamos ?>">Cómo y a quiénes ayudamos</a>
                    </li>
                </ul>
            </div>
            <div class="submenu menu_tray" id="menu_lasescuelas" >
            	<ul style="margin-left: 420px;">
                	<li>
                        <a href="<?php echo $menu_listadoDeEscuelas; ?>">Listado de Escuelas</a>
                    </li>
                	<li>
                        <a href="<?php echo $menu_quienesNosAyudan; ?>">Quiénes nos Ayudan</a>
                    </li>
                	<li>
                        <a href="<?php echo $menu_becas; ?>">Becas</a>
                    </li>
                </ul>
            </div>
            <div class="main-image">
            	<img src="img/<?php echo $content_image; ?>" title="" alt="" />
            </div>
