<?php
/**
 * @version     0.0.6
 * @package     com_jazz_mastering
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Artur Pañach Bargalló <arturictus@gmail.com> - http://
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_jazz_mastering', JPATH_ADMINISTRATOR);


?>

<!-- Styling for making front end forms look OK -->
<!-- This should probably be moved to the template CSS file -->
<style>
    .front-end-edit ul {
        padding: 0 !important;
    }
    .front-end-edit li {
        list-style: none;
        margin-bottom: 6px !important;
    }
    .front-end-edit label {
        margin-right: 10px;
        display: block;
        float: left;
        width: 200px !important;
    }
    .front-end-edit .radio label {
        display: inline;
        float: none;
    }
    .front-end-edit .readonly {
        border: none !important;
        color: #666;
    }    
    .front-end-edit #editor-xtd-buttons {
        height: 50px;
        width: 600px;
        float: left;
    }
    .front-end-edit .toggle-editor {
        height: 50px;
        width: 120px;
        float: right;
        
    }
</style>

<div class="temas-edit front-end-edit">
    <h1>Edit <?php echo $this->item->id; ?></h1>

    <form id="form-temas" action="<?php echo JRoute::_('index.php?option=com_jazz_mastering&task=temas.save'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
        <ul>
				<li><?php echo $this->form->getLabel('titulo'); ?>
				<?php echo $this->form->getInput('titulo'); ?></li>
				<li><?php echo $this->form->getLabel('compositor'); ?>
				<?php echo $this->form->getInput('compositor'); ?></li>
				<li><?php echo $this->form->getLabel('tempo'); ?>
				<?php echo $this->form->getInput('tempo'); ?></li>
				<li><?php echo $this->form->getLabel('estilo'); ?>
				<?php echo $this->form->getInput('estilo'); ?></li>
				<li><?php echo $this->form->getLabel('tonalidad'); ?>
				<?php echo $this->form->getInput('tonalidad'); ?></li>
				<li><?php echo $this->form->getLabel('modo'); ?>
				<?php echo $this->form->getInput('modo'); ?></li>
				<li><?php echo $this->form->getLabel('chords'); ?>
				<?php echo $this->form->getInput('chords'); ?></li>
				<li><?php echo $this->form->getLabel('compases'); ?>
				<?php echo $this->form->getInput('compases'); ?></li>
				<li><?php echo $this->form->getLabel('user'); ?>
				<?php echo $this->form->getInput('user'); ?></li>
				<li><?php echo $this->form->getLabel('created_by'); ?>
				<?php echo $this->form->getInput('created_by'); ?></li>

        </ul>
		<div>
			<button type="submit" class="validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>
			<?php echo JText::_('or'); ?>
			<a href="<?php echo JRoute::_('index.php?option=com_jazz_mastering&task=temas.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>

			<input type="hidden" name="option" value="com_jazz_mastering" />
			<input type="hidden" name="task" value="temas.save" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
