<?php
$dictionary = array(
    'ABOUT' => 'About',
    'SETTINGS' => 'Settings',
    'HELP' => 'Help',
    'VOICE' => 'Voice:',
    'USE_SPD' => 'Use Speech Dispatcher',
    'USE_CACHE' => 'Use caching',
    'RHVOICE_INSTALLATION' => 'RHVoice installation',
    'VOICE_ALEKSANDR' => 'Aleksandr, Russian',
    'VOICE_ELENA' => 'Elena, Russian',
    'VOICE_ANNA' => 'Anna, Russian',
    'VOICE_CLB' => 'English, female',
    'VOICE_SLT' => 'English, male',
    'VOICE_NATALIA' => 'Natalia, Ukrainian',
    'VOICE_ANATOL' => 'Anatol, Ukrainian',
    'VOICE_MARIANNA' => 'Marianna, Ukrainian',
    'VOICE_VOLODYMYR' => 'Volodymyr, Ukrainian',
    'RHVOICE_RATE' => 'Speech rate, % (100 = normal):',
    'RHVOICE_ABOUT' => 'RHVoice module.',
    'RHVOICE_DISCUSSION' => 'Module discussion',
    'HERE' => 'here',
    'ON_FORUM' => 'on the forum',
    'CLOSE' => 'Close',
    'USE_REST_API' => 'Use REST API https://github.com/Aculeasis/rhvoice-rest',
    'REST_API_IP' => 'Enter the IP address of the device with REST API and its port:',
    'HELP_MORE' => 'More about installation can be read',
    'HELP_INSTALL_DEPS' => 'First install the dependencies:',
    'HELP_BUILD' => 'Then build RHVoice:',
    'HELP_CHECK' => 'You can check it like this:',
    'HELP_OR' => 'or like this:',
    'HELP_PHRASE' => 'Hello',
    'PITCH' => 'Pitch, % (100 = normal):',
    'VOLUME' => 'Volume, % (100 = normal):',
    'QUALITY' => 'Speech quality:',
    'QUALITY_MAX' => 'Maximum',
    'QUALITY_STANDARD' => 'Standard',
    'QUALITY_MIN' => 'Minimum',
    'SAMPLE_RATE' => 'Sample rate, Hz:',
    'REST_FORMAT' => 'REST API audio format:'
);
foreach ($dictionary as $k => $v) {
    if (!defined('LANG_' . $k)) {
        define('LANG_' . $k, $v);
    }
}
?>
