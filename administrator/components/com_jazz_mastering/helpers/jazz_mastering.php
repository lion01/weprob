<?php
/**
 * @version     0.0.6
 * @package     com_jazz_mastering
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Artur Pañach Bargalló <arturictus@gmail.com> - http://
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Jazz_mastering helper.
 */
class Jazz_masteringHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_JAZZ_MASTERING_TITLE_TEMASS'),
			'index.php?option=com_jazz_mastering&view=temass',
			$vName == 'temass'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_JAZZ_MASTERING_TITLE_LICKS'),
			'index.php?option=com_jazz_mastering&view=licks',
			$vName == 'licks'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_JAZZ_MASTERING_TITLE_COMPINGLICKS'),
			'index.php?option=com_jazz_mastering&view=compinglicks',
			$vName == 'compinglicks'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_JAZZ_MASTERING_TITLE_MODOS'),
			'index.php?option=com_jazz_mastering&view=modos',
			$vName == 'modos'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_JAZZ_MASTERING_TITLE_CADENCIAS'),
			'index.php?option=com_jazz_mastering&view=cadencias',
			$vName == 'cadencias'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_JAZZ_MASTERING_TITLE_TEMPOS'),
			'index.php?option=com_jazz_mastering&view=tempos',
			$vName == 'tempos'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_JAZZ_MASTERING_TITLE_ESTILOS'),
			'index.php?option=com_jazz_mastering&view=estilos',
			$vName == 'estilos'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_JAZZ_MASTERING_TITLE_NUMDECOMPASESLICKS'),
			'index.php?option=com_jazz_mastering&view=numdecompaseslicks',
			$vName == 'numdecompaseslicks'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_JAZZ_MASTERING_TITLE_TONALIDADES'),
			'index.php?option=com_jazz_mastering&view=tonalidades',
			$vName == 'tonalidades'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_JAZZ_MASTERING_TITLE_IMGLICKS'),
			'index.php?option=com_jazz_mastering&view=imglicks',
			$vName == 'imglicks'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_JAZZ_MASTERING_TITLE_LICKAUTORS'),
			'index.php?option=com_jazz_mastering&view=lickautors',
			$vName == 'lickautors'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_JAZZ_MASTERING_TITLE_LICKTYPES'),
			'index.php?option=com_jazz_mastering&view=licktypes',
			$vName == 'licktypes'
		);

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_jazz_mastering';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}
