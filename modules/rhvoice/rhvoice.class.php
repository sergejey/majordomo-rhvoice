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
class rhvoice extends module {

    /**
     * rhvoice
     *
     * Module class constructor
     *
     * @access private
     */
    function rhvoice() {
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
    function saveParams($data = 0) {
        $p = array();
        if (IsSet($this->id)) {
            $p["id"] = $this->id;
        }
        if (IsSet($this->view_mode)) {
            $p["view_mode"] = $this->view_mode;
        }
        if (IsSet($this->edit_mode)) {
            $p["edit_mode"] = $this->edit_mode;
        }
        if (IsSet($this->tab)) {
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
    function getParams() {
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
    function run() {
        global $session;
        $out = array();
        if ($this->action == 'admin') {
            $this->admin($out);
        } else {
            $this->usual($out);
        }
        if (IsSet($this->owner->action)) {
            $out['PARENT_ACTION'] = $this->owner->action;
        }
        if (IsSet($this->owner->name)) {
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
    function admin(&$out) {
        $this->getConfig();
        $out['VOICE']=$this->config['VOICE'];
        $out['USE_SPD']=$this->config['USE_SPD'];
        $out['USE_CACHE']=$this->config['USE_CACHE'];
        if (!$out['VOICE']) {
            $out['VOICE'] = 'Anna+CLB';
        }
        if ($this->view_mode == 'update_settings') {
            global $voice;
            $this->config['VOICE']=$voice;
            global $use_spd;
            $this->config['USE_SPD']=$use_spd;
            global $use_cache;
            $this->config['USE_CACHE']=$use_cache;

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
    function usual(&$out) {
        $this->admin($out);
    }

    function processSubscription($event, &$details) {
        $this->getConfig();
        if ($event == 'SAY' && !$details['ignoreVoice']) {
            $level = $details['level'];
            $message = $details['message'];
            if ($level >= (int) getGlobal('minMsgLevel') && !IsWindowsOS()) {
                $out = '';
                $voice=$this->config['VOICE'];
                $use_spd = $this->config['USE_SPD'];
                $use_cache = $this->config['USE_CACHE'];
                if ($use_spd) {
                    safe_exec('spd-say "'.$message.'" -w -y ' . $voice, 1, $out);
                } else {
                 if ($use_cache) {
                     if (is_dir(ROOT . 'cms/cached')) {
                         $cached_filename = ROOT . 'cms/cached/voice/rh_' . md5($message) . '.wav';
                     } else {
                         $cached_filename = ROOT . 'cached/voice/rh_' . md5($message) . '.wav';
                     }

                   if (!file_exists($cached_filename)) {
                    safe_exec('echo "' . $message . '" | RHVoice-test -p ' . $voice . ' -o '.$cached_filename . ' && mplayer '.$cached_filename, 1, $out);
                   } else {
                    playSound($cached_filename,1);
                   }
                 } else {
                    safe_exec('echo "' . $message . '" | RHVoice-test -p ' . $voice, 1, $out);
                 }
                }
                $details['ignoreVoice'] = 1;
            }
            //...
        }
    }

    /**
     * Install
     *
     * Module installation routine
     *
     * @access private
     */
    function install($data = '') {
        subscribeToEvent($this->name, 'SAY');
        parent::install();
    }
    
    /**
     * Uninstall
     *
     * Module deinstallation routine
     *
     * @access private
     */    
    function uninstall() {
        unsubscribeFromEvent($this->name, 'SAY');
        parent::uninstall();
    }

// --------------------------------------------------------------------
}

/*
*
* TW9kdWxlIGNyZWF0ZWQgTWFyIDE0LCAyMDE2IHVzaW5nIFNlcmdlIEouIHdpemFyZCAoQWN0aXZlVW5pdCBJbmMgd3d3LmFjdGl2ZXVuaXQuY29tKQ==
*
*/
