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
 * Licktype controller class.
 */
class Jazz_masteringControllerLicktype extends JControllerForm
{

    function __construct() {
        $this->view_list = 'licktypes';
        parent::__construct();
    }

}