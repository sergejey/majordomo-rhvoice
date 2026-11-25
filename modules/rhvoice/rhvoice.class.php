<?php

/**
 * rhvoice
 * @package project
 * @author Dark_Veter <veter.dark@gmail.com>
 * @copyright Dark_Veter (c)
 * @version 0.1 (wizard, 15:03:33 [Mar 14, 2016])
 */
//
//
class rhvoice extends module
{

    /**
     * rhvoice
     *
     * Module class constructor
     *
     * @access private
     */
    function rhvoice()
    {
        $this->name = "rhvoice";
        $this->title = "RHVoice";
        $this->module_category = "<#LANG_SECTION_APPLICATIONS#>";
        $this->checkInstalled();
    }

    /**
     * saveParams
     *
     * Saving module parameters
     *
     * @access public
     */
    function saveParams($data = 0)
    {
        $p = array();
        if (isset($this->id)) {
            $p["id"] = $this->id;
        }
        if (isset($this->view_mode)) {
            $p["view_mode"] = $this->view_mode;
        }
        if (isset($this->edit_mode)) {
            $p["edit_mode"] = $this->edit_mode;
        }
        if (isset($this->tab)) {
            $p["tab"] = $this->tab;
        }
        return parent::saveParams($p);
    }

    /**
     * getParams
     *
     * Getting module parameters from query string
     *
     * @access public
     */
    function getParams()
    {
        global $id;
        global $mode;
        global $view_mode;
        global $edit_mode;
        global $tab;
        if (isset($id)) {
            $this->id = $id;
        }
        if (isset($mode)) {
            $this->mode = $mode;
        }
        if (isset($view_mode)) {
            $this->view_mode = $view_mode;
        }
        if (isset($edit_mode)) {
            $this->edit_mode = $edit_mode;
        }
        if (isset($tab)) {
            $this->tab = $tab;
        }
    }

    /**
     * Run
     *
     * Description
     *
     * @access public
     */
    function run()
    {
        global $session;
        $out = array();
        if ($this->action == 'admin') {
            $this->admin($out);
        } else {
            $this->usual($out);
        }
        if (isset($this->owner->action)) {
            $out['PARENT_ACTION'] = $this->owner->action;
        }
        if (isset($this->owner->name)) {
            $out['PARENT_NAME'] = $this->owner->name;
        }
        $out['VIEW_MODE'] = $this->view_mode;
        $out['EDIT_MODE'] = $this->edit_mode;
        $out['MODE'] = $this->mode;
        $out['ACTION'] = $this->action;
        $this->data = $out;
        $p = new parser(DIR_TEMPLATES . $this->name . "/" . $this->name . ".html", $this->data, $this);
        $this->result = $p->result;
    }

    /**
     * BackEnd
     *
     * Module backend
     *
     * @access public
     */
    function admin(&$out)
    {
        $this->getConfig();
        $out['VOICE'] = isset($this->config['VOICE']) ? $this->config['VOICE'] : '';
        $out['USE_SPD'] = isset($this->config['USE_SPD']) ? $this->config['USE_SPD'] : '';
        $out['USE_CACHE'] = isset($this->config['USE_CACHE']) ? $this->config['USE_CACHE'] : '';
        $out['USE_REST_API'] = isset($this->config['USE_REST_API']) ? $this->config['USE_REST_API'] : '';
        $out['IP_FOR_USERESTAPI'] = isset($this->config['IP_FOR_USERESTAPI']) ? $this->config['IP_FOR_USERESTAPI'] : '';
        $out['RATE'] = isset($this->config['RATE']) ? (int)$this->config['RATE'] : '';
        $out['PITCH'] = isset($this->config['PITCH']) ? (int)$this->config['PITCH'] : '';
        $out['VOLUME'] = isset($this->config['VOLUME']) ? (int)$this->config['VOLUME'] : '';
        $out['QUALITY'] = isset($this->config['QUALITY']) ? $this->config['QUALITY'] : '';
        $out['SAMPLE_RATE'] = isset($this->config['SAMPLE_RATE']) ? (int)$this->config['SAMPLE_RATE'] : '';
        $out['REST_FORMAT'] = isset($this->config['REST_FORMAT']) ? $this->config['REST_FORMAT'] : 'mp3';

        if (!$out['VOICE']) {
            $out['VOICE'] = 'Anna+CLB';
        }
        if ($this->view_mode == 'update_settings') {
            global $voice;
            $this->config['VOICE'] = $voice;
            global $use_spd;
            $this->config['USE_SPD'] = $use_spd;
            global $use_cache;
            $this->config['USE_CACHE'] = $use_cache;
            global $use_rest_api;
            $this->config['USE_REST_API'] = $use_rest_api;
            global $ip_for_userestapi;
            $this->config['IP_FOR_USERESTAPI'] = $ip_for_userestapi;
            global $rate;
            $rate = (int)$rate;
            $this->config['RATE'] = ($rate > 0 && $rate <= 300) ? $rate : '';
            global $pitch;
            $pitch = (int)$pitch;
            $this->config['PITCH'] = ($pitch > 0 && $pitch <= 300) ? $pitch : '';
            global $volume;
            $volume = (int)$volume;
            $this->config['VOLUME'] = ($volume > 0 && $volume <= 300) ? $volume : '';
            global $quality;
            $this->config['QUALITY'] = in_array($quality, array('max', 'standard', 'min'), true) ? $quality : '';
            global $sample_rate;
            $sample_rate = (int)$sample_rate;
            $this->config['SAMPLE_RATE'] = in_array($sample_rate, array(16000, 24000, 48000), true) ? $sample_rate : '';
            global $rest_format;
            $this->config['REST_FORMAT'] = in_array($rest_format, array('wav', 'mp3', 'opus', 'flac'), true) ? $rest_format : 'mp3';


            $this->saveConfig();
            $this->redirect("?");
        }
    }

