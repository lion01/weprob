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
require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'assets'.DS.'php'.DS.'functions.php');

/**
 * Methods supporting a list of Jazz_mastering records.
 */
class Jazz_masteringModelTune extends JModelList {

	protected $table="`#__jazz_mastering_tema`"; 
	protected $id;
	protected $nombre;
	protected $primer_acorde;
	protected $compositor;
	protected $tempo;
	protected $estilo;
	protected $tonalidad;
	protected $Mayor_menor;
	protected $num_compases;
	//f8Te6A2ZyyOP
	protected $user;
	protected $ejercicio;
	protected $string_chords;
	protected $array_chords=array();
	const separador= '_|_';
	//medidas para style
	protected $medida_compas;
	//Variables para imprimir ejercicio
	protected $compas;
	protected $cadencias;
	protected $modocad;
	protected $num_compases_caden;
	
	public function __construct (){
		$this->get_user ();
		
		parent::__construct();
	}
/**
 * Return array wiht all the information of the tune
 * needs tema_id
 *
 */
	
public function getTema () {
	//$this->id = $id;
$db = JFactory::getDbo();
$query = $db->getQuery(true);
$query = "SELECT * FROM `#__jazz_mastering_tema` Where id = 1";
$db->setQuery($query);
$row = $db->loadAssoc();
		
		$this->nombre = $row['titulo'];
		$this->compositor= $row['compositor'];
		$this->tempo= $row['tempo'];
		$this->estilo= $row['estilo'];
		$this->tonalidad= $row['tonalidad'];
		$this->Mayor_menor= $row['modo'];
		$this->num_compases= $row['compases'];
		$this->string_chords=$row['chords'];
		$this->set_array_chord ();
		$this->primer_acorde=$this->array_chords[0];
		//do_dump($row);
		if ($row== null )
		return $row="no he podido hacer la consulta";
		else
		return $row;
		
	}
	
public function get_user (){
		$this->user = JFactory::getUser();
		}
		
public function Get_temas_asc_temaid () {
	$select=array ('titulo', 'id');
$db = JFactory::getDbo();
/*$query = $db->getQuery(true);
$query->select($select);
$query->from($this->table);
$query->group("'titulo'");
$query->order("'ordering ASC'");*/
$query = "SELECT`titulo`, `id`  FROM `#__jazz_mastering_tema` GROUP BY`titulo` ASC LIMIT 0, 30 ";
$db->setQuery($query);
$results = $db->loadAssocList();
/*$query = "SELECT`titulo`, `temaid`  FROM `temas` GROUP BY`titulo` ASC LIMIT 0, 30 ";
$resultado= mysql_query($query)or die("Error en: $query: " . mysql_error());
$respuesta=toArray2($resultado);
	*/
    if ($results== null )
	return $results="no he podido hacer la consulta";
	else
	return $results;
}
private function set_array_chord () {
		$this->array_chords=explode(Jazz_masteringModelTune::separador, $this->string_chords);
		}
private function set_string_chord () {
			$this->string_chords=implode(Jazz_masteringModelTune::separador, $this->array_chords);
		}
public function getform_to_choose_tema ()
{
//echo'<h2>'.$this->ejercicio.'</h2>';

//$temas=Get_temas_asc ();
//do_dump ($temas);
$temas=$this->Get_temas_asc_temaid ();
//do_dump ($temas);
$cantidad_de_temas=count($temas);
?>

<form action="<?php echo JURI::current(); ?>" method="post" enctype="multipart/form-data" name="chooseejer">
<table>
<tr>
<td width="600">
<?php
	echo"<select name=\"tema\" size=\"$cantidad_de_temas\" width=\"500\" >";
for($i=0;$i<sizeof($temas);$i++) 
{ echo "<option value=\"";
	//CLJI8KmRZrcn : cambiar id en base de datos por tema_id
	echo $temas[$i]['id']."\">".$temas[$i]['titulo']."</option>"; 
	
} 

echo "</select>";
?></td></tr>
<tr>
<td>
<input name="Ir" type="submit" value="submit" />
</td></tr>
</table>
</form>
<?php

//$this->temas=Get_temas_shuffle ();
//do_dump ($temas);
//echo $temas[0];


//echo $this->temas[0];
	
	}
	
public function establecer_i ($u)
	{
		$i=(($u-1)*4)+1;
		return $i;
		}
		
function establecer_limitador_de_i ($u)
	{
		$i=(($u-1)*4)+4;
		return $i;
		}
public function getStyle (){
		
		$content=1000;
		$compas= ($content /4)-12;
		$this->medida_compas=$compas;
		$compases_2=$compas * 2;
		$compases_3=$compas * 3;
		$compases_4=$compas * 4;?>
<style type="text/css">
	
.acorde{
	font-size:28px;
	padding-top:10px;
	padding-left:10px;
	background-color:#CCC;
	letter-spacing:2px;
	width:<? echo $compas; ?>px;
	height:40px;
	display: inline;
	float: left;
	border-right:  solid 1px;
	font-weight:bold;
}
.II-V_1{
	width:<? echo $compas; ?>px;
	padding: 10px 0 10px 10px;
	display:inline;
	float:left;
	}
.II-V_2{
	width:<? echo $compases_2; ?>px;
	padding: 10px 0;
        display:inline;
        float:left;
	}
.titulo_tema {
	font-size:32px;
	text-align:center;
	color:#FFF;
	}
.encabezado_tema{
	width: 100%;
	background-color:#00ADEE;
	padding-top:10px;
	padding-bottom:10px;}
.linia_1 {
	display: inline-block;
	clear: both;
	width: <? echo $content; ?>px;	
}
.linia_2 {
        display: inline-block;
        clear: both;
        width: <? echo $content; ?>px;
}
		</style>
		<?php
		
		}
		
public function get_tema_to_manualimput_mod ()

{
	$temaid=$this->id;
	$user=$this->user->id;
	$num_de_compases=$this->num_compases;
 $toecho='';
/* Esta funcion imprime el tema y pone un formulario debajo para insertar cadencias
	
	*/
	$toecho.= "<form action=\"".JURI::current()."\" method=\"post\">";	
	
	//-----------------
	
$sistemas= $num_de_compases/4;
for ($u=1;$u<=$sistemas;$u++)
{	
// if ($u=2) $i+$u*4;
if ($u>1)
{
	//$toecho.= $u;
		$toecho.= "<div class='linia_1'>";
	for ($i=$this->establecer_i($u);$i<=$this->establecer_limitador_de_i ($u);$i++)
		{
		
		$toecho.= "<div class=\"acorde\">";
		
		$toecho.= $this->array_chords[($i-1)]."</div>";
		}
		$toecho.= "</div>";
		//$toecho.= "<br />";
		$toecho.= "<div class='linia_2'>";
	for ($i=$this->establecer_i ($u);$i<=$this->establecer_limitador_de_i ($u);$i++)
		{
		$toecho.= '<div class="II-V_1">';
		//$toecho.= '<br />';
		$toecho.= "$i. <input name=\"compas[]\" type=\"checkbox\" value=\"$i\" />";
		//$this->drop_down_menu();
		$toecho.= $this->Form_to_get_iiv ();
 		$toecho.= '</div>';
	}
		$toecho.= "</div>";
}
else{
		$toecho.= "<div class='linia_1'>";
		for ($i=1;$i<=4;$i++)
		{
		
		$toecho.= "<div class=\"acorde\">";
		$toecho.= $this->array_chords[($i-1)]."</div>";
		}
		$toecho.= "</div>";
		//$toecho.= "<br />";
		$toecho.= "<div class='linia_2'>";
		for ($i=1;$i<=4;$i++)
		{
		$toecho.= '<div class="II-V_1">';
		//$toecho.= '<br />';
		$toecho.= "$i. <input name=\"compas[]\" type=\"checkbox\" value=\"$i\" />";
		//$this->drop_down_menu();
		$toecho.=	$this->Form_to_get_iiv();
 		$toecho.= '</div>';
	}
		$toecho.= "</div>";
	
}
//	$i=$i+4;
	$toecho.= "<br />";
}
	//---------------------------------
	$toecho.= '<input name="temaid" type="hidden" value="'.$temaid.'" />';
	$toecho.= "<br /><input name=\"hacer\" type=\"submit\" value=\"submit\" /></td></tr>";
	$toecho.= "</form>";
	return $toecho;
}
public function II_V_from_form_div ()

{
	
	$temaid=$this->id;	
	$user=$this->user->id;
	$num_de_compases=$this->num_compases;
	$this->compas=$_POST['compas'];
$this->cadencias=$_POST['cadencias'];
$this->modocad=$_POST['modocad'];
$this->num_compases_caden=$_POST['num_compases_caden'];
$toecho='';
	
	//-----------------
$sistemas= $num_de_compases/4;



for ($u=1;$u<=$sistemas;$u++)
{	
// if ($u=2) $i+$u*4;
if ($u>1)
{
	//$toecho.= $u;
	$toecho.= "<div class='linia_1'>";
	for ($i=$this->establecer_i($u);$i<=$this->establecer_limitador_de_i ($u);$i++)
		{
		
		$toecho.= "<div class=\"acorde\">";
		
		$toecho.= $this->array_chords[($i-1)]."</div>";
		}
		$toecho.= "</div>";
		$toecho.= "<div class='linia_2'>";
	for ($i=$this->establecer_i ($u);$i<=$this->establecer_limitador_de_i ($u);$i++)
		{
		//$toecho.= '<div class="II-V_1">';
		//$toecho.= '<br />';
		//$toecho.= "$i. <input name=\"compas[]\" type=\"checkbox\" value=\"$i\" />";
		$toecho.= $this->print_II_V($i);
 		//$toecho.= '</div>';
	}
	$toecho.="</div>";
}
else{
	$toecho.= "<div class='linia_1'>";
		for ($i=1;$i<=4;$i++)
		{
			$toecho.= "<div class=\"acorde\">";
			$toecho.= $this->array_chords[($i-1)]."</div>";
		}
		$toecho.= "</div>";
		$toecho.= "<div class='linia_2'>";
		for ($i=1;$i<=4;$i++)
		{
			//$toecho.= '<div class="II-V_1">';
			//$toecho.= '<br />';
			//$toecho.= "$i. <input name=\"compas[]\" type=\"checkbox\" value=\"$i\" />";
			@$toecho.= $this->print_II_V($i);
 			//$toecho.= '</div>';
		}
	$toecho.= "</div>";
}
//	$i=$i+4;
	//$toecho.= "<br />";
}
return $toecho;
}

	

}
