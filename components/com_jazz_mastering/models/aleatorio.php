<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 
/**
 * HelloWorld Model
 */
class jazz_masteringModelAleatorio extends JModelItem
{
        /**
         * @var string msg
         */
	protected $ex_title='Aleatorios';
	 protected $tonalidades;
	 protected $ale_tonalidad;
	protected $escalas= array ('Mayor','menor','menor melódica','menor armónica','Alterada','Simétrica','De tonos');
 	protected $intervalos_dia = array ('2a', '3a','4a','5a','6a','7a','8a');
	protected $ale_escalas;
	protected $ale_intervalos_dia;
	protected $to_print;
	protected $user_name_temas;
	protected $user;
	protected $userid;
	protected $temas;
	
	public function getTemas(){
	$this->user = JFactory::getUser();	
	$db = JFactory::getDBO();

$query = 'SELECT `nombre_tema` FROM '
. $db->nameQuote('#__jazz_mastering_tema')
.' WHERE '
.$db->nameQuote('created_by')
.' = '
.$db->Quote($this->user->id);
$db->setQuery($query);
$this->temas=$db->loadResultArray();
		return $this->temas;
	}
    public function setuser(){
    	$this->user = JFactory::getUser();
    	//$UserId	= (int) $user->get('id');
    	return $this->user;
    }
    public function getuser(){
    $this->setuser();
    return $this->user;
    }
	public function getex_title(){
		return $this->ex_title;
	}
 	public function getTonalidades(){
	if(!isset($this->tonalidades))
	{
 $this->tonalidades= array ('A', 'A#-Bb', 'B','C','C#-Db','D','D#-Eb','E','F','Gb-F#','G','G#-Ab');
 return $this->tonalidades;
	}
}
public function getAle_Tonalidad(){
	if(!isset($this->ale_tonalidad))
		{	
		$tonalidades=$this->getTonalidades();
 		shuffle($tonalidades);
		$this->ale_tonalidad=$tonalidades;
 		return $this->ale_tonalidad[0];
		}
	}
	public function getAle_escalas (){
	shuffle($this->escalas);
	$this->ale_escalas=$this->escalas;
	return $this->ale_escalas[0];
	
	}
    public function getAle_intervalos_dia (){
    shuffle($this->intervalos_dia);
	$this->ale_intervalos_dia=$this->intervalos_dia;
	return $this->ale_intervalos_dia[0];
    }
    public function getTo_print(){
    	$temas=$this->getTemas();
    	shuffle($temas);
    	$this->to_print =array (
	array ('titulo'=>'Nota', 'obj'=>$this->getAle_Tonalidad()),
	array ('titulo'=>'Tema', 'obj'=>$temas[0]),
	//array ('titulo'=>'Ubicación 4/4 ', 'obj'=>$this->ubicacion_4_4()),
	array ('titulo'=>'Escalas ', 'obj'=>$this->getAle_escalas ()),
	array ('titulo'=>'Intérvalos diatónicos', 'obj'=>$this->getAle_intervalos_dia ())
	);
	return $this->to_print;
    }
public function getAle_style(){
	?>
    <style>
	#linia{
		display:inline-block;
		}
	#elemento{
		border:1px #999 solid;
		width:250px;
		height:130px;
		}
	#elemento .texto{}
	#elemento .titulo{
		line-height: 28px;
	background-color: #DAFF9F;
	border-top: 2px solid #B5EF59;
	color: #000;
	padding: 0 10px;
	cursor: pointer;
	font-weight: bold;
	font-size: 16px;
	height: 28px;
	position: relative;}
	#elemento .titulo .anchor{
		height:auto;
		width:10px;
		background-color:#000;
		}
	#elemento .objeto {
		
		margin-top:opx;
		/* height:100px; */}
		#elemento .objeto p{
			font-size:18px;
			text-align:center;
			font-weight:bold;}
	.ocultar {display:none;}
	.clear(clear:both;)
	</style>
    <?php
	}
        /**
         * Get the message
         * @return string The message to be displayed to the user
         */
 
}