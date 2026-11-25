<?php
$dictionary = array(
    'ABOUT' => 'Про модуль',
    'SETTINGS' => 'Налаштування',
    'HELP' => 'Довідка',
    'VOICE' => 'Голос:',
    'USE_SPD' => 'Використовувати Speech Dispatcher',
    'USE_CACHE' => 'Використовувати кешування',
    'RHVOICE_INSTALLATION' => 'Встановлення RHVoice',
    'VOICE_ALEKSANDR' => 'Олександр (російська)',
    'VOICE_ELENA' => 'Олена (російська)',
    'VOICE_ANNA' => 'Анна (російська)',
    'VOICE_CLB' => 'Англійська жіноча',
    'VOICE_SLT' => 'Англійська чоловіча',
    'VOICE_NATALIA' => 'Наталія (українська)',
    'VOICE_ANATOL' => 'Анатоль (українська)',
    'VOICE_MARIANNA' => 'Маріанна (українська)',
    'VOICE_VOLODYMYR' => 'Володимир (українська)',
    'RHVOICE_RATE' => 'Швидкість мовлення, % (100 = нормальна):',
    'RHVOICE_ABOUT' => 'Модуль RHVoice.',
    'RHVOICE_DISCUSSION' => 'Обговорення модуля',
    'HERE' => 'тут',
    'ON_FORUM' => 'на форумі',
    'CLOSE' => 'Закрити',
    'USE_REST_API' => 'Використовувати REST API https://github.com/Aculeasis/rhvoice-rest',
    'REST_API_IP' => 'Введіть IP-адресу пристрою з REST API та порт через двокрапку:',
    'HELP_MORE' => 'Докладніше про встановлення можна прочитати',
    'HELP_INSTALL_DEPS' => 'Спочатку встановлюємо залежності:',
    'HELP_BUILD' => 'Потім збираємо RHVoice:',
    'HELP_CHECK' => 'Перевірити можна так:',
    'HELP_OR' => 'або так:',
    'HELP_PHRASE' => 'Привіт',
    'PITCH' => 'Висота голосу, % (100 = нормальна):',
    'VOLUME' => 'Гучність, % (100 = нормальна):',
    'QUALITY' => 'Якість мовлення:',
    'QUALITY_MAX' => 'Максимальна',
    'QUALITY_STANDARD' => 'Стандартна',
    'QUALITY_MIN' => 'Мінімальна',
    'SAMPLE_RATE' => 'Частота дискретизації, Гц:',
    'REST_FORMAT' => 'Формат аудіо REST API:'
);
foreach ($dictionary as $k => $v) {
    if (!defined('LANG_' . $k)) {
        define('LANG_' . $k, $v);
    }
}
?>
