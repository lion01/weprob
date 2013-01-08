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
<h1><?php echo $this->ex_title;?></h1>

<?php $contador=count($this->to_print)-1;
	//$this->ale_style;
	echo '<table><tr>';
	for($i=0;$i<=$contador;$i++)
	{
		echo '
		<td>
		<div id="elemento">
		<div class="titulo"><p>'.$this->to_print[$i]['titulo'].'</p></div>
		<div class="objeto"><p>'.$this->to_print[$i]['obj'].'</p></div>
		</div>
		</td>';
		if (($i+1)%3==0 && $i!=$contador && $i!= 0)
		echo '</tr><tr>';
		/* if ($i%3==0 && $i==$contador)
		echo '</tr>'; */
		}?>
		</tr></table>
	<!--  	<table><tr><td></td></tr></table>-->
		