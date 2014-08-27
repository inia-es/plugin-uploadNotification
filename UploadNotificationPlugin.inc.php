<?php

/**
 * @file WebFeedPlugin.inc.php
 *
 * Copyright (c) 2003-2011 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class WebFeedPlugin
 * @ingroup plugins_block_webFeed
 *
 * @brief Web Feeds plugin class
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
	 * Register as a block plugin, even though this is a generic plugin.
	 * This will allow the plugin to behave as a block plugin, i.e. to
	 * have layout tasks performed on it.
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
