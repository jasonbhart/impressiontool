<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class CronjobFlag 
{
    public function __construct()
    {
        $CI =& get_instance();
        $CI->load->helper('file');
    }
    
    function checkCronjobFlag($cronjobName)
    {
        if (file_exists('application/controllers/cronjobs/cronjobflag')) {
            return FALSE;
        } else {
            write_file('application/controllers/cronjobs/cronjobflag', $cronjobName);
            return TRUE;
        }
    }
    
    function removeCronjobFlag()
    {
        if (file_exists('application/controllers/cronjobs/cronjobflag')) {
            unlink('application/controllers/cronjobs/cronjobflag');
        }
        return TRUE;
    }
}
