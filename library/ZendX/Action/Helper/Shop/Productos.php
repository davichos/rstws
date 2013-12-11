<?php
class ZendX_Action_Helper_Shop_Productos extends Zend_Controller_Action_Helper_Abstract
{
	protected $_view;
	protected $_contenido;


        public function setView(Zend_View_Interface $view){
		$this->_view = $view;
		$arreglocontenido  = $this->_getArraycontent();
		$titlepane = null;
		$i=0;
		foreach ($arreglocontenido['titlePane'] as $tilepane){
			$input ='<table width="100%" border="0"><tr>';
			$trs='';$trsep=''; 
			foreach ($tilepane['content'] as $inputconts){
				++$i; if($i%2===0){$trs='';$trsep='</tr>'.chr(10).'<tr>';}
				$input .= $trs.'<td><label for="'.
						  $inputconts['id'].'" class="required">'.$inputconts['label'].'</label></td><td>'.
						  $this->_addValidationtextbox($inputconts,$inputconts['value'],$tilepane['id']).'</td>'.$trsep; 
				$trsep='';		  
			}
			
			
			$input .= '</tr></table>';
			
			$titlepane .= $this->_addCustomdijit($tilepane,$input).'<br />';
                        $titlepane .= $this->_addTextarea().'<br />';
                        $titlepane .= $this->_addImage().'<br />';
                        $titlepane .= $this->_addSubmit().$this->_addClear();
                        ;
		}
		$this->_contenido = $titlepane;							
		
	}
	
	private function _addValidationtextbox($accordioncontainer=array(),$content=null,$idparent=null){
		$view = $this->_view;
		$dijit = $view->getHelper($accordioncontainer['helper']);
		switch ($accordioncontainer['helper']){
			case 'ValidationTextBox':
					$validationTextBox = $dijit->validationTextBox(
							$accordioncontainer['id'],
							$content,
							$accordioncontainer['params'],
							$accordioncontainer['attribs']
						);
			break;

			case 'FilteringSelect':
					$validationTextBox = $dijit->filteringSelect(
							$accordioncontainer['id'],
							$content,
							$accordioncontainer['params'],
							$accordioncontainer['attribs']
						);					
			break;

			case 'DateTextBox':
					$validationTextBox = $dijit->dateTextBox(
							$accordioncontainer['id'],
							$content,
							$accordioncontainer['params'],
							$accordioncontainer['attribs']
						);
			break;
			
			case 'RadioButton':
					$validationTextBox = $dijit->radioButton(
							$accordioncontainer['id'],
							$content,
							$accordioncontainer['params'],
							$accordioncontainer['attribs'],
							$accordioncontainer['options']
						);
			break;
			
			//default: 
					//$validationTextBox = null;
			//break;	
		}				
		return $validationTextBox;
	}
	
	private function _addCustomdijit($accordioncontainer=array(),$content=null){
		$view = $this->_view;
		$dijit = $view->getHelper('CustomDijit');
	
		$acordionContainer = $dijit->customDijit(
							$accordioncontainer['id'],
							$content,
							$accordioncontainer['params']
						);
		return $acordionContainer;
	}
	
	private function _addAccordionpane($accordionpane=array(),$content=null)
	{
		$view = $this->_view;
		$dijit = $view->getHelper('AccordionPane');
		$acordionPane = $dijit->accordionPane(
							$accordionpane['id'],
							$content,
							$accordionpane['params'],
							$accordionpane['attribs']
						);
		return $acordionPane;
	}
	
