<?php
/**
 * Archivo de idioma Español para el módulo RHVoice
 */
$dictionary = array(
    'ABOUT' => 'Acerca de',
    'SETTINGS' => 'Ajustes',
    'HELP' => 'Ayuda',
    'VOICE' => 'Voz:',
    'USE_SPD' => 'Utilizar el distribuidor de voz',
    'USE_CACHE' => 'Utilizar caché',
    'RHVOICE_INSTALLATION' => 'Instalación de RHVoice',
    'VOICE_ALEKSANDR' => 'Aleksandr, ruso',
    'VOICE_ELENA' => 'Elena, ruso',
    'VOICE_ANNA' => 'Anna, ruso',
    'VOICE_CLB' => 'Inglés femenino',
    'VOICE_SLT' => 'Inglés masculino',
    'VOICE_NATALIA' => 'Natalia, ucraniano',
    'VOICE_ANATOL' => 'Anatol, ucraniano',
    'VOICE_MARIANNA' => 'Marianna, ucraniano',
    'VOICE_VOLODYMYR' => 'Volodymyr, ucraniano',
    'RHVOICE_RATE' => 'Velocidad de voz, % (100 = normal):',
    'RHVOICE_ABOUT' => 'Módulo RHVoice.',
    'RHVOICE_DISCUSSION' => 'Debate del módulo',
    'HERE' => 'aquí',
    'ON_FORUM' => 'en el foro',
    'CLOSE' => 'Cerrar',
    'USE_REST_API' => 'Utilizar REST API https://github.com/Aculeasis/rhvoice-rest',
    'REST_API_IP' => 'Introduzca la IP del dispositivo con REST API y su puerto:',
    'HELP_MORE' => 'Puede leer más sobre la instalación',
    'HELP_INSTALL_DEPS' => 'Primero instale las dependencias:',
    'HELP_BUILD' => 'Después compile RHVoice:',
    'HELP_CHECK' => 'Puede comprobarlo así:',
    'HELP_OR' => 'o así:',
    'HELP_PHRASE' => 'Hola'
);
foreach ($dictionary as $k => $v) {
    if (!defined('LANG_' . $k)) {
        define('LANG_' . $k, $v);
    }
}
?>