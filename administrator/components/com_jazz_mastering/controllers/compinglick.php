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

jimport('joomla.application.component.controllerform');

/**
 * Compinglick controller class.
 */
class Jazz_masteringControllerCompinglick extends JControllerForm
{

    function __construct() {
        $this->view_list = 'compinglicks';
        parent::__construct();
    }

}