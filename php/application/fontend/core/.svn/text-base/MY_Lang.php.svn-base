<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// CodeIgniter i18n library by Jérôme Jaglale
// http://maestric.com/en/doc/php/codeigniter_i18n
// version 10 - May 10, 2012

class MY_Lang extends CI_Lang {
    /*     * ************************************************
      configuration
     * ************************************************* */

    // languages
    var $languages = array();
    var $languages_id = array();
    // special URIs (not localized)
    var $special = array(
        ""
    );
    // where to redirect if no language in URI
    var $default_uri = '';

    /*     * *********************************************** */

    function __construct() {
        parent::__construct();

        global $CFG;
        global $URI;
        global $RTR;

        $lang_file = APPPATH . 'language/languages.xml';
        if (file_exists($lang_file)) {
            $xmlRaw = file_get_contents($lang_file);
            $languages = xmlstr_to_array($xmlRaw);
            $langs = $this->struct_language($languages);
            $this->languages = $langs[0];
            $this->languages_id = $langs[1];
        } else {
            die('Language errors!');
        }

        $segment = $URI->segment(1);
        if (isset($this->languages[$segment])) { // URI with language -> ok
            $language = $this->languages[$segment];
            $CFG->set_item('language', $language);
        } else if ($this->is_special($segment)) { // special URI -> no redirect
            $CFG->set_item('language', $this->languages[$this->default_lang()]);
            return;
        } else { // URI without language -> redirect to default_uri
            // set default language            
            $CFG->set_item('language', $this->languages[$this->default_lang()]);
            // redirect
            header("Location: " . $CFG->site_url($this->localized($this->default_uri)), TRUE, 302);
            exit;
        }
    }

    // get current language
    // ex: return 'en' if language in CI config is 'english' 
    function lang() {
        global $CFG;
        $language = $CFG->item('language');
        $lang = array_search($language, $this->languages);
        if ($lang) {
            return $lang;
        }

        return NULL; // this should not happen
    }

    // get current language id
    function lang_id() {
        global $CFG;
        $language = $this->lang();
        if (isset($this->languages_id[$language]) && is_numeric($this->languages_id[$language])) {
            return $this->languages_id[$language];
        }
        return NULL; // this should not happen
    }

    /**
     * Load a language file
     *
     * @access	public
     * @param	mixed	the name of the language file to be loaded. Can be an array
     * @param	string	the language (english, etc.)
     * @param	bool	return loaded array of translations
     * @param 	bool	add suffix to $langfile
     * @param 	string	alternative path to look for language file
     * @return	mixed
     */
    function load($langfile = '', $idiom = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '') {
        $langfile = str_replace('.php', '', $langfile);

        if ($add_suffix == TRUE) {
            $langfile = str_replace('_lang.', '', $langfile) . '_lang';
        }

        $langfile .= '.php';

        if (in_array($langfile, $this->is_loaded, TRUE)) {
            return;
        }

        $config = & get_config();

        if ($idiom == '') {
            $deft_lang = (!isset($config['language'])) ? 'english' : $config['language'];
            $idiom = ($deft_lang == '') ? 'english' : $deft_lang;
        }

        // Determine where the language file is and load it
        if ($alt_path != '' && file_exists($alt_path . 'language/' . $idiom . '/' . $langfile)) {
            include($alt_path . 'language/' . $idiom . '/' . $langfile);
        } else {
            $found = FALSE;

            foreach (get_instance()->load->get_package_paths(TRUE) as $package_path) {
                if (file_exists($package_path . 'language/' . $idiom . '/' . $langfile)) {
                    include($package_path . 'language/' . $idiom . '/' . $langfile);
                    $found = TRUE;
                    break;
                }
            }

            if ($found !== TRUE) {
                show_404('page');
                //show_error('Unable to load the requested language file: language/' . $idiom . '/' . $langfile);
            }
        }


        if (!isset($lang)) {
            log_message('error', 'Language file contains no data: language/' . $idiom . '/' . $langfile);
            return;
        }

        if ($return == TRUE) {
            return $lang;
        }

        $this->is_loaded[] = $langfile;
        $this->language = array_merge($this->language, $lang);
        unset($lang);
        log_message('debug', 'Language file loaded: language/' . $idiom . '/' . $langfile);
        return TRUE;
    }

