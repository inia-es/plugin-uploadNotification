{**
 * plugins/generic/uploadNotification/settingsForm.tpl
 *
 * Copyright (c) 2003-2016 Instituto Nacional de Investigación y Tecnología
 *               Agraria y Alimentaria
 * Distributed under the GNU GPL v3. For full terms see the file LICENSE.
 *
 * Upload Notifications plugin settings
 *
 *}
{strip}
{assign var="pageTitle" value="plugins.generic.uploadNotifications.displayName"}
{include file="common/header.tpl"}
{/strip}
<div id="uploadNotificationSettings">
<div id="description">{translate key="plugins.generic.uploadNotifications.description"}</div>

<div class="separator">&nbsp;</div>

<h3>{translate key="plugins.generic.uploadNotifications.settings"}</h3>

<form method="post" action="{plugin_url path="settings"}">
{include file="common/formErrors.tpl"}

<label for="notifyAuthor-yes">
	{translate key="plugins.generic.uploadNotifications.settings.notifyAuthor"}
</label>
<input type="radio" name="notifyAuthor" id="notifyAuthor-yes" value="true" {if $notifyAuthor}checked="checked" {/if}/>

<label for="notifyAuthor-no">
	{translate key="plugins.generic.uploadNotifications.settings.dontNotifyAuthor"}
</label>
<input type="radio" name="notifyAuthor" id="notifyAuthor-no" value="false" {if not $notifyAuthor}checked="checked" {/if}/>

<div class="separator"></div>

<label for="notifyJournalContact-yes">
	{translate key="plugins.generic.uploadNotifications.settings.notifyJournalContact"}
</label>
<input type="radio" name="notifyJournalContact" id="notifyJournalContact-yes" value="true" {if $notifyJournalContact}checked="checked" {/if}/>

<label for="notifyJournalContact-no">
	{translate key="plugins.generic.uploadNotifications.settings.dontNotifyJournalContact"}
</label>
<input type="radio" name="notifyJournalContact" id="norifyJournalContact-no" value="false" {if not $notifyJournalContact}checked="checked" {/if}/>

<br/>

<input type="submit" name="save" class="button defaultButton" value="{translate key="common.save"}"/> <input type="button" class="button" value="{translate key="common.cancel"}" onclick="history.go(-1)"/>
</form>

<p><span class="formRequired">{translate key="common.requiredField"}</span></p>
</div>
{include file="common/footer.tpl"}
