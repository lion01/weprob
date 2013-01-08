<?php
/**
 * @version     0.0.4
 * @package     com_jazz_mastering
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Artur Pañach Bargalló <arturictus@gmail.com> - http://
 */


// no direct access
defined('_JEXEC') or die;
?>

<?php if($this->items) : ?>

    <div class="items">

        <ul class="items_list">

            <?php foreach ($this->items as $item) :?>

                
				<li><?php echo $item->value_tempo; ?></li>

            <?php endforeach; ?>

        </ul>

    </div>

     <div class="pagination">
        <p class="counter">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </p>
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
    <?php if(JFactory::getUser()->authorise('core.create', 'com_jazz_mastering.modo')): ?>
		<a href="<?php echo JRoute::_('index.php?option=com_jazz_mastering&task=modo.edit&id=0'); ?>">Add</a>
	<?php endif; ?>
<?php else: ?>
    
    There are no items in the list

<?php endif; ?>