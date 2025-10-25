<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: admincp_cloudaddons.php 36311 2016-12-19 01:47:34Z nemohou $
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

require_once libfile('function/cloudaddons');

cpheader();

if(!$admincp->isfounder) {
	cpmsg('noaccess_isfounder', '', 'error');
}

if(!$operation || in_array($operation, array('plugins', 'templates'))) {
	// 已禁用云端应用中心功能
	cpmsg('云端应用中心已被禁用，请通过上传方式安装插件和模板。', '', 'error');
} elseif($operation == 'download') {
	// 已禁用云端下载功能
	cpmsg('云端下载功能已被禁用，请使用本地上传方式安装。', '', 'error');
}

function dir_clear($dir) {
	if($directory = @dir($dir)) {
		while($entry = $directory->read()) {
			if($entry == '.' || $entry == '..') {
				continue;
			}
			$filename = $dir.'/'.$entry;
			if(is_file($filename)) {
				@unlink($filename);
			} else {
				dir_clear($filename);
			}
		}
		$directory->close();
		@rmdir($dir);
	}
}

?>