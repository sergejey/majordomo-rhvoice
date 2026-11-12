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
    'VOICE_ANNA' => 'Анна',
    'VOICE_CLB' => 'Женский английский',
    'VOICE_SLT' => 'Мужской английский',
    'VOICE_NATALIA' => 'Наталия (украинский)',
    'VOICE_ANATOL' => 'Анатоль (украинский)',
    'VOICE_MARIANNA' => 'Марьяна (украинский)',
    'VOICE_VOLODYMYR' => 'Владимир (украинский)',
    'RHVOICE_RATE' => 'Скорость речи, % (100 = обычная):'
);

foreach ($dictionary as $k => $v) {
    if (!defined('LANG_' . $k)) {
        define('LANG_' . $k, $v);
    }
}
?>
