<?php

/**
 * @version     0.0.6
 * @package     com_jazz_mastering
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Artur Pañach Bargalló <arturictus@gmail.com> - http://
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Jazz_mastering records.
 */
class Jazz_masteringModelCompinglicks extends JModelList {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since	1.6
     */
    protected function populateState($ordering = null, $direction = null) {
        
        // Initialise variables.
        $app = JFactory::getApplication();

        // List state information
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit', $limit);

        $limitstart = JFactory::getApplication()->input->getInt('limitstart', 0);
        $this->setState('list.start', $limitstart);
        
        
        
        // List state information.
        parent::populateState($ordering, $direction);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
                $this->getState(
                        'list.select', 'a.*'
                )
        );
        
        $query->from('`#__jazz_mastering_comping_lick` AS a');
        

		// Join over the created by field 'created_by'
		$query->select('created_by.name AS created_by');
		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');
		// Join over the foreign key 'cadencia'
		$query->select('#__jazz_mastering_cadencia_303182.cadencia AS cadencias_cadencia_303182');
		$query->join('LEFT', '#__jazz_mastering_cadencia AS #__jazz_mastering_cadencia_303182 ON #__jazz_mastering_cadencia_303182.id = a.cadencia');
		// Join over the foreign key 'modo'
		$query->select('#__jazz_mastering_modo_303184.modo AS modos_modo_303184');
		$query->join('LEFT', '#__jazz_mastering_modo AS #__jazz_mastering_modo_303184 ON #__jazz_mastering_modo_303184.id = a.modo');
		// Join over the foreign key 'num_de_compases'
		$query->select('#__jazz_mastering_value_num_de_compases_lick_303188.num_de_compases AS numdecompaseslicks_num_de_compases_303188');
		$query->join('LEFT', '#__jazz_mastering_value_num_de_compases_lick AS #__jazz_mastering_value_num_de_compases_lick_303188 ON #__jazz_mastering_value_num_de_compases_lick_303188.id = a.num_de_compases');
		// Join over the foreign key 'image_id'
		$query->select('#__jazz_mastering_img_lick_303189.img_name AS imglicks_img_name_303189');
		$query->join('LEFT', '#__jazz_mastering_img_lick AS #__jazz_mastering_img_lick_303189 ON #__jazz_mastering_img_lick_303189.id = a.image_id');
		// Join over the foreign key 'autor'
		$query->select('#__jazz_mastering_lick_autor_303190.autorname AS lickautors_autorname_303190');
		$query->join('LEFT', '#__jazz_mastering_lick_autor AS #__jazz_mastering_lick_autor_303190 ON #__jazz_mastering_lick_autor_303190.id = a.autor');


		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
                
			}
		}
        


		//Filtering cadencia
		$filter_cadencia = $this->state->get("filter.cadencia");
		if ($filter_cadencia) {
			$query->where("a.cadencia = '".$filter_cadencia."'");
		}

		//Filtering modo
		$filter_modo = $this->state->get("filter.modo");
		if ($filter_modo) {
			$query->where("a.modo = '".$filter_modo."'");
		}

		//Filtering num_de_compases
		$filter_num_de_compases = $this->state->get("filter.num_de_compases");
		if ($filter_num_de_compases) {
			$query->where("a.num_de_compases = '".$filter_num_de_compases."'");
		}        
        
        return $query;
    }

}
