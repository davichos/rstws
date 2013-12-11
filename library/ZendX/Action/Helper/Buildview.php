<?php
class ZendX_Action_Helper_Buildview extends Zend_Controller_Action_Helper_Abstract
{	
	protected $_arraymodules;
	
	public function getArraymodules()
	{
		$this->_setArraymodules();
		return $this->_arraymodules;
	}
	
	private function _setArraymodules()
	{
		      		$this->_arraymodules = array(
      				'mainContentPane'		=>array(
      												'id'=>'adminMainContentPane',
      												'content'=>'',
      												'params'=>array('region'=>'bottom'),
      												'attribs'=>array('style'=>'background-color: #123238;color: #CCC;')
      													
      											),
      				'mainBorderContainer'	=>array(
      												'id'=>'main',
      												'content'=>'',
      												'params'=>array('design'=>'headline'),
      												'attribs'=>array('style' => 'width:auto;background-color: #cde9f7;')
      											),
      				'mainTabContainer'		=>array(
      												'id'=>'adminMainTabContainer',
      												'content'=>'',
      												'params'=>array('region'=>'center'),
      												'attribs'=>array()
      											),
					'mainDialog'			=>array(array(
	      												'id'=>'adminNewMainDialog',
	      												'value'=>new Admin_Form_Usuarioswrite(),
	      												'params'=>array('dojoType'=>'dijit.Dialog', 'title'=>'Nuevo Registro'),
	      												'attribs'=>array()
      												),
      												array(
	      												'id'=>'adminEditMainDialog',
	      												'value'=>'',
	      												'params'=>array('dojoType'=>'dijit.Dialog', 'title'=>'Editar Registro'),
	      												'attribs'=>array()
      												),
      												array(
	      												'id'=>'adminFilterMainDialog',
	      												'value'=>'',
	      												'params'=>array('dojoType'=>'dijit.Dialog', 'title'=>'Filtros Avanzados'),
	      												'attribs'=>array()
      												),
      												array(
	      												'id'=>'adminNewMainDialogRoles',
	      												'value'=>new Admin_Form_Roleswrite(),
	      												'params'=>array('dojoType'=>'dijit.Dialog', 'title'=>'Nuevo Registro'),
	      												'attribs'=>array()
      												),
      												array(
	      												'id'=>'adminNewMainDialogModulos',
	      												'value'=>new Admin_Form_Moduloswrite(),
	      												'params'=>array('dojoType'=>'dijit.Dialog', 'title'=>'Nuevo Registro'),
	      												'attribs'=>array()
      												),
      												array(
	      												'id'=>'adminNewMainDialogAcciones',
	      												'value'=>new Admin_Form_Accioneswrite(),
	      												'params'=>array('dojoType'=>'dijit.Dialog', 'title'=>'Nuevo Registro'),
	      												'attribs'=>array()
      												),
      												array(
	      												'id'=>'adminNewMainDialogVistas',
	      												'value'=>new Admin_Form_Vistaswrite(),
	      												'params'=>array('dojoType'=>'dijit.Dialog', 'title'=>'Nuevo Registro'),
	      												'attribs'=>array()
      												),
      												array(
	      												'id'=>'adminNewMainDialogPermisos',
	      												'value'=>new Admin_Form_Permisoswrite(),
	      												'params'=>array('dojoType'=>'dijit.Dialog', 'title'=>'Nuevo Registro'),
	      												'attribs'=>array()
      												)
      											),
					'tabs'					=> array(
									      			array(
									      				'contentPane'=>array(
									       					'id'=>'usuarioContentPane',
									      					'params'=>array('title'=>'Usuarios'),
									      					'attribs'=>array()    					
									      				),
									      				'toolBar'=>array(
									       					'id'=>'usuarioToolBar',
									      					'params'=>array('dojoType'=>'dijit.Toolbar', 'region'=>'top'),
									      					'attribs'=>array()    					
									      				),
									      				'Bottons'=>array(
									      					array('id'=>'usuariosNew','label'=>'Nuevo','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconNewPage', 'onClick'=>'dijit.byId(\'adminNewMainDialog\').show()')),
									      					array('id'=>'usuariosEdit','label'=>'Editar','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconPaste', 'onClick'=>'dijit.byId(\'adminEditMainDialog\').show()')),
									      					array('id'=>'usuariosFilter','label'=>'Filtros Avanzados','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconTabIndent', 'onClick'=>'dijit.byId(\'adminFilterMainDialog\').show()'))	
									      								
									      				),
									      				'contentPaneGrid'=>array(
									      					'id'=>'usuarioPaneGrid',
									      					'value'=>'',
									      					'params'=>array(),
									      					'url'=>'admin/usuarios',
									      					'layout'=>array(
																				array('field'=>'id','name'=>'Id','width'=>'100px'),
																				array('field'=>'name','name'=>'Nombre','width'=>'200px'),
																				array('field'=>'username','name'=>'Usuario','width'=>'200px'),
																				array('field'=>'email','name'=>'E-mail','width'=>'200px'),
																				array('field'=>'block','name'=>'Bloquear','width'=>'40px')
																			) 	 
									      				)
									      				
									      			),
									      			array(
									      				'contentPane'=>array(
									       					'id'=>'rolesContentPane',
									      					'params'=>array('title'=>'Grupos'),
									      					'attribs'=>array()    					
									      				),
									      				'toolBar'=>array(
									       					'id'=>'rolesToolBar',
									      					'params'=>array('dojoType'=>'dijit.Toolbar', 'region'=>'top'),
									      					'attribs'=>array()    					
									      				),
									      				'Bottons'=>array(
									      					array('id'=>'rolesNew','label'=>'Nuevo','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconNewPage', 'onClick'=>'dijit.byId(\'adminNewMainDialogRoles\').show()')),
									      					array('id'=>'rolesEdit','label'=>'Editar','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconPaste', 'onClick'=>'dijit.byId(\'adminEditMainDialog\').show()')),
									      					array('id'=>'rolesFilter','label'=>'Filtros Avanzados','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconTabIndent', 'onClick'=>'dijit.byId(\'adminFilterMainDialog\').show()'))	
									      								
									      				),
									      				'contentPaneGrid'=>array(
									      					'id'=>'rolesPaneGrid',
									      					'value'=>'',
									      					'params'=>array(),
									      					'url'=>'admin/roles',
									      					'layout'=>array(
																				array('field'=>'id','name'=>'Id','width'=>'100px'),
																				array('field'=>'role','name'=>'Grupo','width'=>'200px'),
																				array('field'=>'idparent','name'=>'Grupo Padre','width'=>'200px')
																			) 	 
									      				)
									      				
									      			),
									      			array(
									      				'contentPane'=>array(
									       					'id'=>'modulosContentPane',
									      					'params'=>array('title'=>'Modulos'),
									      					'attribs'=>array()    					
									      				),
									      				'toolBar'=>array(
									       					'id'=>'modulosToolBar',
									      					'params'=>array('dojoType'=>'dijit.Toolbar', 'region'=>'top'),
									      					'attribs'=>array()    					
									      				),
									      				'Bottons'=>array(
									      					array('id'=>'modulosNew','label'=>'Nuevo','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconNewPage', 'onClick'=>'dijit.byId(\'adminNewMainDialogModulos\').show()'))	,
									      					array('id'=>'modulosEdit','label'=>'Editar','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconPaste', 'onClick'=>'dijit.byId(\'adminEditMainDialog\').show()'))	,
									      					array('id'=>'modulosFilter','label'=>'Filtros Avanzados','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconTabIndent', 'onClick'=>'dijit.byId(\'adminFilterMainDialog\').show()'))	,
									      								
									      				),
									      				'contentPaneGrid'=>array(
									      					'id'=>'modulosPaneGrid',
									      					'value'=>'',
									      					'params'=>array(),
									      					'url'=>'admin/modulos',
									      					'layout'=>array(
																				array('field'=>'id','name'=>'Id','width'=>'100px'),
																				array('field'=>'nombre','name'=>'Modulo','width'=>'200px'),
																				array('field'=>'resource','name'=>'Recurso','width'=>'200px')
																			) 
									      				)
									      				
									      			),
									      			array(
									      				'contentPane'=>array(
									       					'id'=>'actionContentPane',
									      					'params'=>array('title'=>'Acciones'),
									      					'attribs'=>array()    					
									      				),
									      				'toolBar'=>array(
									       					'id'=>'actionToolBar',
									      					'params'=>array('dojoType'=>'dijit.Toolbar', 'region'=>'top'),
									      					'attribs'=>array()    					
									      				),
									      				'Bottons'=>array(
									      					array('id'=>'actionNew','label'=>'Nuevo','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconNewPage', 'onClick'=>'dijit.byId(\'adminNewMainDialogAcciones\').show()'))	,
									      					array('id'=>'actionEdit','label'=>'Editar','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconPaste', 'onClick'=>'dijit.byId(\'adminEditMainDialog\').show()'))	,
									      					array('id'=>'actionFilter','label'=>'Filtros Avanzados','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconTabIndent', 'onClick'=>'dijit.byId(\'adminFilterMainDialog\').show()'))	,
									      								
									      				),
									      				'contentPaneGrid'=>array(
									      					'id'=>'actionPaneGrid',
									      					'value'=>'',
									      					'params'=>array(),
									      					'url'=>'admin/acciones',
									      					'layout'=>array(
																				array('field'=>'id','name'=>'Id','width'=>'100px'),
																				array('field'=>'nombre','name'=>'Controlador','width'=>'200px'),
																				array('field'=>'resource','name'=>'Recurso','width'=>'200px')
																			)  
									      				)
									      				
									      			),
									      			array(
									      				'contentPane'=>array(
									       					'id'=>'viewContentPane',
									      					'params'=>array('title'=>'Vistas'),
									      					'attribs'=>array()    					
									      				),
									      				'toolBar'=>array(
									       					'id'=>'viewToolBar',
									      					'params'=>array('dojoType'=>'dijit.Toolbar', 'region'=>'top'),
									      					'attribs'=>array()    					
									      				),
									      				'Bottons'=>array(
									      					array('id'=>'viewNew','label'=>'Nuevo','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconNewPage', 'onClick'=>'dijit.byId(\'adminNewMainDialogVistas\').show()'))	,
									      					array('id'=>'viewEdit','label'=>'Editar','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconPaste', 'onClick'=>'dijit.byId(\'adminEditMainDialog\').show()'))	,
									      					array('id'=>'viewFilter','label'=>'Filtros Avanzados','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconTabIndent', 'onClick'=>'dijit.byId(\'adminFilterMainDialog\').show()'))	,
									      								
									      				),
									      				'contentPaneGrid'=>array(
									      					'id'=>'viewPaneGrid',
									      					'value'=>'',
									      					'params'=>array(),
									      					'url'=>'admin/vistas',
									      					'layout'=>array(
																				array('field'=>'id','name'=>'Id','width'=>'100px'),
																				array('field'=>'nombre','name'=>'Accion','width'=>'200px'),
																				array('field'=>'resource','name'=>'Recurso','width'=>'200px')
																			)  
									      				)
									      				
									      			),
									      			array(
									      				'contentPane'=>array(
									       					'id'=>'permisosContentPane',
									      					'params'=>array('title'=>'Permisos'),
									      					'attribs'=>array()    					
									      				),
									      				'toolBar'=>array(
									       					'id'=>'permisosToolBar',
									      					'params'=>array('dojoType'=>'dijit.Toolbar', 'region'=>'top'),
									      					'attribs'=>array()    					
									      				),
									      				'Bottons'=>array(
									      					array('id'=>'permisosNew','label'=>'Nuevo','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconNewPage', 'onClick'=>'dijit.byId(\'adminNewMainDialogPermisos\').show()'))	,
									      					array('id'=>'permisosEdit','label'=>'Editar','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconPaste', 'onClick'=>'dijit.byId(\'adminEditMainDialog\').show()'))	,
									      					array('id'=>'permisosFilter','label'=>'Filtros Avanzados','param'=>array('iconClass'=>'dijitEditorIcon dijitEditorIconTabIndent', 'onClick'=>'dijit.byId(\'adminFilterMainDialog\').show()'))	,
									      								
									      				),
									      				'contentPaneGrid'=>array(
									      					'id'=>'permisosPaneGrid',
									      					'value'=>'',
									      					'params'=>array(),
									      					'url'=>'admin/permisos',
									      					'layout'=>array(
																				array('field'=>'id','name'=>'Id','width'=>'100px'),
																				array('field'=>'role','name'=>'Rol','width'=>'100px'),
																				array('field'=>'resource','name'=>'Recurso','width'=>'200px'),
																				array('field'=>'permission','name'=>'Permisos','width'=>'200px')
																			)  
									      				)
									      				
									      			)
									      		)     											
      												
      				);
	}
}