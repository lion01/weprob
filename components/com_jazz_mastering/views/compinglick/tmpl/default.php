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

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_jazz_mastering', JPATH_ADMINISTRATOR);
?>

<?php if( $this->item ) : ?>

    <div class="item_fields">
        
        <ul class="fields_list">

			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_COMPINGLICK_ID'); ?>:
			<?php echo $this->item->id; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_COMPINGLICK_CREATED_BY'); ?>:
			<?php echo $this->item->created_by; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_COMPINGLICK_TIME_CREATED'); ?>:
			<?php echo $this->item->time_created; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_COMPINGLICK_CADENCIA'); ?>:
			<?php echo $this->item->cadencia; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_COMPINGLICK_MODO'); ?>:
			<?php echo $this->item->modo; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_COMPINGLICK_NUM_DE_COMPASES'); ?>:
			<?php echo $this->item->num_de_compases; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_COMPINGLICK_IMAGE_ID'); ?>:
			<?php echo $this->item->image_id; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_COMPINGLICK_AUTOR'); ?>:
			<?php echo $this->item->autor; ?></li>


        </ul>
        
    </div>
    <?php if(JFactory::getUser()->authorise('core.edit', 'com_jazz_mastering.compinglick'.$this->item->id)): ?>
		<a href="<?php echo JRoute::_('index.php?option=com_jazz_mastering&task=compinglick.edit&id='.$this->item->id); ?>">Edit</a>
	<?php endif; ?>
<?php else: ?>
    Could not load the item
<?php endif; ?>