    /**
     * FrontEnd
     *
     * Module frontend
     *
     * @access public
     */
    function usual(&$out)
    {
        $this->admin($out);
    }

    // RHVoice-test option for the speech rate setting (percent, 100 = normal); empty = RHVoice default
    function rateOption()
    {
        $rate = isset($this->config['RATE']) ? (int)$this->config['RATE'] : 0;
        return ($rate > 0 && $rate != 100) ? ' -r ' . $rate : '';
    }

    function speechOptions()
    {
        $options = $this->speechOptions();
        foreach (array('PITCH' => '-t', 'VOLUME' => '-v') as $key => $flag) {
            $value = isset($this->config[$key]) ? (int)$this->config[$key] : 0;
            if ($value > 0 && $value <= 300 && $value != 100) {
                $options .= ' ' . $flag . ' ' . $value;
            }
        }
        $quality = isset($this->config['QUALITY']) ? $this->config['QUALITY'] : '';
        if (in_array($quality, array('max', 'standard', 'min'), true)) {
            $options .= ' -q ' . $quality;
        }
        $sampleRate = isset($this->config['SAMPLE_RATE']) ? (int)$this->config['SAMPLE_RATE'] : 0;
        if (in_array($sampleRate, array(16000, 24000, 48000), true)) {
            $options .= ' -R ' . $sampleRate;
        }
        return $options;
    }