    function is_special($uri) {
        $exploded = explode('/', $uri);
        if (in_array($exploded[0], $this->special)) {
            return TRUE;
        }
        if (isset($this->languages[$uri])) {
            return TRUE;
        }
        return FALSE;
    }

    function switch_uri($lang) {
        $CI = & get_instance();

        $uri = $CI->uri->uri_string();
        if ($uri != "") {
            $exploded = explode('/', $uri);
            if ($exploded[0] == $this->lang()) {
                $exploded[0] = $lang;
            }
            $uri = implode('/', $exploded);
        }
        return $uri;
    }

    // is there a language segment in this $uri?
    function has_language($uri) {
        $first_segment = NULL;

        $exploded = explode('/', $uri);
        if (isset($exploded[0])) {
            if ($exploded[0] != '') {
                $first_segment = $exploded[0];
            } else if (isset($exploded[1]) && $exploded[1] != '') {
                $first_segment = $exploded[1];
            }
        }

        if ($first_segment != NULL) {
            return isset($this->languages[$first_segment]);
        }

        return FALSE;
    }

    // default language: first element of $this->languages
    function default_lang() {
        foreach ($this->languages as $lang => $language) {
            return $lang;
        }
    }

    // add language segment to $uri (if appropriate)
    function localized($uri) {
        if ($this->has_language($uri)
                || $this->is_special($uri)
                || preg_match('/(.+)\.[a-zA-Z0-9]{2,4}$/', $uri)) {
            // we don't need a language segment because:
            // - there's already one or
            // - it's a special uri (set in $special) or
            // - that's a link to a file
        } else {
            $uri = $this->lang() . '/' . $uri;
        }

        return $uri;
    }

    function struct_language($languages_from_xml) {
        $languages = array();
        $languages_id = array();
        foreach ($languages_from_xml['item'] as $lang) {
            if ($lang['default']) {
                $languages[$lang['code']] = $lang['folder'];
                $languages_id[$lang['code']] = $lang['language_id'];
                break;
            }
        }
        foreach ($languages_from_xml['item'] as $lang) {
            if (isset($lang['default']) && !$lang['default']) {
                $languages[$lang['code']] = $lang['folder'];
                $languages_id[$lang['code']] = $lang['language_id'];
            }
        }
        return array($languages, $languages_id);
    }

}

/**
 * convert xml string to php array - useful to get a serializable value
 *
 * @param string $xmlstr
 * @return array
 * @author Adrien aka Gaarf
 */
function xmlstr_to_array($xmlstr) {
    $doc = new DOMDocument();
    $doc->loadXML($xmlstr);
    return domnode_to_array($doc->documentElement);
}

function domnode_to_array($node) {
    $output = array();
    switch ($node->nodeType) {
        case XML_CDATA_SECTION_NODE:
        case XML_TEXT_NODE:
            $output = trim($node->textContent);
            break;
        case XML_ELEMENT_NODE:
            for ($i = 0, $m = $node->childNodes->length; $i < $m; $i++) {
                $child = $node->childNodes->item($i);
                $v = domnode_to_array($child);
                if (isset($child->tagName)) {
                    $t = $child->tagName;
                    if (!isset($output[$t])) {
                        $output[$t] = array();
                    }
                    $output[$t][] = $v;
                } elseif ($v) {
                    $output = (string) $v;
                }
            }
            if (is_array($output)) {
                if ($node->attributes->length) {
                    $a = array();
                    foreach ($node->attributes as $attrName => $attrNode) {
                        $a[$attrName] = (string) $attrNode->value;
                    }
                    $output['@attributes'] = $a;
                }
                foreach ($output as $t => $v) {
                    if (is_array($v) && count($v) == 1 && $t != '@attributes') {
                        $output[$t] = $v[0];
                    }
                }
            }
            break;
    }
    return $output;
}

/* End of file */
