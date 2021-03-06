<?php
/*
    PufferPanel - A Minecraft Server Management Panel
    Copyright (c) 2013 Dane Everitt
 
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
 
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
 
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see http://www.gnu.org/licenses/.
 */
session_start();
require_once('../../../core/framework/framework.core.php');

	if($core->framework->auth->isLoggedIn($_SERVER['REMOTE_ADDR'], $core->framework->auth->getCookie('pp_auth_token'), $core->framework->auth->getCookie('pp_server_hash')) === true){
	
	if(!isset($_POST['jarfile']) || empty($_POST['jarfile']))
		$core->framework->page->redirect('../../settings.php');
	
	if(!preg_match('/^([\w\d_.-]+)$/', $_POST['jarfile']))
		$core->framework->page->redirect('../../settings.php');
		
	/*
	 * Update It
	 */
	$update = $mysql->prepare("UPDATE `servers` SET `server_jar` = :jar WHERE `id` = :sid");
	$update->execute(array(
		':jar' => $_POST['jarfile'],
		':sid' => $core->framework->server->getData('id')
	));
	$core->framework->page->redirect('../../settings.php');

}