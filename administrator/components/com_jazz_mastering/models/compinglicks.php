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
class Jazz_masteringModelcompinglicks extends JModelList
{

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                                'id', 'a.id',
                'created_by', 'a.created_by',
                'time_created', 'a.time_created',
                'cadencia', 'a.cadencia',
                'modo', 'a.modo',
                'num_de_compases', 'a.num_de_compases',
                'image_id', 'a.image_id',
                'autor', 'a.autor',

            );
        }

        parent::__construct($config);
    }


	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $app->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $app->getUserStateFromRequest($this->context.'.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $published);
        
        
		//Filtering cadencia
		$this->setState('filter.cadencia', $app->getUserStateFromRequest($this->context.'.filter.cadencia', 'filter_cadencia', '', 'string'));

		//Filtering modo
		$this->setState('filter.modo', $app->getUserStateFromRequest($this->context.'.filter.modo', 'filter_modo', '', 'string'));

		//Filtering num_de_compases
		$this->setState('filter.num_de_compases', $app->getUserStateFromRequest($this->context.'.filter.num_de_compases', 'filter_num_de_compases', '', 'string'));

        
		// Load the parameters.
		$params = JComponentHelper::getParams('com_jazz_mastering');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.id', 'asc');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 * @return	string		A store id.
	 * @since	1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id.= ':' . $this->getState('filter.search');
		$id.= ':' . $this->getState('filter.state');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 * @since	1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.*'
			)
		);
		$query->from('`#__jazz_mastering_comping_lick` AS a');


		// Join over the user field 'created_by'
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
        
        
		// Add the list ordering clause.
        $orderCol	= $this->state->get('list.ordering');
        $orderDirn	= $this->state->get('list.direction');
        if ($orderCol && $orderDirn) {
            $query->order($db->escape($orderCol.' '.$orderDirn));
        }

		return $query;
	}
}
