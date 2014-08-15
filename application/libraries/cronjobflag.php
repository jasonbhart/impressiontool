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
        if (file_exists('/tmp/cronjobflag')) {
            return FALSE;
        } else {
            write_file('/tmp/cronjobflag', $cronjobName);
            return TRUE;
        }
    }
    
    function removeCronjobFlag()
    {
        if (file_exists('/tmp/cronjobflag')) {
            unlink('/tmp/cronjobflag');
        }
        return TRUE;
    }
}
