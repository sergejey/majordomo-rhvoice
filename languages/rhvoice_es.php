<?php

/**
 * Archivo de idioma Español para el módulo RHVoice
 *
 */
$dictionary = array(
    'ABOUT' => 'Acerca de',
    'SETTINGS' => 'Ajustes',
    'HELP' => 'Ayuda',
    'VOICE' => 'Voz:',
    'USE_SPD' => 'Utilizar el distribuidor de voz',
    'USE_CACHE' => 'Utilizar caché',
    'RHVOICE_INSTALLATION' => 'Instalación de RHVoice',
    'VOICE_ALEKSANDR' => 'Aleksandr',
    'VOICE_ELENA' => 'Elena',
    'VOICE_ANNA' => 'Anna'
);

foreach ($dictionary as $k => $v) {
    if (!defined('LANG_' . $k)) {
        define('LANG_' . $k, $v);
    }
}
?>