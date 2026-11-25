<?php
$dictionary = array(
    'ABOUT' => 'О модуле',
    'SETTINGS' => 'Настройки',
    'HELP' => 'Помощь',
    'VOICE' => 'Голос:',
    'USE_SPD' => 'Использовать Speech Dispatcher',
    'USE_CACHE' => 'Использовать кэширование',
    'RHVOICE_INSTALLATION' => 'Установка RHVoice',
    'VOICE_ALEKSANDR' => 'Александр (русский)',
    'VOICE_ELENA' => 'Елена (русский)',
    'VOICE_ANNA' => 'Анна (русский)',
    'VOICE_CLB' => 'Английский женский',
    'VOICE_SLT' => 'Английский мужской',
    'VOICE_NATALIA' => 'Наталия (украинский)',
    'VOICE_ANATOL' => 'Анатоль (украинский)',
    'VOICE_MARIANNA' => 'Марьяна (украинский)',
    'VOICE_VOLODYMYR' => 'Владимир (украинский)',
    'RHVOICE_RATE' => 'Скорость речи, % (100 = обычная):',
    'RHVOICE_ABOUT' => 'Модуль RHVoice.',
    'RHVOICE_DISCUSSION' => 'Обсуждение модуля',
    'HERE' => 'здесь',
    'ON_FORUM' => 'на форуме',
    'CLOSE' => 'Закрыть',
    'USE_REST_API' => 'Использовать REST API https://github.com/Aculeasis/rhvoice-rest',
    'REST_API_IP' => 'Введите IP-адрес устройства с REST API и порт через двоеточие:',
    'HELP_MORE' => 'Подробнее об установке можно прочитать',
    'HELP_INSTALL_DEPS' => 'Сначала устанавливаем зависимости:',
    'HELP_BUILD' => 'Затем собираем RHVoice:',
    'HELP_CHECK' => 'Проверить можно так:',
    'HELP_OR' => 'или так:',
    'HELP_PHRASE' => 'Привет'
);
foreach ($dictionary as $k => $v) {
    if (!defined('LANG_' . $k)) {
        define('LANG_' . $k, $v);
    }
}
?>