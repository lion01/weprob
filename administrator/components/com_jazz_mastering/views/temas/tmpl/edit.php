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

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_jazz_mastering/assets/css/jazz_mastering.css');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'temas.cancel' || document.formvalidator.isValid(document.id('temas-form'))) {
			Joomla.submitform(task, document.getElementById('temas-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_jazz_mastering&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="temas-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_JAZZ_MASTERING_LEGEND_TEMAS'); ?></legend>
			<ul class="adminformlist">
                
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
		</fieldset>
	</div>


	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
	<div class="clr"></div>

    <style type="text/css">
        /* Temporary fix for drifting editor fields */
        .adminformlist li {
            clear: both;
        }
    </style>
</form>