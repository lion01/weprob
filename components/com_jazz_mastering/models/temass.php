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
class Jazz_masteringModelTemass extends JModelList {

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
        
        $query->from('`#__jazz_mastering_tema` AS a');
        

		// Join over the foreign key 'tempo'
		$query->select('#__jazz_mastering_tempo_286107.value_tempo AS tempos_value_tempo_286107');
		$query->join('LEFT', '#__jazz_mastering_tempo AS #__jazz_mastering_tempo_286107 ON #__jazz_mastering_tempo_286107.id = a.tempo');
		// Join over the foreign key 'estilo'
		$query->select('#__jazz_mastering_estilo_286108.value_estilo AS estilos_value_estilo_286108');
		$query->join('LEFT', '#__jazz_mastering_estilo AS #__jazz_mastering_estilo_286108 ON #__jazz_mastering_estilo_286108.id = a.estilo');
		// Join over the foreign key 'tonalidad'
		$query->select('#__jazz_mastering_value_tonalidad_302087.value_tonalidad AS tonalidades_value_tonalidad_302087');
		$query->join('LEFT', '#__jazz_mastering_value_tonalidad AS #__jazz_mastering_value_tonalidad_302087 ON #__jazz_mastering_value_tonalidad_302087.id = a.tonalidad');
		// Join over the foreign key 'modo'
		$query->select('#__jazz_mastering_modo_302088.modo AS modos_modo_302088');
		$query->join('LEFT', '#__jazz_mastering_modo AS #__jazz_mastering_modo_302088 ON #__jazz_mastering_modo_302088.id = a.modo');
		// Join over the created by field 'user'
		$query->select('user.name AS user');
		$query->join('LEFT', '#__users AS user ON user.id = a.user');
		// Join over the created by field 'created_by'
		$query->select('created_by.name AS created_by');
		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');


		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
                $query->where('( a.titulo LIKE '.$search.' )');
			}
		}
        


		//Filtering tempo
		$filter_tempo = $this->state->get("filter.tempo");
		if ($filter_tempo) {
			$query->where("a.tempo = '".$filter_tempo."'");
		}

		//Filtering estilo
		$filter_estilo = $this->state->get("filter.estilo");
		if ($filter_estilo) {
			$query->where("a.estilo = '".$filter_estilo."'");
		}

		//Filtering tonalidad
		$filter_tonalidad = $this->state->get("filter.tonalidad");
		if ($filter_tonalidad) {
			$query->where("a.tonalidad = '".$filter_tonalidad."'");
		}

		//Filtering user
		$filter_user = $this->state->get("filter.user");
		if ($filter_user) {
			$query->where("a.user = '".$filter_user."'");
		}        
        
        return $query;
    }

}
