<?php

/**
 * Default language file for RHVoice module
 *
 */
$dictionary = array(
    'ABOUT' => 'About',
    'SETTINGS' => 'Settings',
    'HELP' => 'Help',
    'VOICE' => 'Voice:',
    'USE_SPD' => 'Use Speech Dispatcher',
    'USE_CACHE' => 'Use caching',
    'RHVOICE_INSTALLATION' => 'RHVoice installation',
    'VOICE_ALEKSANDR' => 'Aleksandr Russian',
    'VOICE_ELENA' => 'Elena Russian',
    'VOICE_ANNA' => 'Anna Russian',
    'VOICE_CLB' => 'English women',
    'VOICE_SLT' => 'English men',

);

foreach ($dictionary as $k => $v) {
    if (!defined('LANG_' . $k)) {
        define('LANG_' . $k, $v);
    }
}
?>
