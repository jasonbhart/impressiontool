<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Cronjob extends CI_Controller {

	public function createReport() {
		$this->load->model('Userexport_model', '', TRUE);
		$jobs = $this->Userexport_model->getJobs();
		foreach ($jobs as $job) {
			$ipAddress = $job->ips;
			$ipAddressArray = explode(PHP_EOL, trim($ipAddress));
			if ($ipAddressArray[0] == "") {
				$ipAddressArray[] = $ipAddress;
			}
			$this->load->library('phpwhois');
			$phpwhois = new Phpwhois();
			$tempResultWhois = array();
			$this->load->model('Lookup_model', '', TRUE);
			$this->load->model('Blockname_model', '', TRUE);
			$this->load->model('Blockrange_model', '', TRUE);
			$this->load->model('Blockowner_model', '', TRUE);
			$cacheLookups = $this->Lookup_model->getLookupList($ipAddressArray);
			foreach ($ipAddressArray as $ip) {
				$ip = trim($ip);
				if ($phpwhois->whois->checkValidateIp($ip)) {
					if (!isset($cacheLookups[$ip])) {
						$rawWhois = $phpwhois->whois->Getipowner($ip);
						sleep(1);
						foreach ($rawWhois as $whois) {
							$tempResultWhois['ip'] = $ip;
							$tempResultWhois['ip_block_name'] = '';
							$tempResultWhois['ip_block_range'] = '';
							$tempResultWhois['ip_block_owner'] = '';
							if (isset($whois['regrinfo']['network']['name']))
								$tempResultWhois['ip_block_name'] = $whois['regrinfo']['network']['name'];
							if (isset($whois['regrinfo']['network']['inetnum']))
								$tempResultWhois['ip_block_range'] = $whois['regrinfo']['network']['inetnum'];
							if (isset($whois['regrinfo']['owner']['organization']))
								$tempResultWhois['ip_block_owner'] = $whois['regrinfo']['owner']['organization'];

							//check with three owner
							if (isset($whois['regrinfo']['network'][0]['name']))
								$tempResultWhois['ip_block_name'] = $whois['regrinfo']['network'][0]['name'];
							if (isset($whois['regrinfo']['network'][0]['inetnum']))
								$tempResultWhois['ip_block_range'] = $whois['regrinfo']['network'][0]['inetnum'];
							if (isset($whois['regrinfo']['owner'][0]))
								$tempResultWhois['ip_block_owner'] = $whois['regrinfo']['owner'][0]['organization'];
							//check black list or white list from owner, name, range
							$checkStatus = -1;
							$listOwner = $this->Blockowner_model->getAllList();
							$tempResultWhois['whois_status'] = $this->Blockowner_model->getStatus($tempResultWhois['ip_block_owner'], $listOwner);
							if ($tempResultWhois['whois_status'] != 0) { //owner is white
								if ($tempResultWhois['whois_status'] == 1) {
									$checkStatus = 1;
								}
								$tempResultWhois['whois_status'] = $this->Blockrange_model->getStatus($tempResultWhois['ip_block_range']);
								if ($tempResultWhois['whois_status'] != 0) { //owner is white
									if ($tempResultWhois['whois_status'] == 1) {
										$checkStatus = 1;
									}
									$listName = $this->Blockname_model->getAllList();
									$tempResultWhois['whois_status'] = $this->Blockname_model->getStatus($tempResultWhois['ip_block_name'], $listName);
									if ($tempResultWhois['whois_status'] == -1) {
										$tempResultWhois['whois_status'] = $checkStatus;
									}
								}
							}
							//insert lookup result
							$this->Lookup_model->insert_lookup($ip, $tempResultWhois['ip_block_name'], $tempResultWhois['ip_block_range'], $tempResultWhois['ip_block_owner']);
							$resultWhois[] = $tempResultWhois;
						}
					} else {
						foreach ($cacheLookups[$ip] as $lookup) {
							$tempResultWhois['ip'] = $lookup->ip;
							$tempResultWhois['ip_block_name'] = $lookup->ip_block_name;
							$tempResultWhois['ip_block_range'] = $lookup->ip_block_range;
							$tempResultWhois['ip_block_owner'] = $lookup->ip_block_owner;
							//check black list or white list from owner, name, range
							$checkStatus = -1;
							$listOwner = $this->Blockowner_model->getAllList();
							$tempResultWhois['whois_status'] = $this->Blockowner_model->getStatus($tempResultWhois['ip_block_owner'], $listOwner);
							if ($tempResultWhois['whois_status'] != 0) { //owner is white
								if ($tempResultWhois['whois_status'] == 1) {
									$checkStatus = 1;
								}
								$tempResultWhois['whois_status'] = $this->Blockrange_model->getStatus($tempResultWhois['ip_block_range']);
								if ($tempResultWhois['whois_status'] != 0) { //owner is white
									if ($tempResultWhois['whois_status'] == 1) {
										$checkStatus = 1;
									}
									$listName = $this->Blockname_model->getAllList();
									$tempResultWhois['whois_status'] = $this->Blockname_model->getStatus($tempResultWhois['ip_block_name'], $listName);
									if ($tempResultWhois['whois_status'] == -1) {
										$tempResultWhois['whois_status'] = $checkStatus;
									}
								}
							}
							$resultWhois[] = $tempResultWhois;
						}
					}
				}
			}
			//start create export file and send email
			$this->load->helper('file');
			$stringResultSQl = array();
			$count = 1;
			$fileName = md5($job->email) . '_report';
			//create csv file
			$fopen = fopen('public/exports/' . $fileName . '.csv', 'w+');
			foreach ($resultWhois as $result) {
				if ($result['whois_status'] == 0) {
					continue;
				}
				fputcsv($fopen, $result);
				$ipRange = explode('-', $result['ip_block_range']);
				$stringResultSQl[] = "($count,'" . mysql_real_escape_string($result['ip_block_owner'] . "|" . $result['ip_block_name']) . "', " . ip2long(trim($ipRange[0])) . ", " . ip2long(trim($ipRange[1])) . ", NULL, NULL, 1)";
				$count++;
			}
			fclose($fopen);
			//create sql file
			$stringResultSQl = implode(',', $stringResultSQl) . ';';
			$templateSQl = read_file('public/export_templates/sql.tpl');
			$templateSQl = str_replace("#result#", $stringResult, $templateSQl);
			write_file('public/exports/' . $fileName . '.sql', $templateSQl);
			
			$this->load->library('email');

			$this->email->from('ndtuan89@gmail.com');
			$this->email->to($job->email);

			$this->email->subject('The export file');
			$this->email->message('Testing the email class.');
			$this->email->attach('public/exports/' . $fileName);

			$this->email->send();
			$this->Userexport_model->updateJob($job->id, 1);
			echo 'run job id : ' . $job->id . '<br/>';
		}
	}

}
