<?php

/**
 * @version     0.0.4
 * @package     com_jazz_mastering
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Artur Pañach Bargalló <arturictus@gmail.com> - http://
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');
 require_once (JPATH_COMPONENT_SITE.DS.'models'.DS.'tune.php');
 require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'assets'.DS.'php'.DS.'functions.php');
/**
 * Methods supporting a list of Jazz_mastering records.
 */
class Jazz_masteringModelTune_licks extends Jazz_masteringModelTune {
	
	protected $table="`#__jazz_mastering_lick`"; 
	///VARIABLES PARA Form_to_get_iiv ()
protected $cadencias;
protected $num_compases_caden;
protected $modo_cadencia;
	
function __construct(){

parent::__construct();
}	


	
public function print_II_V($i){
	$db = JFactory::getDbo();
	//Variables con las que trabaja
	 global $user;
	 global $cadencias;
	 global $modocad;
	 global $compas;
	 global $num_compases_caden;
	 global $num_de_compases;
	 $get_array_counter =$i-1;
     $get_array_counter_anterior =$i-2;
	$toecho='';
	$medida_de_compas=$this->medida_compas +10;
	
	//variables para la query
	$where_con=array('cadencia='.$this->cadencias[($i-1)], 'modo='.$this->modocad[($i-1)], 'num_de_compases='.$this->num_compases_caden[$get_array_counter]);
	$select=array('#__jazz_mastering_lick.image_id');
	 if ($num_compases_caden[$get_array_counter_anterior]==2)
		 {
			if ($i==5||$i==9||$i==13||$i==17||$i==21||$i==25||$i==29)
				{ $toecho.= "<div class=\"II-V_1\">";
				 $toecho.= "</div>";
				}
		/* else ; {$toecho.= "primeros de sistema"; $toecho.= "</div>";  */
			}
	 else if (in_array ("$i",$this->compas)){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
				if (isset($user))
					{
				
					$query->from('`#__jazz_mastering_lick` AS a');
					$query->select('#__jazz_mastering_img_lick_303177.img_name AS imglicks_img_name_303177');
					$query->join('LEFT', '#__jazz_mastering_img_lick AS #__jazz_mastering_img_lick_303177 ON #__jazz_mastering_img_lick_303177.id = a.image_id');
					$query->where($where_con);
					//$query->group("`".$columna."`");
					//$query = "SELECT `Nombreimagen` FROM ".$this->table." WHERE `Cadencia` LIKE '".$this->cadencias[($i-1)]."' AND  `major_menor` LIKE '".$this->modocad[($i-1)]."' AND `Num_de_compases` =". $this->num_compases_caden[$get_array_counter]." AND `user` = $user";
					}
				else
					{  
					$query->from('`#__jazz_mastering_lick` AS a');
					$query->select('#__jazz_mastering_img_lick_303177.img_name AS imglicks_img_name_303177');
					$query->join('LEFT', '#__jazz_mastering_img_lick AS #__jazz_mastering_img_lick_303177 ON #__jazz_mastering_img_lick_303177.id = a.image_id');
					//$query->where($where_con);
					//$query->group("`".$columna."`");
					/*	$query = "SELECT `Nombreimagen` FROM ".$this->table." WHERE `Cadencia` LIKE '".$this->cadencias[($i-1)]."' AND  `major_menor` LIKE '".$this->modocad[($i-1)]."' AND `Num_de_compases` =". $this->num_compases_caden[$get_array_counter];}
					$result=mysql_query($query)or die("Error en: $query: " . mysql_error());*/
					}
				$db->setQuery($query);	
				$vector = $db->loadColumn();
				//$vector = toArray ($result);//convierto las respuestas (nombre imagen) en un array
				shuffle ($vector);
				//print_r($vector);
	     			//barajo las respuestas para que sean aleatorios
					//do_dump($vector);
	if ($this->num_compases_caden[$get_array_counter]==1)//si el II-V es de un compas:
				{$toecho.= "<div class=\"II-V_1\">";
				//$toecho.= '<img src="'.$this->folder.'/'.$vector[0].'"  width="'.$medida_de_compas.'" height="100" alt="'.$vector[0].'" />';
				$toecho.= '<img src="'.$vector[0].'"  width="'.$medida_de_compas.'" height="100" alt="'.$vector[0].'" />';
				$toecho.= "</div>";}
	else if ($this->num_compases_caden[$get_array_counter]==2)//Si pones un II_V de 2 compases $toecho.=:
				{$toecho.= "<div class=\"II-V_2\">";
				$toecho.= '<img src="'.$this->folder.'/'.$vector[0].'"  width="'.$medida_de_compas*2 .'" height="100" alt="'.$vector[0].'"/>';
				$toecho.= "</div>";}
	else {
	 			$toecho.= "<div class=\"II-V_1\">";//si el conjunto esta vacio imprimir el espacio en blanco
	 			print_r($vector);
	 			$toecho.= "</div>";
	 						}
		}
	//	Yz7RxkuJDgNC
	//Si el anterior tiene 2 compases no imprimar nada, fuera de si has seleccionado poner un II-V
	 
	 return $toecho;
}	
	
	
	
public function get_saved_frases_for_form ($columna)
{ 
	$user=$this->user->id;
	$column_ar=array();
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
 	//db_connect ();

		if (isset ($user))
			{
			$query->select("`".$columna."`");
			$query->from($this->table);
			$query->where('user = '.$user);
			$query->group("`".$columna."`");
			/*$query= "SELECT `$columna`
			\n FROM `".$tabla."` 
			\n WHERE lick_user = $user 
			\n GROUP BY `$columna` ";*/
			
			}
		else {
			$query->select("`".$columna."`");
			$query->from($this->table);
			$query->where('user = '.$user);
			$query->group("`".$columna."`");
			//$query="SELECT `$columna` FROM ".$tabla." GROUP BY `$columna`";
		}
	$db->setQuery($query);
	$result = $db->loadColumn();
	
	foreach ($result as $valor)
	{
	$column_ar[]['key']=$valor;
	
	}
 	//db_connect ();
 //If ($columna == 'modo' || 'cadencia')
 for($i=0;$i<count($column_ar);$i++)
 {			$query = $db->getQuery(true);
			$query->select("`".$columna."`");
			$query->from("`#__jazz_mastering_".$columna."`");
			$query->where('id LIKE '.$column_ar[$i]['key']);
			//$query->group("`".$columna."`");
			$db->setQuery($query);
	$column_ar[$i]['def'] = $db->loadResult();
 }
	
	
	
	//$resultado= mysql_query($query)or die("Error en: $query: " . mysql_error());
	//$vector=toarray ($resultado);
	//do_dump($vector);
	//return $vector;
	//do_dump($results);
	return $column_ar;
}






public function get_saved_licks_def() 
{

$this->cadencias=$this->get_saved_frases_for_form ('cadencia');
$this->num_compases_caden=$this->get_saved_frases_for_form ('num_de_compases');
$this->modo_cadencia=$this->get_saved_frases_for_form ('modo');
}
	
	
public function Form_to_get_iiv ()
{
	
/////___________Funcion formulario de ingreso de ...
////________________________-_______________________________________________________________________
//cadencias
$contador_cadencias=count($this->cadencias);
	//echo $contador_cadencias;
	$toecho ="<select name=\"cadencias[]\" size=\"1\" >";
 $toecho.= "<option value=\"\"></option>";
for($fila=0;$fila<$contador_cadencias;$fila++) 
{ $toecho.= "<option value=\"";
	
	$toecho.= $this->cadencias[$fila]['key']."\">".$this->cadencias[$fila]['def']."</option>"; 
	
} 

$toecho.= "</select>";
// Modo cadencia

$contador_modo_cadencia=count($this->modo_cadencia);
	
	$toecho.="<select name=\"modocad[]\" size=\"1\" >";
$toecho.= "<option value=\"\"></option>";
for($fila=0;$fila<$contador_modo_cadencia;$fila++) 
{ $toecho.= "<option value=\"";
	
	$toecho.= $this->modo_cadencia[$fila]['key']."\">".$this->modo_cadencia[$fila]['def']."</option>"; 
	
} 

$toecho.= "</select>";

$contador_num_compases_caden=count($this->num_compases_caden);
	
	$toecho.="<select name=\"num_compases_caden[]\" size=\"1\" >";
$toecho.= "<option value=\"\"></option>";
for($fila=0;$fila<$contador_num_compases_caden;$fila++) 
{ $toecho.= "<option value=\"";
	
	$toecho.= $this->num_compases_caden[$fila]['key']."\">".$this->num_compases_caden[$fila]['key']."</option>"; 
	
} 

$toecho.= "</select>";

return $toecho;
}





public function Getprint_exercise (){
	
	
if ( $_POST['hacer'] )
{
$temaid=$_POST['temaid'];
$this->gettema();
$compas=$_POST['compas'];
$cadencias=$_POST["cadencias"];
$modocad=$_POST["modocad"];
$num_compases_caden=$_POST["num_compases_caden"];

echo $this->II_V_from_form_div();
//do_dump($_POST);

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 2a
elseif (isset ($_POST['Ir']))
{
	$temaid=$_POST['tema'];
	$this->get('tema');
	$this->get_saved_licks_def();
	//print_r($this->num_compases_caden);
	
	/*if ($this->GetPrimerAcorde () == "" || NULL)
	{ 
		echo "<tr><td>".$this->form_acordes_tema ()."</td></tr>";
		exit;
	}*/

	echo $this->get_tema_to_manualimput_mod ();

	//$cadencias=$this->get_saved_frases_for_form ('cadencia');
	//do_dump($_POST);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////1a fase
else 
{
	$this->getform_to_choose_tema();
	
	}
}

}
