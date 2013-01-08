<?php
/**
 * @version     0.0.4
 * @package     com_jazz_mastering
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Artur Pañach Bargalló <arturictus@gmail.com> - http://
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of Jazz_mastering.
 */
class Jazz_masteringViewAleatorio extends JView
{
protected $ale_tonalidad;
protected $tonalidades;
function display($tpl = null) 
        {
        	$path='administrator/components/com_jazz_mastering/assets';
        	$document = JFactory::getDocument();
        	$document->addScript($path.'/js/jquery-ui-1.9.0/css/smoothness/jquery-ui-1.9.0.custom.css');
        	$document->addScript($path.'/js/jquery-ui-1.9.0/js/jquery-1.8.2.js');
        	$document->addScript($path.'/js/jquery-ui-1.9.0/js/jquery-ui-1.9.0.custom.js');
    		$document->addScript($path.'/js/jazz_mastering.js');
    		$document->addStyleDeclaration( $this->get('ale_style') );
                // Assign data to the view
             // $this->ale_style=$this->get('ale_style');
              $this->to_print=$this->get('to_print');
              $this->ex_title=$this->get('ex_title');
	         $this->temas=$this->get('temas');
	         $this->user = $this->get('user');
	         
         // Check for errors.
         if (count($errors = $this->get('Errors'))) 
                {
                        JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
                        return false;
                }
		
                // Display the view
                parent::display($tpl);
        }
    	
}
