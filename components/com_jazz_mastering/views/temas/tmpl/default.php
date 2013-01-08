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

			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_TEMAS_ID'); ?>:
			<?php echo $this->item->id; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_TEMAS_TITULO'); ?>:
			<?php echo $this->item->titulo; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_TEMAS_COMPOSITOR'); ?>:
			<?php echo $this->item->compositor; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_TEMAS_TEMPO'); ?>:
			<?php echo $this->item->tempo; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_TEMAS_ESTILO'); ?>:
			<?php echo $this->item->estilo; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_TEMAS_TONALIDAD'); ?>:
			<?php echo $this->item->tonalidad; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_TEMAS_MODO'); ?>:
			<?php echo $this->item->modo; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_TEMAS_CHORDS'); ?>:
			<?php echo $this->item->chords; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_TEMAS_COMPASES'); ?>:
			<?php echo $this->item->compases; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_TEMAS_USER'); ?>:
			<?php echo $this->item->user; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_TEMAS_FECHA_DE_CREACION'); ?>:
			<?php echo $this->item->fecha_de_creacion; ?></li>
			<li><?php echo JText::_('COM_JAZZ_MASTERING_FORM_LBL_TEMAS_CREATED_BY'); ?>:
			<?php echo $this->item->created_by; ?></li>


        </ul>
        
    </div>
    <?php if(JFactory::getUser()->authorise('core.edit', 'com_jazz_mastering.temas'.$this->item->id)): ?>
		<a href="<?php echo JRoute::_('index.php?option=com_jazz_mastering&task=temas.edit&id='.$this->item->id); ?>">Edit</a>
	<?php endif; ?>
<?php else: ?>
    Could not load the item
<?php endif; ?>
