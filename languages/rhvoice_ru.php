<?php

/**
 * Russian language file for RHVoice module
 *
 */
$dictionary = array(
    'ABOUT' => 'О модуле',
    'SETTINGS' => 'Настройки',
    'HELP' => 'Помощь',
    'VOICE' => 'Голос:',
    'USE_SPD' => 'Использовать Speech Dispatcher',
    'USE_CACHE' => 'Использовать кэширование',
    'RHVOICE_INSTALLATION' => 'Установка RHVoice',
    'VOICE_ALEKSANDR' => 'Александр',
    'VOICE_ELENA' => 'Елена',
    'VOICE_ANNA' => 'Анна'
);

foreach ($dictionary as $k => $v) {
    if (!defined('LANG_' . $k)) {
        define('LANG_' . $k, $v);
    }
}
?>