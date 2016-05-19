<?php

/**
 * @file UploadNotificationPlugin.inc.php
 *
 * Copyright (c) 2003-2016 Instituto Nacional de Investigación y Tecnología
 *               Agraria y Alimentaria
 * Distributed under the GNU GPL v3. For full terms see the file LICENSE.
 *
 * @class UploadNotificationPlugin
 * @ingroup plugins_generic_uploadNotification
 *
 * @brief Upload Notifications plugin class
 */

// $Id$


import('classes.plugins.GenericPlugin');

class UploadNotificationPlugin extends GenericPlugin {
	/**
	 * Get the  name of this plugin
	 * @return string
	 */
	function getName() {
		return 'UploadNotificationPlugin';
	}
	/**
	 * Get the display name of this plugin
	 * @return string
	 */
	function getDisplayName() {
		return 'UploadNotification Plugin';
	}

	/**
	 * Get the description of this plugin
	 * @return string
	 */
	function getDescription() {
		return 'This plugin send email to editor when Author upload new revision ';
	}

	function register($category, $path) {
		if (parent::register($category, $path)) {
			Registry::set( 'UploadNotificationPlugin', $this );
		
				HookRegistry::register('AuthorAction::uploadRevisedVersion',array(&$this, 'notification'));
				
			return true;
		}
		return false;
	}

	

	/**
	 * Callback function run when an author upload a new version of an
	 * article. It sends a notification email to the author and to the 
	 * journal manager.
	 * @param $hookName string
	 * @param $args array
	 */
	function notification($hookName, $args) {
		
        $submission = & $args[0];
        $articleTitle = $submission->getArticleTitle();
        $articleId =  $submission->getArticleId();

	  import('classes.mail.ArticleMailTemplate');

		$email = new ArticleMailTemplate($submission,'UPLOAD_NOTIFICATION');
		$user =& Request::getUser();
		$email->setFrom($user->getEmail(), $user->getFullName());
			 
                $email->addRecipient($user->getEmail(), $user->getFullName());
 //              $email->ccAssignedEditors($articleId);
                 $email->toAssignedEditingSectionEditors($articleId);
               $paramArray = array(
//			'articleId' => $articleId,
				'articleTitle' => $articleTitle
				);

			$email->sendWithParams($paramArray);
                
 		if ( !$email->hasErrors()) {
		
		}
//			exit("exit hook");

		return false;
	 }	

}
?>
