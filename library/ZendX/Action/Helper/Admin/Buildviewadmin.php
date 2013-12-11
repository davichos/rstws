<?php

class ZendX_Action_Helper_Admin_Buildviewadmin extends Zend_Controller_Action_Helper_Abstract {

    protected $_arraymodules;

    public function getArraymodules() {
        $this->_setArraymodules();
        return $this->_arraymodules;
    }

    private function _setArraymodules() {

        $this->_arraymodules = array(
            'mainContentPane' => array(
                'id' => 'adminMainContentPane',
                'content' => '',
                'params' => array('region' => 'bottom'),
                'attribs' => array('style' => 'background-color: #88b61a;color: #fff;')
            ),
            'mainBorderContainer' => array(
                'id' => 'main',
                'content' => '',
                'params' => array('design' => 'headline'),
                'attribs' => array('style' => 'width:auto;background-color: #fff;')
            ),
            'mainTabContainer' => array(
                'id' => 'adminMainTabContainer',
                'content' => '',
                'params' => array('region' => 'center'),
                'attribs' => array()
            ),
            'mainDialog' => array(
                array('id' => 'adminEditTemplateMainDialogModhorario',
                    'value' => new Admin_Form_Modhorarioedit(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Editar Registro'),
                    'attribs' => array(),
                ),
                array('id' => 'adminNewTemplateMainDialogModhorario',
                    'value' => new Admin_Form_Modhorarionew(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Nuevo Registro'),
                    'attribs' => array(),
                ),
                array('id' => 'adminNewTemplateMainDialogModusers',
                    'value' => new Admin_Form_Modusersnew(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Nuevo Registro'),
                    'attribs' => array(),
                ),
                array('id' => 'adminEditTemplateMainDialogModusers',
                    'value' => new Admin_Form_Modusersedit(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Editar Registro'),
                    'attribs' => array(),
                ),
                array('id' => 'adminFilavaTemplateMainDialogModusers',
                    'value' => new Admin_Form_Modusersfilava(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Buscar Registro'),
                    'attribs' => array(),
                ),
                array('id' => 'adminEditTemplateMainDialogModalbercas',
                    'value' => new Admin_Form_Modalbercasedit(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Editar Registro'),
                    'attribs' => array(),
                ),
                array('id' => 'adminNewTemplateMainDialogModalbercas',
                    'value' => new Admin_Form_Modalbercasnew(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Nuevo Registro'),
                    'attribs' => array(),
                ),
                array('id' => 'adminEditTemplateMainDialogModcurso',
                    'value' => new Admin_Form_Modcursoedit(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Editar Registro'),
                    'attribs' => array(),
                ),
                array('id' => 'adminNewTemplateMainDialogModcurso',
                    'value' => new Admin_Form_Modcursonew(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Nuevo Registro'),
                    'attribs' => array(),
                ),
                array('id' => 'adminNewTemplateMainDialogModnivel',
                    'value' => new Admin_Form_Modnivelnew(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Nuevo Registro'),
                    'attribs' => array(),
                ),
                array('id' => 'adminEditTemplateMainDialogModnivel',
                    'value' => new Admin_Form_Modniveledit(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Editar Registro'),
                    'attribs' => array(),
                ),
                array('id' => 'adminFilavaTemplateMainDialogModcurso',
                    'value' => new Admin_Form_Modcursofilava(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Buscar Curso'),
                    'attribs' => array(),
                ),
                array('id' => 'adminEditTemplateMainDialogModcliente',
                    'value' => new Admin_Form_Modclienteedit(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Editar Registro'),
                    'attribs' => array(),
                ),
                array('id' => 'adminNewTemplateMainDialogModcliente',
                    'value' => new Admin_Form_Modclientenew(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Nuevo Registro'),
                    'attribs' => array(),
                ),  
                array('id' => 'adminTemplateMainDialogModclienteLay',
                    'value' => new Admin_Form_Modclienteeditlay(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Personalizar columnas'),
                    'attribs' => array(),
                ),  
                array('id' => 'adminTemplateMainDialogGetInftut',
                    'value' => new Admin_Form_Modclientetutor(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Información sobre padre o tutor'),
                    'attribs' => array(),
                ),  
                array('id' => 'adminTemplateMainDialogClienteInfoAd',
                    'value' => new Admin_Form_Modclienteinfoad(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Información adicional'),
                    'attribs' => array(),
                ),  
                array('id' => 'adminNewTemplateMainDialogModinfoescolar',
                    'value' => new Admin_Form_Modclienteinfoudg(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Información UDG'),
                    'attribs' => array(),
                ),  
                array('id' => 'adminNewTemplateMainDialogInfocurso',
                    'value' => new Admin_Form_Modclienteinfocurso(),
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Información UDG'),
                    'attribs' => array(),
                ),  
            ),
            'tabs' => array(
                array(
                    'resource' => 'admin/empleados/index',
                    'contentPane' => array(
                        'id' => 'empleadosContentPane',
                        'params' => array('title' => 'Empleados'),
                        'attribs' => array()
                    ),
                    'toolBar' => array(
                        'id' => 'empleadosToolBar',
                        'params' => array('dojoType' => 'dijit.Toolbar', 'region' => 'top'),
                        'attribs' => array()
                    ),
                    'Bottons' => array(
                        array('resource' => 'admin/empleados/write', 'id' => 'empleadosNew', 'label' => 'Nuevo', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconNewPage', 'onClick' => 'dijit.byId(\'adminNewTemplateMainDialogModusers\').show()')),
                        array('resource' => 'admin/empleados/update', 'id' => 'empleadosEdit', 'label' => 'Editar', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconPaste', 'onClick' => 'sendUpdate("gridEmpleados","adminEditTemplateMainDialogModusers","admin/empleados/findid","modusersedit",layaoutEditModusers)')),
                        array('resource' => 'admin/empleados/changeestatus', 'id' => 'empleadosLock', 'label' => 'Bloquear/Desbloquear', 'param' => array('iconClass' => 'commonIcons dijitIconDelete', 'onClick' => 'sendEstatus("gridEmpleados","empleadosPaneGrid","admin/empleados/changeestatus","admin/empleados",layoutModempleados)')),
                        array('resource' => 'admin/empleados/exportexcel', 'id' => 'empleadosExportexcel', 'label' => 'Exportar a Excel', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconInsertTable', 'onClick' => 'getExcelExporter("gridEmpleados","empleados")')),
                        array('resource' => 'admin/empleados/reloadgrid', 'id' => 'empleadosreloadGrid', 'label' => 'Actualizar Grid', 'param' => array('iconClass' => 'commonIcons dijitIconUndo', 'onClick' => 'reloadGrid("gridEmpleados","empleadosPaneGrid","admin/empleados",layoutModempleados)')),
                        array('resource' => 'admin/empleados/filtroavanzado', 'id' => 'empleadosAutAva', 'label' => 'Filtro Avanzado', 'param' => array('iconClass' => 'commonIcons dijitIconFilter', 'onClick' => 'dijit.byId(\'adminFilavaTemplateMainDialogModusers\').show()')),
                    ),
                    'contentPaneGrid' => array(
                        'id' => 'empleadosPaneGrid',
                        'resource' => 'admin/empleados/index',
                        'value' => '',
                        'params' => array(),
                        'url' => 'admin/empleados',
                        'layout' =>
                        array(
                            array('field' => 'id', 'name' => 'Id', 'width' => '50px'),
                            array('field' => 'nombre', 'name' => 'Nombre(s)', 'width' => '50px'),
                            array('field' => 'appat', 'name' => 'Apellido paterno', 'width' => '50px'),
                            array('field' => 'apmat', 'name' => 'Apellido matermo', 'width' => '50px'),
                            array('field' => 'rfc', 'name' => 'Rfc', 'width' => '50px'),
                            array('field' => 'idperfil', 'name' => 'Perfil', 'width' => '50px'),
                            array('field' => 'telefono', 'name' => 'Telefono', 'width' => '50px'),
                            array('field' => 'movil', 'name' => 'Movil', 'width' => '50px'),
                            array('field' => 'email', 'name' => 'Email', 'width' => '50px'),
                            array('field' => 'direccion', 'name' => 'Direccion', 'width' => '50px'),
                            array('field' => 'colonia', 'name' => 'Colonia', 'width' => '50px'),
                            array('field' => 'cp', 'name' => 'Cp', 'width' => '50px'),
                            array('field' => 'sexo', 'name' => 'Sexo', 'width' => '50px'),
                            array('field' => 'fechanac', 'name' => 'Fecha nac', 'width' => '50px'),
                            array('field' => 'fechacreacion', 'name' => 'Fecha creación', 'width' => '50px'),
                            array('field' => 'ultimaactualizacion', 'name' => 'Ultima actualizacion', 'width' => '50px'),
                            array('field' => 'estatus', 'name' => 'Estatus', 'width' => '50px'),
                        )
                    )
                ),
                array(
                    'resource' => 'admin/horario/index',
                    'contentPane' => array(
                        'id' => 'horarioContentPane',
                        'params' => array('title' => 'Horarios'),
                        'attribs' => array()
                    ),
                    'toolBar' => array(
                        'id' => 'horarioToolBar',
                        'params' => array('dojoType' => 'dijit.Toolbar', 'region' => 'top'),
                        'attribs' => array()
                    ),
                    'Bottons' => array(
                        array('resource' => 'admin/horario/write', 'id' => 'horarioNew', 'label' => 'Nuevo', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconNewPage', 'onClick' => 'dijit.byId(\'adminNewTemplateMainDialogModhorario\').show()')),
                        array('resource' => 'admin/horario/update', 'id' => 'horarioEdit', 'label' => 'Editar', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconPaste', 'onClick' => 'sendUpdate("gridHorario","adminEditTemplateMainDialogModhorario","admin/horario/findid","modhorarioedit",layaoutEditModhorario)')),
                        array('resource' => 'admin/horario/changeestatus', 'id' => 'horarioLock', 'label' => 'Bloquear/Desbloquear', 'param' => array('iconClass' => 'commonIcons dijitIconDelete', 'onClick' => 'sendEstatus("gridHorario","horarioPaneGrid","admin/horario/changeestatus","admin/horario",layoutModhorario)')),
                        array('resource' => 'admin/horario/exportexcel', 'id' => 'horarioExportexcel', 'label' => 'Exportar a Excel', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconInsertTable', 'onClick' => 'getExcelExporter("gridHorario","horario")')),
                        array('resource' => 'admin/horario/reloadgrid', 'id' => 'horarioreloadGrid', 'label' => 'Actualizar Grid', 'param' => array('iconClass' => 'commonIcons dijitIconUndo', 'onClick' => 'reloadGrid("gridHorario","horarioPaneGrid","admin/horario",layoutModhorario)')),
//                        array('resource' => 'admin/horario/filtroavanzado', 'id' => 'horarioAutAva', 'label' => 'Filtro Avanzado', 'param' => array('iconClass' => 'commonIcons dijitIconFilter', 'onClick' => 'dijit.byId(\'adminFiltroAvanMainDialogModhorario\').show()')),
                    ),
                    'contentPaneGrid' => array(
                        'id' => 'horarioPaneGrid',
                        'resource' => 'admin/horario/index',
                        'value' => '',
                        'params' => array(),
                        'url' => 'admin/horario',
                        'layout' => array(
                            array('field' => 'id', 'name' => 'Id', 'width' => '50px'),
                            array('field' => 'de', 'name' => 'De:', 'width' => '80px'),
                            array('field' => 'hasta', 'name' => 'A:', 'width' => '80px'),
                            array('field' => 'dias', 'name' => 'Días', 'width' => '80px'),
                            array('field' => 'fechacreacion', 'name' => 'Fecha creación', 'width' => '100px'),
                            array('field' => 'fechaactualizacion', 'name' => 'Fecha actualización', 'width' => '100px'),
                            array('field' => 'estatus', 'name' => 'Estatus', 'width' => '80px'),
                        )
                    )
                ),
                array(
                    'resource' => 'admin/nivel/index',
                    'contentPane' => array(
                        'id' => 'nivelContentPane',
                        'params' => array('title' => 'Niveles'),
                        'attribs' => array()
                    ),
                    'toolBar' => array(
                        'id' => 'nivelToolBar',
                        'params' => array('dojoType' => 'dijit.Toolbar', 'region' => 'top'),
                        'attribs' => array()
                    ),
                    'Bottons' => array(
                        array('resource' => 'admin/nivel/write', 'id' => 'nivelNew', 'label' => 'Nuevo', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconNewPage', 'onClick' => 'dijit.byId(\'adminNewTemplateMainDialogModnivel\').show()')),
                        array('resource' => 'admin/nivel/update', 'id' => 'nivelEdit', 'label' => 'Editar', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconPaste', 'onClick' => 'sendUpdate("gridNivel","adminEditTemplateMainDialogModnivel","admin/nivel/findid","modniveledit",layaoutEditModnivel)')),
                        array('resource' => 'admin/nivel/changeestatus', 'id' => 'nivelLock', 'label' => 'Bloquear/Desbloquear', 'param' => array('iconClass' => 'commonIcons dijitIconDelete', 'onClick' => 'sendEstatus("gridNivel","nivelPaneGrid","admin/nivel/changeestatus","admin/nivel",layoutModnivel)')),
                        array('resource' => 'admin/nivel/exportexcel', 'id' => 'nivelExportexcel', 'label' => 'Exportar a Excel', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconInsertTable', 'onClick' => 'getExcelExporter("gridNivel","nivel")')),
                        array('resource' => 'admin/nivel/reloadgrid', 'id' => 'nivelreloadGrid', 'label' => 'Actualizar Grid', 'param' => array('iconClass' => 'commonIcons dijitIconUndo', 'onClick' => 'reloadGrid("gridNivel","nivelPaneGrid","admin/nivel",layoutModnivel)')),
//                        array('resource' => 'admin/nivel/filtroavanzado', 'id' => 'nivelAutAva', 'label' => 'Filtro Avanzado', 'param' => array('iconClass' => 'commonIcons dijitIconFilter', 'onClick' => 'dijit.byId(\'adminFiltroAvanMainDialogModnivel\').show()')),
                    ),
                    'contentPaneGrid' => array(
                        'id' => 'nivelPaneGrid',
                        'resource' => 'admin/nivel/index',
                        'value' => '',
                        'params' => array(),
                        'url' => 'admin/nivel',
                        'layout' =>
                        array(
                            array('field' => 'id', 'name' => 'No. Fila', 'width' => '50px'),
                            array('field' => 'nombre', 'name' => 'Nombre', 'width' => '80px'),
                            array('field' => 'descripcion', 'name' => 'Descripción', 'width' => '80px'),
                            array('field' => 'nocarril', 'name' => 'No carril preferente', 'width' => '80px'),
                            array('field' => 'fechacreacion', 'name' => 'Fecha creación', 'width' => '80px'),
                            array('field' => 'fechaactualizacion', 'name' => 'Fecha actualización', 'width' => '80px'),
//                            array('field' => 'fechabaja', 'name' => 'Fecha baja', 'width' => '50px'),
                            array('field' => 'estatus', 'name' => 'Estatus', 'width' => '80px'),
                        )
                    )
                ),
                array(
                    'resource' => 'admin/alberca/index',
                    'contentPane' => array(
                        'id' => 'albercaContentPane',
                        'params' => array('title' => 'Albercas'),
                        'attribs' => array()
                    ),
                    'toolBar' => array(
                        'id' => 'albercaToolBar',
                        'params' => array('dojoType' => 'dijit.Toolbar', 'region' => 'top'),
                        'attribs' => array()
                    ),
                    'Bottons' => array(
                        array('resource' => 'admin/alberca/write', 'id' => 'albercaNew', 'label' => 'Nuevo', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconNewPage', 'onClick' => 'dijit.byId(\'adminNewTemplateMainDialogModalbercas\').show()')),
                        array('resource' => 'admin/alberca/update', 'id' => 'albercaEdit', 'label' => 'Editar', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconPaste', 'onClick' => 'sendUpdate("gridAlberca","adminEditTemplateMainDialogModalbercas","admin/alberca/findid","modalbercasedit",layaoutEditModalbercas)')),
                        array('resource' => 'admin/alberca/changeestatus', 'id' => 'albercaLock', 'label' => 'Bloquear/Desbloquear', 'param' => array('iconClass' => 'commonIcons dijitIconDelete', 'onClick' => 'sendEstatus("gridAlberca","albercaPaneGrid","admin/alberca/changeestatus","admin/alberca",layoutModalbercas)')),
                        array('resource' => 'admin/alberca/exportexcel', 'id' => 'albercaExportexcel', 'label' => 'Exportar a Excel', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconInsertTable', 'onClick' => 'getExcelExporter("gridAlberca","alberca")')),
                        array('resource' => 'admin/alberca/reloadgrid', 'id' => 'albercareloadGrid', 'label' => 'Actualizar Grid', 'param' => array('iconClass' => 'commonIcons dijitIconUndo', 'onClick' => 'reloadGrid("gridAlberca","albercaPaneGrid","admin/alberca",layoutModalbercas)')),
//                        array('resource' => 'admin/alberca/filtroavanzado', 'id' => 'albercaAutAva', 'label' => 'Filtro Avanzado', 'param' => array('iconClass' => 'commonIcons dijitIconFilter', 'onClick' => 'dijit.byId(\'adminFiltroAvanMainDialogModalberca\').show()')),
                    ),
                    'contentPaneGrid' => array(
                        'id' => 'albercaPaneGrid',
                        'resource' => 'admin/alberca/index',
                        'value' => '',
                        'params' => array(),
                        'url' => 'admin/alberca',
                        'layout' => array(
                            array('field' => 'id', 'name' => 'No. Alberca', 'width' => '50px'),
                            array('field' => 'nombre', 'name' => 'Nombre', 'width' => '80px'),
                            array('field' => 'largo', 'name' => 'Largo', 'width' => '50px'),
                            array('field' => 'ancho', 'name' => 'Ancho', 'width' => '50px'),
                            array('field' => 'carrilesmin', 'name' => 'Carriles min', 'width' => '50px'),
                            array('field' => 'carrilesmax', 'name' => 'Carriles max', 'width' => '50px'),
                            array('field' => 'profundidadminima', 'name' => 'Profundidad minima', 'width' => '50px'),
                            array('field' => 'profundidadmaxima', 'name' => 'Profundidad maxima', 'width' => '50px'),
                            array('field' => 'fechacreacion', 'name' => 'Fecha creación', 'width' => '50px'),
                            array('field' => 'fechaactualizacion', 'name' => 'Fecha actualización', 'width' => '50px'),
                            array('field' => 'estatus', 'name' => 'Estatus', 'width' => '50px'),
                        )
                    )
                ),
                array(
                    'resource' => 'admin/curso/index',
                    'contentPane' => array(
                        'id' => 'cursoContentPane',
                        'params' => array('title' => 'Curso'),
                        'attribs' => array()
                    ),
                    'toolBar' => array(
                        'id' => 'cursoToolBar',
                        'params' => array('dojoType' => 'dijit.Toolbar', 'region' => 'top'),
                        'attribs' => array()
                    ),
                    'Bottons' => array(
                        array('resource' => 'admin/curso/write', 'id' => 'cursoNew', 'label' => 'Nuevo', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconNewPage', 'onClick' => 'dijit.byId(\'adminNewTemplateMainDialogModcurso\').show()')),
                        array('resource' => 'admin/curso/update', 'id' => 'cursoEdit', 'label' => 'Editar', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconPaste', 'onClick' => 'sendUpdate("gridCurso","adminEditTemplateMainDialogModcurso","admin/curso/findid","modcursoedit",layaoutEditModcurso)')),
                        array('resource' => 'admin/curso/changeestatus', 'id' => 'cursoLock', 'label' => 'Bloquear/Desbloquear', 'param' => array('iconClass' => 'commonIcons dijitIconDelete', 'onClick' => 'sendEstatus("gridCurso","cursoPaneGrid","admin/curso/changeestatus","admin/curso",layoutModcurso)')),
                        array('resource' => 'admin/curso/exportexcel', 'id' => 'cursoExportexcel', 'label' => 'Exportar a Excel', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconInsertTable', 'onClick' => 'getExcelExporter("gridCurso","curso")')),
                        array('resource' => 'admin/curso/reloadgrid', 'id' => 'cursoreloadGrid', 'label' => 'Actualizar Grid', 'param' => array('iconClass' => 'commonIcons dijitIconUndo', 'onClick' => 'reloadGrid("gridCurso","cursoPaneGrid","admin/curso",layoutModcurso)')),
                        array('resource' => 'admin/curso/filtroavanzado', 'id' => 'cursoAutAva', 'label' => 'Filtro Avanzado', 'param' => array('iconClass' => 'commonIcons dijitIconFilter', 'onClick' => 'dijit.byId(\'adminFilavaTemplateMainDialogModcurso\').show()')),
                    ),
                    'contentPaneGrid' => array(
                        'id' => 'cursoPaneGrid',
                        'resource' => 'admin/curso/index',
                        'value' => '',
                        'params' => array(),
                        'url' => 'admin/curso',
                        'layout' => array(
                            array('field' => 'id', 'name' => 'No. Curso', 'width' => '50px'),
                            array('field' => 'nombre', 'name' => 'Nombre del curso', 'width' => '80px'),
                            array('field' => 'albercaid', 'name' => 'Alberca', 'width' => '80px'),
                            array('field' => 'horarioid', 'name' => 'Horario', 'width' => '120px'),
                            array('field' => 'nivelid', 'name' => 'Nivel', 'width' => '50px'),
                            array('field' => 'carril', 'name' => 'Carril', 'width' => '50px'),
                            array('field' => 'metros', 'name' => 'Metros', 'width' => '50px'),
                            array('field' => 'empleadoid', 'name' => 'Instructor', 'width' => '120px'),
                            array('field' => 'capacidad', 'name' => 'Capacidad (personas)', 'width' => '100px'),
                            array('field' => 'fechacreacion', 'name' => 'Fecha creación', 'width' => '80px'),
                            array('field' => 'fechaactualizacion', 'name' => 'Fecha actualización', 'width' => '80px'),
                            array('field' => 'estatus', 'name' => 'Estatus', 'width' => '50px'),
                        )
                    )
                ),
                array(
                    'resource' => 'admin/cliente/index',
                    'contentPane' => array(
                        'id' => 'clienteContentPane',
                        'params' => array('title' => 'Cliente'),
                        'attribs' => array()
                    ),
                    'toolBar' => array(
                        'id' => 'clienteToolBar',
                        'params' => array('dojoType' => 'dijit.Toolbar', 'region' => 'top'),
                        'attribs' => array()
                    ),
                    'Bottons' => array(
                        array('resource' => 'admin/cliente/write', 'id' => 'clienteNew', 'label' => 'Nuevo', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconNewPage', 'onClick' => 'dijit.byId(\'adminNewTemplateMainDialogModcliente\').show()')),
                        array('resource' => 'admin/cliente/update', 'id' => 'clienteEdit', 'label' => 'Editar', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconPaste', 'onClick' => 'sendUpdate("gridCliente","adminEditTemplateMainDialogModcliente","admin/cliente/findid","modclienteedit",layaoutEditModcliente)')),
                        array('resource' => 'admin/cliente/update', 'id' => 'clienteTutor', 'label' => 'Información de Tutor', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconPaste', 'onClick' => 'sendUpdate("gridCliente","adminTemplateMainDialogGetInftut","admin/cliente/findtutor","modclientetutor",layaoutModclienteTutor)')),
                        array('resource' => 'admin/cliente/update', 'id' => 'clienteInfoAd', 'label' => 'Información Adicional', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconPaste', 'onClick' => 'sendUpdate("gridCliente","adminTemplateMainDialogClienteInfoAd","admin/cliente/findinfoad","modclienteinfoad",layaoutModclienteInfoAd)')),
                        array('resource' => 'admin/cliente/update', 'id' => 'clienteInfoUdg', 'label' => 'Información UDG', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconPaste', 'onClick' => 'sendUpdate("gridCliente","adminNewTemplateMainDialogModinfoescolar","admin/cliente/findinfoudg","modclienteinfoudg",layaoutModclienteInfoudg)')),
                        array('resource' => 'admin/cliente/update', 'id' => 'clienteInfocurso', 'label' => 'Información Curso', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconPaste', 'onClick' => 'sendUpdate("gridCliente","adminNewTemplateMainDialogInfocurso","admin/cliente/findinfocurso","modclienteinfocurso",layaoutModclienteInfocurso)')),
                        array('resource' => 'admin/cliente/changeestatus', 'id' => 'clienteLock', 'label' => 'Bloquear/Desbloquear', 'param' => array('iconClass' => 'commonIcons dijitIconDelete', 'onClick' => 'sendEstatus("gridCliente","clientePaneGrid","admin/cliente/changeestatus","admin/cliente",layoutModcliente)')),
                        array('resource' => 'admin/cliente/exportexcel', 'id' => 'clienteExportexcel', 'label' => 'Exportar a Excel', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconInsertTable', 'onClick' => 'getExcelExporter("gridCliente","cliente")')),
                        array('resource' => 'admin/cliente/reloadgrid', 'id' => 'clientereloadGrid', 'label' => 'Actualizar Grid', 'param' => array('iconClass' => 'commonIcons dijitIconUndo', 'onClick' => 'reloadGrid("gridCliente","clientePaneGrid","admin/cliente",layoutModcliente)')),
                        array('resource' => 'admin/cliente/filtroavanzado', 'id' => 'clienteAutAva', 'label' => 'Filtro Avanzado', 'param' => array('iconClass' => 'commonIcons dijitIconFilter', 'onClick' => 'dijit.byId(\'adminFilavaTemplateMainDialogModcliente\').show()')),
                        array('resource' => 'admin/cliente/filtroavanzado', 'id' => 'clienteAasdasutAva', 'label' => 'Filtro Avanzado', 'param' => array('iconClass' => 'commonIcons dijitIconFilter', 'onClick' => 'dijit.byId(\'adminTemplateMainDialogModclienteLay\').show()')),
                    ),
                    'contentPaneGrid' => array(
                        'id' => 'clientePaneGrid',
                        'resource' => 'admin/cliente/index',
                        'value' => '',
                        'params' => array(),
                        'url' => 'admin/cliente',
                        'layout' => array(
                            array('field' => 'id', 'name' => 'No. Cliente', 'width' => '50px'),
                            array('field' => 'nombre', 'name' => 'Nombre', 'width' => '50px'),
                            array('field' => 'appaterno', 'name' => 'Ap paterno', 'width' => '50px'),
                            array('field' => 'apmaterno', 'name' => 'Ap materno', 'width' => '50px'),
                            array('field' => 'direccion', 'name' => 'Direccion', 'width' => '50px'),
                            array('field' => 'noext', 'name' => 'No ext', 'width' => '50px'),
                            array('field' => 'noint', 'name' => 'No int', 'width' => '50px'),
                            array('field' => 'colonia', 'name' => 'Colonia', 'width' => '50px'),
                            array('field' => 'cp', 'name' => 'Cp', 'width' => '50px'),
                            array('field' => 'ciudad', 'name' => 'Ciudad', 'width' => '50px'),
                            array('field' => 'estado', 'name' => 'Estado', 'width' => '50px'),
                            array('field' => 'telefono', 'name' => 'Telefono', 'width' => '50px'),
                            array('field' => 'celular', 'name' => 'Celular', 'width' => '50px'),
                            array('field' => 'email', 'name' => 'E mail', 'width' => '50px'),
                            array('field' => 'fechanacimiento', 'name' => 'Fecha nacimiento', 'width' => '50px'),
                            array('field' => 'ciudadnacimiento', 'name' => 'Ciudad nacimiento', 'width' => '50px'),
                            array('field' => 'estadonacimiento', 'name' => 'Estado nacimiento', 'width' => '50px'),
                            array('field' => 'fechacreacion', 'name' => 'Fecha creacion', 'width' => '50px'),
                            array('field' => 'fechaactualizacion', 'name' => 'Fecha actualizacion', 'width' => '50px'),
                            array('field' => 'fechabaja', 'name' => 'Fecha baja', 'width' => '50px'),
                            array('field' => 'estatus', 'name' => 'Estatus', 'width' => '50px'),
                        )
                    )
                ),
//                array(
//                    'resource' => 'admin/notas/index',
//                    'contentPane' => array(
//                        'id' => 'notasContentPane',
//                        'params' => array('title' => 'Notas de venta'),
//                        'attribs' => array()
//                    ),
//                    'toolBar' => array(
//                        'id' => 'notasToolBar',
//                        'params' => array('dojoType' => 'dijit.Toolbar', 'region' => 'top'),
//                        'attribs' => array()
//                    ),
//                    'Bottons' => array(
//                        array('resource' => 'admin/notas/upload', 'id' => 'notasUpload', 'label' => 'Cargar archivo', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconInsertTable', 'onClick' => 'dijit.byId(\'modestadoarchivoDialogUpload\').show()')),
//                        array('resource' => 'admin/notas/download', 'id' => 'notasDownload', 'label' => 'Descargar plantilla', 'param' => array('iconClass' => 'commonIcons dijitIconConnector', 'onClick' => 'getDescargaPorMod("notas")')),
//                        array('resource' => 'admin/notas/update', 'id' => 'notasNew', 'label' => 'Marcar como válido', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconNewPage', 'onClick' => 'sendEstatus("gridNotas","notasPaneGrid","admin/notas/update","admin/notas",layoutNotas)')),
//                        array('resource' => 'admin/notas/changeestatus', 'id' => 'notasLock', 'label' => 'Marcar como error', 'param' => array('iconClass' => 'commonIcons dijitIconError', 'onClick' => 'sendEstatus("gridNotas","notasPaneGrid","admin/notas/changeestatus","admin/notas",layoutNotas)')),
//                        array('resource' => 'admin/notas/exportexcel', 'id' => 'notasExportexcel', 'label' => 'Exportar a Excel', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconInsertTable', 'onClick' => 'getExcelExporter("gridTicket","notas")')),
//                        array('resource' => 'admin/notas/reloadgrid', 'id' => 'notasreloadGrid', 'label' => 'Actualizar Grid', 'param' => array('iconClass' => 'commonIcons dijitIconUndo', 'onClick' => 'reloadGrid("gridNotas","notasPaneGrid","admin/notas",layoutNotas)')),
//                        array('resource' => 'admin/notas/filtroavanzado', 'id' => 'notasAutAva', 'label' => 'Filtro Avanzado', 'param' => array('iconClass' => 'commonIcons dijitIconFilter', 'onClick' => 'dijit.byId(\'adminFiltroAvanMainDialogModnota\').show()')),
//                    ),
//                    'contentPaneGrid' => array(
//                        'id' => 'notasPaneGrid',
//                        'resource' => 'admin/notas/index',
//                        'value' => '',
//                        'params' => array(),
//                        'url' => 'admin/notas',
//                        'layout' => array(
//                            array('field' => 'id', 'name' => 'Id', 'width' => '50px'),
//                            array('field' => 'nombre', 'name' => 'Nombre de la nota', 'width' => '120px'),
//                            array('field' => 'archivo', 'name' => 'Nombre de la imágen', 'width' => '120px'),
//                            array('field' => 'user', 'name' => 'Usuario', 'width' => '100px'),
//                            array('field' => 'fechaact', 'name' => 'Fecha de carga de la nota', 'width' => '120px'),
//                            array('field' => 'fechalast', 'name' => 'Fecha última actualización', 'width' => '120px'),
//                            array('field' => 'estatus', 'name' => 'Estatus', 'width' => '110px'),
//                            array('field' => 'message', 'name' => 'Acción', 'width' => '120px', 'formatter' => 'formatter'),
//                        )
//                    )
//                ),
            /* array(
              'resource' => 'admin/puntos/index',
              'contentPane' => array(
              'id' => 'puntosContentPane',
              'params' => array('title' => 'Puntos'),
              'attribs' => array()
              ),
              'toolBar' => array(
              'id' => 'puntosToolBar',
              'params' => array('dojoType' => 'dijit.Toolbar', 'region' => 'top'),
              'attribs' => array()
              ),
              'Bottons' => array(
              array('resource' => 'admin/puntos/exportexcel', 'id' => 'puntosExportexcel', 'label' => 'Exportar a Excel', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconInsertTable', 'onClick' => 'getExcelExporter("gridPuntos","puntos")')),
              array('resource' => 'admin/puntos/reloadgrid', 'id' => 'puntosreloadGrid', 'label' => 'Actualizar Grid', 'param' => array('iconClass' => 'commonIcons dijitIconUndo', 'onClick' => 'reloadGrid("gridPuntos","puntosPaneGrid","admin/puntos",layoutModpuntos)')),
              array('resource' => 'admin/puntos/filtroavanzado', 'id' => 'puntosAutAva', 'label' => 'Filtro Avanzado', 'param' => array('iconClass' => 'commonIcons dijitIconFilter', 'onClick' => 'dijit.byId(\'adminFiltroAvanMainDialogModpuntos\').show()')),
              ),
              'contentPaneGrid' => array(
              'id' => 'puntosPaneGrid',
              'resource' => 'admin/puntos/index',
              'value' => '',
              'params' => array(),
              'url' => 'admin/puntos',
              'layout' => array(
              array('field' => 'id', 'name' => 'Id', 'width' => '50px'),
              array('field' => 'name', 'name' => 'Nombre(s)', 'width' => '150px'),
              array('field' => 'username', 'name' => 'Nombre de usuario', 'width' => '100px'),
              array('field' => 'pa', 'name' => 'Puntos Acumulados', 'width' => '100px'),
              array('field' => 'pc', 'name' => 'Puntos Canjeados', 'width' => '100px'),
              array('field' => 'pd', 'name' => 'Puntos Disponibles', 'width' => '100px'),
              array('field' => 'estatus', 'name' => 'Estatus', 'width' => '80px'),
              )
              )
              ),
              array(
              'resource' => 'admin/pedido/index',
              'contentPane' => array(
              'id' => 'pedidoContentPane',
              'params' => array('title' => 'Pedidos'),
              'attribs' => array()
              ),
              'toolBar' => array(
              'id' => 'pedidoToolBar',
              'params' => array('dojoType' => 'dijit.Toolbar', 'region' => 'top'),
              'attribs' => array()
              ),
              'Bottons' => array(
              array('resource' => 'admin/pedido/exportexcel', 'id' => 'pedidoExportexcel', 'label' => 'Exportar a Excel', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconInsertTable', 'onClick' => 'getExcelExporter("gridPedido","pedido")')),
              array('resource' => 'admin/pedido/reloadgrid', 'id' => 'pedidoreloadGrid', 'label' => 'Actualizar Grid', 'param' => array('iconClass' => 'commonIcons dijitIconUndo', 'onClick' => 'reloadGrid("gridPedido","pedidoPaneGrid","admin/pedido",layoutModpedido)')),
              array('resource' => 'admin/pedido/filtroavanzado', 'id' => 'pedidoAutAva', 'label' => 'Filtro Avanzado', 'param' => array('iconClass' => 'commonIcons dijitIconFilter', 'onClick' => 'dijit.byId(\'adminFiltroAvanMainDialogModpedido\').show()')),
              array('resource' => 'admin/pedido/cancel', 'id' => 'pedidoAutcancel', 'label' => 'Cancellar pedido(s)', 'param' => array('iconClass' => 'commonIcons dijitIconDelete', 'onClick' => 'sendEstatus("gridPedido","pedidoPaneGrid","admin/pedido/cancel","admin/pedido",layoutModpedido)')),
              array('resource' => 'admin/pedido/delivery', 'id' => 'pedidoAutentrega', 'label' => 'Marcar como entregado(s)', 'param' => array('iconClass' => 'commonIcons dijitIconEditTask', 'onClick' => 'sendEstatus("gridPedido","pedidoPaneGrid","admin/pedido/delivery","admin/pedido",layoutModpedido)')),
              ),
              'contentPaneGrid' => array(
              'id' => 'pedidoPaneGrid',
              'resource' => 'admin/pedido/index',
              'value' => '',
              'params' => array(),
              'url' => 'admin/pedido',
              'layout' => array(
              array('field' => 'id', 'name' => 'Id', 'width' => '50px'),
              array('field' => 'nombre', 'name' => 'Nombre(s)', 'width' => '80px'),
              array('field' => 'appat', 'name' => 'Apellido Paterno', 'width' => '80px'),
              array('field' => 'apmat', 'name' => 'Apellido Materno', 'width' => '80px'),
              array('field' => 'ordernumber', 'name' => 'Número de orden', 'width' => '50px'),
              array('field' => 'sku', 'name' => 'Sku', 'width' => '80px'),
              array('field' => 'producto', 'name' => 'Producto', 'width' => '50px'),
              array('field' => 'cantidad', 'name' => 'Cantidad', 'width' => '50px'),
              array('field' => 'importe', 'name' => 'Importe', 'width' => '50px'),
              array('field' => 'fechacreacion', 'name' => 'Fecha canje', 'width' => '50px'),
              array('field' => 'fechaactualizacion', 'name' => 'Fecha actualización', 'width' => '50px'),
              array('field' => 'estatus', 'name' => 'Estatus', 'width' => '150px'),
              )
              )
              ), */
//                array(
//                    'resource' => 'admin/estadoarchivos/index',
//                    'contentPane' => array(
//                        'id' => 'estadoarchivosContentPane',
//                        'params' => array('title' => 'Estado de Archivos'),
//                        'attribs' => array()
//                    ),
//                    'toolBar' => array(
//                        'id' => 'estadoarchivosToolBar',
//                        'params' => array('dojoType' => 'dijit.Toolbar', 'region' => 'top'),
//                        'attribs' => array()
//                    ),
//                    'Bottons' => array(
//                        array('resource' => 'admin/estadoarchivos/upload', 'id' => 'estadoarchivosUpload', 'label' => 'Cargar', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconInsertTable', 'onClick' => 'dijit.byId(\'modestadoarchivoDialogUpload\').show()')),
//                        array('resource' => 'admin/estadoarchivos/reloadgrid', 'id' => 'estadoarchivosreloadGrid', 'label' => 'Actualizar Grid', 'param' => array('iconClass' => 'commonIcons dijitIconUndo', 'onClick' => 'reloadGrid("gridEstadoarchivos","estadoarchivosPaneGrid","admin/estadoarchivos",layoutEstadoarchivos)')),
//                        array('resource' => 'admin/estadoarchivos/readfile', 'id' => 'estadoarchivosreadfileGrid', 'label' => 'Procesar Archivos', 'param' => array('iconClass' => 'commonIcons dijitIconDocuments', 'onClick' => 'xhrPostData("admin/estadoarchivos/readfile","{A&M#N*}","admin/estadoarchivos","gridEstadoarchivos",layoutEstadoarchivos,"estadoarchivosPaneGrid")')),
//                    ),
//                    'contentPaneGrid' => array(
//                        'id' => 'estadoarchivosPaneGrid',
//                        'resource' => 'admin/estadoarchivos/index',
//                        'value' => '',
//                        'params' => array(),
//                        'url' => 'admin/estadoarchivos',
//                        'layout' => array(
//                            array('field' => 'id', 'name' => 'Id', 'width' => '50px'),
//                            array('field' => 'concepto', 'name' => 'Concepto', 'width' => '200px'),
//                            array('field' => 'alias', 'name' => 'Nombre de Archivo', 'width' => '200px'),
//                            array('field' => 'estado', 'name' => 'Estado', 'width' => '50px'),
//                            array('field' => 'fupload', 'name' => 'Cargado', 'width' => '150px'),
//                            array('field' => 'fprocc', 'name' => 'Procesado', 'width' => '150px'),
//                            array('field' => 'username', 'name' => 'username', 'width' => '130px')
//                        )
//                    )
//                ),
//                array(
//                    'resource' => 'admin/bandeja/index',
//                    'contentPane' => array(
//                        'id' => 'bandejaContentPane',
//                        'params' => array('title' => 'Bandeja de Mensajes'),
//                        'attribs' => array()
//                    ),
//                    'toolBar' => array(
//                        'id' => 'bandejaToolBar',
//                        'params' => array('dojoType' => 'dijit.Toolbar', 'region' => 'top'),
//                        'attribs' => array()
//                    ),
//                    'Bottons' => array(
//                        array('resource' => 'admin/bandeja/findid', 'id' => 'bandejaVer', 'label' => 'Ver Mensaje', 'param' => array('iconClass' => 'commonIcons dijitIconMail', 'onClick' => 'sendUpdate("gridBandeja","adminNewMainDialogBandeja","admin/bandeja/findid","bandeja",layoutBandeja)')),
//                        array('resource' => 'admin/bandeja/reloadGrid', 'id' => 'bandejareloadGrid', 'label' => 'Actualizar Grid', 'param' => array('iconClass' => 'commonIcons dijitIconUndo', 'onClick' => 'reloadGrid("gridBandeja","bandejaPaneGrid","admin/bandeja",layoutBandeja2)')),
//                    ),
//                    'contentPaneGrid' => array(
//                        'id' => 'bandejaPaneGrid',
//                        'resource' => 'admin/bandeja/index',
//                        'value' => '',
//                        'params' => array(),
//                        'url' => 'admin/bandeja',
//                        'layout' => array(
//                            array('field' => 'id', 'name' => 'ID', 'width' => '50px'),
//                            array('field' => 'asunto', 'name' => 'Asunto:', 'width' => '200px'),
//                            array('field' => 'fecha', 'name' => 'Fecha', 'width' => '200px'),
//                        )
//                    )
//                ),
            )
        );
    }

}
