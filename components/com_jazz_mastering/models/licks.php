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
class Jazz_masteringModelLicks extends JModelList {

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
        
        $query->from('`#__jazz_mastering_lick` AS a');
        

		// Join over the created by field 'user'
		$query->select('user.name AS user');
		$query->join('LEFT', '#__users AS user ON user.id = a.user');
		// Join over the foreign key 'cadencia'
		$query->select('#__jazz_mastering_cadencia_303173.cadencia AS cadencias_cadencia_303173');
		$query->join('LEFT', '#__jazz_mastering_cadencia AS #__jazz_mastering_cadencia_303173 ON #__jazz_mastering_cadencia_303173.id = a.cadencia');
		// Join over the foreign key 'modo'
		$query->select('#__jazz_mastering_modo_303174.modo AS modos_modo_303174');
		$query->join('LEFT', '#__jazz_mastering_modo AS #__jazz_mastering_modo_303174 ON #__jazz_mastering_modo_303174.id = a.modo');
		// Join over the foreign key 'num_de_compases'
		$query->select('#__jazz_mastering_value_num_de_compases_lick_303175.num_de_compases AS numdecompaseslicks_num_de_compases_303175');
		$query->join('LEFT', '#__jazz_mastering_value_num_de_compases_lick AS #__jazz_mastering_value_num_de_compases_lick_303175 ON #__jazz_mastering_value_num_de_compases_lick_303175.id = a.num_de_compases');
		// Join over the foreign key 'image_id'
		$query->select('#__jazz_mastering_img_lick_303177.img_name AS imglicks_img_name_303177');
		$query->join('LEFT', '#__jazz_mastering_img_lick AS #__jazz_mastering_img_lick_303177 ON #__jazz_mastering_img_lick_303177.id = a.image_id');
		// Join over the foreign key 'autor'
		$query->select('#__jazz_mastering_lick_autor_303178.autorname AS lickautors_autorname_303178');
		$query->join('LEFT', '#__jazz_mastering_lick_autor AS #__jazz_mastering_lick_autor_303178 ON #__jazz_mastering_lick_autor_303178.id = a.autor');


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
