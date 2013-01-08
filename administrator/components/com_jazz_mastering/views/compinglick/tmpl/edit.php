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
		if (task == 'compinglick.cancel' || document.formvalidator.isValid(document.id('compinglick-form'))) {
			Joomla.submitform(task, document.getElementById('compinglick-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_jazz_mastering&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="compinglick-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_JAZZ_MASTERING_LEGEND_COMPINGLICK'); ?></legend>
			<ul class="adminformlist">
                
				<li><?php echo $this->form->getLabel('created_by'); ?>
				<?php echo $this->form->getInput('created_by'); ?></li>
				<li><?php echo $this->form->getLabel('cadencia'); ?>
				<?php echo $this->form->getInput('cadencia'); ?></li>
				<li><?php echo $this->form->getLabel('modo'); ?>
				<?php echo $this->form->getInput('modo'); ?></li>
				<li><?php echo $this->form->getLabel('num_de_compases'); ?>
				<?php echo $this->form->getInput('num_de_compases'); ?></li>
				<li><?php echo $this->form->getLabel('image_id'); ?>
				<?php echo $this->form->getInput('image_id'); ?></li>
				<li><?php echo $this->form->getLabel('autor'); ?>
				<?php echo $this->form->getInput('autor'); ?></li>


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