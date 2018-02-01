<?php

	require 'config.php';
	
	dol_include_once('/contact/class/contact.class.php');
	dol_include_once('/rpgstats/class/rpgstats.class.php');
	
	$object = new Contact($db);
	$object->fetch(GETPOST('fk_contact'));
	
	$action = GETPOST('action');
	
	$rpg = new rpgstats($db);
	$rpg->fetchByContact($object->id);
	
	
	switch ($action) {
		case 'save':
			
			$rpg->setValues($_POST);
			if($rpg->id>0) $rpg->update($user);
			else $rpg->create($user);
			
			setEventMessage('Sauvegardé');
			
			_card($object,$rpg);
			break;
		default:
			_card($object,$rpg);
			break;
	}
	
	
	
function _card(&$object,&$rpg) {
	global $db,$conf,$langs;

	dol_include_once('/core/lib/contact.lib.php');
	
	llxHeader();
	$head = contact_prepare_head($object);
	dol_fiche_head($head, 'rpgstats', '', 0, '');
	
	$formCore=new TFormCore('rpgstats.php', 'formSimple');
	echo $formCore->hidden('fk_contact', $object->id);
	echo $formCore->hidden('action', 'save');
	
	echo '<h2>Ceci est une gestion de stats</h2>';
	
	echo $formCore->texte('Titre','title',$simple->title,80,255).'<br />';
	
	echo $formCore->btsubmit('Sauvegarder', 'bt_save');
	
	$formCore->end();
	
	dol_fiche_end();
	llxFooter();	  
		 	
}

