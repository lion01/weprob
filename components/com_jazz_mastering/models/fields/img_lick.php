<?php
/**
 * @version     0.0.6
 * @package     com_jazz_mastering
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Artur Pañach Bargalló <arturictus@gmail.com> - http://
 */

defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

/**
 * Supports an HTML select list of categories
 */
class JFormFieldImg_lick extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'img_lick';
	
	//get label sin usar
	
	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	
	protected function getInput()
	{
		// Initialize variables.
		$html = array();

		//if($imagen)
		//{
			//si variable imagen existe s�bela
		  /*  $this->upload_img();
		    $this->autoname=$this->value;
			$this->intro_in_db ();
			$html[] = "<div> aqu� muestro la imagen </div>";
			}
			
		else{ */
			//Formulario
			
			$html[] = '<input name="file" type="file"  onChange="ver(form.file.value)"> blaskdf�asjdfas';		
		//	}
			
		return implode($html);
		
	}
								
							//protected $auto_name;
								
							private function create_aleatorio_name () 
							{
								$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; 
								$cad = ""; 
									for($i=0;$i<12;$i++) 
									{ 
										$cad .= substr($str,rand(0,62),1); 
									}
							$auto_name= $tipodeintro."_".$cad."_".contador_get ()."_".strtolower($_FILES ['file']['name']);
							
							return $auto_name; 
							}
							
								
							private function upload_img ()
							
							{
							
									//$auto_name= $this->create_aleatorio_name () ;
									$folder=$this->folder;   
									
									$tipodeintro;
										// Fin de la creacion de la cadena aletoria 
									    $tamano = $_FILES [ 'file' ][ 'size' ]; // Leemos el tamaño del fichero 
										$tamano_max=1000000;// (1Mb) // Tamaño maximo permitido 
										if( $tamano < $tamano_max)
										{ // Comprovamos el tamaño  
											//$destino = 'iiv' ; // Carpeta donde se guardata 
											$sep=explode('image/',$_FILES["file"]["type"]); // Separamos image/ 
											$tipo=$sep[1]; // Optenemos el tipo de imagen que es 
												if($tipo == "gif" || $tipo == "pjpeg" || $tipo == "bmp"||$tipo == "png"||$tipo == "jpeg"|| $tipo == "jpg" ||$tipo == "GIF" || $tipo == "PJPEG" || $tipo == "BMP"||$tipo == "PNG"||$tipo == "JPEG" || $tipo == "JPG"){ // Si el tipo de imagen a subir es el mismo de los permitidos, segimos. Puedes agregar mas tipos de imagen 
												move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $folder . '/' .$auto_name);  // Subimos el archivo 
												//echo "Has subido una nueva imagen a la categoria $tipodeintro <br />"; // Todo OK
												} 
												else echo "el tipo de archivo no es de los permitidos";// Si no es el tipo permitido lo desimos 
											} 
										else echo "El archivo supera el peso permitido.";// Si supera el tamaño de permitido lo desimos 
										} 
								
							public function intro_in_db ()
								{
									@$submit=$_POST['submit'];
									if ($submit)
									{
										$cadencia=$_POST['Cadencia'];
										@$cadencia2=$_POST['Cadencia2'];
										@$cadencia3=$_POST['Cadencia3'];
										$modo=$_POST['modo'];
										@$modo2=$_POST['modo2'];
										@$modo3=$_POST['modo3'];
										$num_decompases=$_POST['num_decompases'];
										$tipodeintro=$_POST['tipodeintro'];
										$autor=$_POST['autor'];
										$user=$_POST['user'];
										$imagen=$_FILES ['file']/* ['name'] */;
										//echo $_FILES ['file']['name'];
										//echo "$imagen[0]";
							
										//$cadencia=$_POST[''];
									$toecho;
										
									$errorIndex = $_FILES["file"]["error"];
									
									// Si hay error en la imagen:
										if ($errorIndex > 0) {
									    $toecho.='<div class="error_msj"><img src=\'imagenes/cancel_48.png\'/>¿Hay algún problema con la imagen?, ¿estás seguro de haberla introducido en el formulario?	</div>';
									}
									//Si los campos estám vacios:
										if ($cadencia==""||$modo==""||$num_decompases=="" || $user =="")
										{ 
										$toecho.="<div class=\"error_msj\"><p> <img src='imagenes/cancel_48.png'/>No has introducido la información necesaria para almacenar el recurso de forma 	correcta 	en la base de datos.<br />
										Vuelve a intentarlo rellenando todos los campos.</p></div>";
										} 
							
									//todo bien, seguimos		
									contador_update ();
									$auto_name= $tipodeintro."_".create_aleatorio_name ()."_".contador_get ().strtolower($_FILES ['file']['name']);
									$this->upload_img ($auto_name);
									/* if(!$this->upload_img ($auto_name))
									{
									echo "<div class=\"error_msj\">Ha habido algún problema al subir la imagen</div>";
									require_once ("estructure/footer.php");
							    	exit;} */
								
									//si hay mas opciones:
								
										if ( isset ($cadencia3) && $cadencia3!="")
									{
											if ( isset ($modo3) && $modo3!="")
										{
											$query = "INSERT INTO `analmusic`.".$this->table." (".$this->id_table.", `Cadencia`, `major_menor`, `Num_de_compases`, `Nombreimagen`,`autor`,`user`) VALUES (NULL, '$cadencia3', '$modo3', '$num_decompases', '$auto_name','$autor','$user');";
											$result=mysql_query($query)or die("Error en: $query: " . mysql_error());
										}
									}
									
									//FIN del ingreso a base de datos y mensages de ok
									$toecho.= "<div class=\"msj_ok\"><img src='imagenes/accepted_48.png'/>El recurso ha sido almacenado correctamente!!!</div><br />
									<br />";
									}
								return $toecho;
							}
							
 
}