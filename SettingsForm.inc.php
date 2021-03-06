<?php

/**
 * @file plugins/generic/uploadNotification/SettingsForm.inc.php
 *
 * Copyright (c) 2003-2016 Instituto Nacional de Investigación y Tecnología
 *               Agraria y Alimentaria
 * Distributed under the GNU GPL v3. For full terms see the file LICENSE.
 *
 * @class SettingsForm
 * @ingroup plugins_generic_uploadNotification
 *
 * @brief Form for journal managers to modify upload notification plugin settings
 */

import('lib.pkp.classes.form.Form');

class SettingsForm extends Form {

	/** @var $journalId int */
	var $journalId;

	/** @var $plugin object */
	var $plugin;

	/**
	 * Constructor
	 * @param $plugin object
	 * @param $journalId int
	 */
	function SettingsForm(&$plugin, $journalId) {
		$this->journalId = $journalId;
		$this->plugin =& $plugin;

		parent::Form($plugin->getTemplatePath() . 'settingsForm.tpl');
		$this->addCheck(new FormValidatorPost($this));
	}

	/**
	 * Initialize form data.
	 */
	function initData() {
		$journalId = $this->journalId;
		$plugin =& $this->plugin;

		$this->setData('notifyAuthor', $plugin->getSetting($journalId, 'notifyAuthor'));
		$this->setData('notifyJournalContact', $plugin->getSetting($journalId, 'notifyJournalContact'));
	}

	/**
	 * Assign form data to user-submitted data.
	 */
	function readInputData() {
		$this->readUserVars(array('notifyAuthor','notifyJournalContact'));
	}

	/**
	 * Save settings. 
	 */
	function execute() {
		$plugin =& $this->plugin;
		$journalId = $this->journalId;

		$plugin->updateSetting($journalId, 'notifyAuthor', $this->getData('notifyAuthor'));
		$plugin->updateSetting($journalId, 'notifyJournalContact', $this->getData('notifyJournalContact'));
	}

}

?>
