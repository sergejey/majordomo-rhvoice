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