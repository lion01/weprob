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
		if (task == 'estilo.cancel' || document.formvalidator.isValid(document.id('estilo-form'))) {
			Joomla.submitform(task, document.getElementById('estilo-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_jazz_mastering&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="estilo-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_JAZZ_MASTERING_LEGEND_ESTILO'); ?></legend>
			<ul class="adminformlist">
                
				<li><?php echo $this->form->getLabel('value_estilo'); ?>
				<?php echo $this->form->getInput('value_estilo'); ?></li>
				<li><?php echo $this->form->getLabel('value_estilo_creado_por'); ?>
				<?php echo $this->form->getInput('value_estilo_creado_por'); ?></li>


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