	private function _getArraycontent()
	{
		$arregloElementos = array(
									'titlePane' => array(array(
																'id'=>'Producto-gral',
																'content'=>array(
																						array(
																							'helper'=>'ValidationTextBox',
																							'id'=>'Producto-gral-sku',
																							'label'=>'SKU',
																							'value'=>'',
																							'params'=>array(),
																							'attribs'=>array(),	
																						),
																						array(
																							'helper'=>'ValidationTextBox',
																							'id'=>'Producto-gral-nombre',
																							'label'=>'Nombre De Articulo',
																							'value'=>'',
																							'params'=>array(),
																							'attribs'=>array(),	
																						),
                                                                                                                                                                                array(
																							'helper'=>'ValidationTextBox',
																							'id'=>'Producto-gral-precio',
																							'label'=>'Precio',
																							'value'=>'',
																							'params'=>array(),
																							'attribs'=>array(),	
																						),
//                                                                                                                                                                                array(
//																							'helper'=>'ValidationTextBox',
//																							'id'=>'Producto-gral-idtemp',
//																							'label'=>'',
//																							'value'=>  $this->_getIdshared(),
////																							'params'=>array('style'=>'visibility:hidden;'),
//                                                                                                                                                                                        'params'=>array(),
//																							'attribs'=>array(),	
//																						),
																				),																			
																'params'=>array('dojoType'=>'dijit.TitlePane','title'=>'Informacion General'),
																'attribs'=>array(),														
															),
			
														)	
										);
		return $arregloElementos;										
	}
	
	public function getContenido(){
		return $this->_contenido;
	}
        
        protected function _addTextarea(){
            	$view = $this->_view;
		$dijit = $view->getHelper('CustomDijit');
                $dijitTextarea = $view->getHelper('Textarea');
                
                $Textarea = $dijitTextarea->textarea(
                            'textareaContenedor',
                            'Escribe aqui la Informacion detallada del producto...',
                            array(),
                            array('style' => 'width: 100%;')
                        );
		$acordionContainer = $dijit->customDijit(
                        'ContenidoTexarea',
                        $Textarea,
                        array('dojoType'=>'dijit.TitlePane',
                            'title'=>'Informacion Detallada')
						);
                return $acordionContainer;
        }
        
        protected function _addImage(){
            $view = $this->_view;
	    $dijit = $view->getHelper('CustomDijit');
            $file = $view->getHelper('FormFile');
            $acordionContainer = $dijit->customDijit(
                        'ContenidoAgregarImagen',
                        '<form id="fuerventmyuploadnew"'.
                        ' name="fuerventmyuploadnew" method="post"'.
                        ' style="height:150px" enctype="multipart/form-data">'.
                        '<input type="hidden" name="Idshared" id="Idshared" value="'.$this->_getIdshared().'" />'.
                        $file->formFile('insertarImagen', array()).
                        $this->_addButton().
                        $this->_addMensaje().
                        $this->_addListimages().'</form>',
                        array('dojoType'=>'dijit.TitlePane',
                            'title'=>'Agregar Imagen solo 600 x 400')
		);
           return $acordionContainer;
        }
        
        protected function _addListimages(){
            return '</br><table id="filesInsertados">
                    <tr><th width="50px">tamano</th><th width="150px">nombre</th><th width="50px">eliminar</th></tr>
                </table>';
        }
        
        protected function _addButton(){
                $view = $this->_view;
		$dijit = $view->getHelper('Button');
                $button  = $dijit->button(
                            'uploadNew-guardaJson',
                            'Cargar',
                            array()
                        );
               return $button;
        }
        
        protected function _addMensaje(){
                return '<div id="Mensajes"></div>';
        }
        
        protected function _getIdshared(){
            return uniqid('',true);
        }
        
        protected function _addSubmit(){
                $view = $this->_view;
		$dijit = $view->getHelper('Button');
                $button  = $dijit->button(
                            'saveNew-guardaJson',
                            'Guardar',
                            array()
                        );
               return $button;
        }
        
        protected function _addClear(){
                $view = $this->_view;
		$dijit = $view->getHelper('Button');
                $button  = $dijit->button(
                            'clearNew-guardaJson',
                            'Cancelar',
                            array()
                        );
               return $button;
        }

        

}