    function restOptions($voice)
    {
        $format = isset($this->config['REST_FORMAT']) ? $this->config['REST_FORMAT'] : 'mp3';
        if (!in_array($format, array('wav', 'mp3', 'opus', 'flac'), true)) {
            $format = 'mp3';
        }
        $parts = array('voice=' . urlencode($voice), 'format=' . $format);
        foreach (array('RATE', 'PITCH', 'VOLUME') as $key) {
            $value = isset($this->config[$key]) ? (int)$this->config[$key] : 100;
            if ($value <= 0 || $value > 300) {
                $value = 100;
            }
            $parts[] = strtolower($key) . '=' . (int)round($value / 2);
        }
        return '&' . implode('&', $parts);
    }
    function processSubscription($event, &$details)
    {
        $this->getConfig();
        // add for Terminals2
        if (isset($details['SOURCE'])) {
            $use_rest_api = isset($this->config['USE_REST_API']) ? $this->config['USE_REST_API'] : 0;
            if (($event == 'SAY' || $event == 'SAYTO' || $event == 'SAYREPLY') && !$use_rest_api) {
                $voice = $this->config['VOICE'];
                DebMes("Processing $event: " . json_encode($details, JSON_UNESCAPED_UNICODE), 'terminals');
                $out = '';
                $message = $details['MESSAGE'];
                $level = $details['IMPORTANCE'];
                $mmd5 = md5($message . $this->speechOptions() . $voice);
                $cached_filename = ROOT . 'cms/cached/voice/rh_' . $mmd5 . '.wav';
                $details['CACHED_FILENAME'] = $cached_filename;
                $details['tts_engine'] = 'rhvoice_tts';
                if (!file_exists($cached_filename)) {
                    $cmd = 'echo "' . $details['MESSAGE'] . '" | RHVoice-test' . $this->speechOptions() . ' -o "' . $cached_filename . '" -p ' . $voice;
                    safe_exec($cmd, 1, $level);
                    processSubscriptionsSafe('SAY_CACHED_READY', $details);
                } else {
                    processSubscriptions('SAY_CACHED_READY', $details);
                }
                $details['BREAK'] = true;
                return true;
            }
            $ip_for_userestapi = isset($this->config['IP_FOR_USERESTAPI']) ? $this->config['IP_FOR_USERESTAPI'] : '';
            if ($use_rest_api && ($event == 'SAY' || $event == 'SAYTO' || $event == 'SAYREPLY')) {
                DebMes("Processing $event: " . json_encode($details, JSON_UNESCAPED_UNICODE), 'terminals');
                $voice = isset($this->config['VOICE']) ? $this->config['VOICE'] : 'Anna+CLB';
                $message = $details['MESSAGE'];
                $mmd5 = md5($message . $this->restOptions(isset($this->config['VOICE']) ? $this->config['VOICE'] : 'Anna+CLB'));
                $cached_filename = ROOT . 'cms/cached/voice/rh_' . $mmd5 . '.mp3';
                $details['CACHED_FILENAME'] = $cached_filename;
                $details['tts_engine'] = 'rhvoice_tts';
                $cachedVoiceDir = ROOT . 'cms/cached/voice';

                if (!file_exists($cached_filename) && $ip_for_userestapi) {
                    $base_url = 'http://' . $ip_for_userestapi . '/say?text=' . urlencode($message) . $this->restOptions($voice);
                    try {
                        $contents = file_get_contents($base_url);
                    } catch (Exception $e) {
                        registerError('RH_VOICE_REST_API', get_class($e) . ', ' . $e->getMessage());
                    }
                    if (isset($contents)) {
                        CreateDir($cachedVoiceDir);
                        SaveFile($cached_filename, $contents);
                        processSubscriptions('SAY_CACHED_READY', $details);
                    }
                } else {
                    processSubscriptions('SAY_CACHED_READY', $details);
                }
                $details['BREAK'] = true;
                return true;
            }
            return false;
        }


        $level = (int)$details['level'];
        $message = $details['message'];
        $voice = isset($this->config['VOICE']) ? $this->config['VOICE'] : '';
        $destination = isset($details['destination']) ? $details['destination'] : '';

        if (is_dir(ROOT . 'cms/cached')) {
            $cached_filename = ROOT . 'cms/cached/voice/rh_' . md5($message . $this->speechOptions() . (isset($this->config['VOICE']) ? $this->config['VOICE'] : '')) . '.wav';
        } else {
            $cached_filename = ROOT . 'cached/voice/rh_' . md5($message . $this->speechOptions() . (isset($this->config['VOICE']) ? $this->config['VOICE'] : '')) . '.wav';
        }

        if ($event == 'SAY' && !isset($details['ignoreVoice'])) {
            if ($level >= (int)getGlobal('minMsgLevel') && !IsWindowsOS()) {
                $out = '';
                $use_spd = isset($this->config['USE_SPD']) ? $this->config['USE_SPD'] : false;
                $use_cache = isset($this->config['USE_CACHE']) ? $this->config['USE_CACHE'] : false;
                if ($use_spd) {
                    safe_exec('spd-say "' . $message . '" -w -y ' . $voice, 1, $out);
                } else {
                    if ($use_cache) {
                        if (!file_exists($cached_filename)) {
                            if (defined('AUDIO_PLAYER') && AUDIO_PLAYER != '') {
                                $audio_player = AUDIO_PLAYER;
                            } else {
                                $audio_player = 'mplayer';
                            }
                            safe_exec('echo "' . $message . '" | RHVoice-test' . $this->speechOptions() . ' -p ' . $voice . ' -o ' . $cached_filename . ' && ' . $audio_player . ' ' . $cached_filename, 1, $out);
                        } else {
                            playSound($cached_filename, 1);
                        }

                        if (file_exists($cached_filename)) {
                            processSubscriptions('SAY_CACHED_READY', array(
                                'level' => $level,
                                'tts_engine' => 'rhvoice',
                                'message' => $message,
                                'filename' => $cached_filename,
                                'destination' => $destination,
                                'event' => $event,
                            ));
                        }
                    } else {
                        safe_exec('echo "' . $message . '" | RHVoice-test' . $this->speechOptions() . ' -p ' . $voice, 1, $out);
                    }
                }
                $details['ignoreVoice'] = 1;
            }
            //...
        } elseif ($event == 'SAYTO' || $event == 'ASK') {
            if (!file_exists($cached_filename)) {
                safe_exec('echo "' . $message . '" | RHVoice-test' . $this->speechOptions() . ' -p ' . $voice . ' -o ' . $cached_filename, 1, $out);
            }
            if (file_exists($cached_filename)) {
                processSubscriptions('SAY_CACHED_READY', array(
                    'level' => $level,
                    'tts_engine' => 'rhvoice',
                    'message' => $message,
                    'filename' => $cached_filename,
                    'destination' => $destination,
                    'event' => $event,
                ));
            }
        }
    }

    /**
     * Install
     *
     * Module installation routine
     *
     * @access private
     */
    function install($data = '')
    {
        subscribeToEvent($this->name, 'SAY', '', 100);
        subscribeToEvent($this->name, 'SAYTO', '', 100);
        subscribeToEvent($this->name, 'ASK', '', 100);
        subscribeToEvent($this->name, 'SAYREPLY', '', 100);
        parent::install();
    }

    /**
     * Uninstall
     *
     * Module deinstallation routine
     *
     * @access private
     */
    function uninstall()
    {
        unsubscribeFromEvent($this->name, 'SAY');
        unsubscribeFromEvent($this->name, 'SAYTO');
        unsubscribeFromEvent($this->name, 'ASK');
        unsubscribeFromEvent($this->name, 'SAYREPLY');
        parent::uninstall();
    }

// --------------------------------------------------------------------
}

/*
*
* TW9kdWxlIGNyZWF0ZWQgTWFyIDE0LCAyMDE2IHVzaW5nIFNlcmdlIEouIHdpemFyZCAoQWN0aXZlVW5pdCBJbmMgd3d3LmFjdGl2ZXVuaXQuY29tKQ==
*
*/
