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

jimport('joomla.form.helper');
JFormHelper::loadFieldClass('media');

/**
 * Supports an HTML select list of categories
 */
class JFormFieldImglick extends JFormFieldMedia
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'imglick';

	/**
	 * The initialised state of the document object.
	 *
	 * @var    boolean
	 * @since  11.1
	 */
	protected static $initialised = false;

	/**
	 * Method to get the field input markup for a media selector.
	 * Use attributes to identify specific created_by and asset_id fields
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput()
	{
		$assetField = $this->element['asset_field'] ? (string) $this->element['asset_field'] : 'asset_id';
		$authorField = $this->element['created_by_field'] ? (string) $this->element['created_by_field'] : 'created_by';
		$asset = $this->form->getValue($assetField) ? $this->form->getValue($assetField) : (string) $this->element['asset_id'];
		if ($asset == '')
		{
			$asset = JRequest::getCmd('option');
		}

		$link = (string) $this->element['link'];
		if (!self::$initialised)
		{

			// Load the modal behavior script.
			JHtml::_('behavior.modal');

			// Build the script.
			$script = array();
			$script[] = '	function jInsertFieldValue(value, id) {';
			$script[] = '		var old_value = document.id(id).value;';
			$script[] = '		if (old_value != value) {';
			$script[] = '			var elem = document.id(id);';
			$script[] = '			elem.value = value;';
			$script[] = '			elem.fireEvent("change");';
			$script[] = '			if (typeof(elem.onchange) === "function") {';
			$script[] = '				elem.onchange();';
			$script[] = '			}';
			$script[] = '			jMediaRefreshPreview(id);';
			$script[] = '		}';
			$script[] = '	}';

			$script[] = '	function jMediaRefreshPreview(id) {';
			$script[] = '		var value = document.id(id).value;';
			$script[] = '		var img = document.id(id + "_preview");';
			$script[] = '		if (img) {';
			$script[] = '			if (value) {';
			$script[] = '				img.src = "' . JURI::root() . '" + value;';
			$script[] = '				document.id(id + "_preview_empty").setStyle("display", "none");';
			$script[] = '				document.id(id + "_preview_img").setStyle("display", "");';
			$script[] = '			} else { ';
			$script[] = '				img.src = ""';
			$script[] = '				document.id(id + "_preview_empty").setStyle("display", "");';
			$script[] = '				document.id(id + "_preview_img").setStyle("display", "none");';
			$script[] = '			} ';
			$script[] = '		} ';
			$script[] = '	}';

			$script[] = '	function jMediaRefreshPreviewTip(tip)';
			$script[] = '	{';
			$script[] = '		tip.setStyle("display", "block");';
			$script[] = '		var img = tip.getElement("img.media-preview");';
			$script[] = '		var id = img.getProperty("id");';
			$script[] = '		id = id.substring(0, id.length - "_preview".length);';
			$script[] = '		jMediaRefreshPreview(id);';
			$script[] = '	}';

			// Add the script to the document head.
			JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));

			self::$initialised = true;
		}

		// Initialize variables.
		$html = array();
		$attr = '';

		// Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="' . (string) $this->element['class'] . '"' : '';
		$attr .= $this->element['size'] ? ' size="' . (int) $this->element['size'] . '"' : '';

		// Initialize JavaScript field attributes.
		$attr .= $this->element['onchange'] ? ' onchange="' . (string) $this->element['onchange'] . '"' : '';

		// The text field.
		$html[] = '<div class="fltlft">';
		$html[] = '	<input type="text" name="' . $this->name . '" id="' . $this->id . '"' . ' value="'
			. htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '"' . ' readonly="readonly"' . $attr . ' />';
		$html[] = '</div>';

		$directory = (string) $this->element['directory'];
		if ($this->value && file_exists(JPATH_ROOT . '/' . $this->value))
		{
			$folder = explode('/', $this->value);
			array_shift($folder);
			array_pop($folder);
			$folder = implode('/', $folder);
		}
		elseif (file_exists(JPATH_ROOT . '/' . JComponentHelper::getParams('com_media')->get('image_path', 'images') . '/' . $directory))
		{
			$folder = $directory;
		}
		else
		{
			$folder = '';
		}
		// The button.
		$html[] = '<div class="button2-left">';
		$html[] = '	<div class="blank">';
		$html[] = '		<a class="modal" title="' . JText::_('JLIB_FORM_BUTTON_SELECT') . '"' . ' href="'
			. ($this->element['readonly'] ? ''
			: ($link ? $link
				: 'index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;asset=' . $asset . '&amp;author='
				. $this->form->getValue($authorField)) . '&amp;fieldid=' . $this->id . '&amp;folder=' . $folder) . '"'
			. ' rel="{handler: \'iframe\', size: {x: 800, y: 500}}">';
		$html[] = JText::_('JLIB_FORM_BUTTON_SELECT') . '</a>';
		$html[] = '	</div>';
		$html[] = '</div>';

		$html[] = '<div class="button2-left">';
		$html[] = '	<div class="blank">';
		$html[] = '		<a title="' . JText::_('JLIB_FORM_BUTTON_CLEAR') . '"' . ' href="#" onclick="';
		$html[] = 'jInsertFieldValue(\'\', \'' . $this->id . '\');';
		$html[] = 'return false;';
		$html[] = '">';
		$html[] = JText::_('JLIB_FORM_BUTTON_CLEAR') . '</a>';
		$html[] = '	</div>';
		$html[] = '</div>';

		// The Preview.
		$preview = (string) $this->element['preview'];
		$showPreview = true;
		$showAsTooltip = false;
		switch ($preview)
		{
			case 'false':
			case 'none':
				$showPreview = false;
				break;
			case 'true':
			case 'show':
				break;
			case 'tooltip':
			default:
				$showAsTooltip = true;
				$options = array(
					'onShow' => 'jMediaRefreshPreviewTip',
				);
				JHtml::_('behavior.tooltip', '.hasTipPreview', $options);
				break;
		}

		if ($showPreview)
		{
			if ($this->value && file_exists(JPATH_ROOT . '/' . $this->value))
			{
				$src = JURI::root() . $this->value;
			}
			else
			{
				$src = '';
			}

			$attr = array(
				'id' => $this->id . '_preview',
				'class' => 'media-preview',
				'style' => 'max-width:160px; max-height:100px;'
			);
			$img = JHtml::image($src, JText::_('JLIB_FORM_MEDIA_PREVIEW_ALT'), $attr);
			$previewImg = '<div id="' . $this->id . '_preview_img"' . ($src ? '' : ' style="display:none"') . '>' . $img . '</div>';
			$previewImgEmpty = '<div id="' . $this->id . '_preview_empty"' . ($src ? ' style="display:none"' : '') . '>'
				. JText::_('JLIB_FORM_MEDIA_PREVIEW_EMPTY') . '</div>';

			$html[] = '<div class="media-preview fltlft">';
			if ($showAsTooltip)
			{
				$tooltip = $previewImgEmpty . $previewImg;
				$options = array(
					'title' => JText::_('JLIB_FORM_MEDIA_PREVIEW_SELECTED_IMAGE'),
					'text' => JText::_('JLIB_FORM_MEDIA_PREVIEW_TIP_TITLE'),
					'class' => 'hasTipPreview'
				);
				$html[] = JHtml::tooltip($tooltip, $options);
			}
			else
			{
				$html[] = ' ' . $previewImgEmpty;
				$html[] = ' ' . $previewImg;
			}
			$html[] = '</div>';
		}

		return implode("\n", $html);
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