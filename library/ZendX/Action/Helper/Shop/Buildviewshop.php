<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class ZendX_Action_Helper_Shop_Buildviewshop extends 
Zend_Controller_Action_Helper_Abstract {
    protected $_arraymodules;

    public function getArraymodules() {
        $this->_setArraymodules();
        return $this->_arraymodules;
    }

    private function _setArraymodules() {

        $this->_arraymodules = array(
            'mainContentPane' => array(
                'id' => 'shopMainContentPane',
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
                'id' => 'shopMainTabContainer',
                'content' => '',
                'params' => array('region' => 'center'),
                'attribs' => array()
            ),
            'mainDialog' => array(array(
                    'id' => 'shopNewTemplateMainDialog',
                    'value' =>'',
                    'params' => array('dojoType' => 'dijit.Dialog', 'title' => 'Nuevo Producto'),
                    'attribs' => array()
                )
            ),
            'tabs' => array(
                array(
                    'resource' => 'shop/product/index',
                    'contentPane' => array(
                        'id' => 'productContentPane',
                        'params' => array('title' => 'Productos'),
                        'attribs' => array()
                    ),
                    'toolBar' => array(
                        'id' => 'productToolBar',
                        'params' => array('dojoType' => 'dijit.Toolbar', 'region' => 'top'),
                        'attribs' => array()
                    ),
                    'Bottons' => array(
                        array('resource' => 'shop/product/write', 'id' => 'productNew', 'label' => 'Nuevo', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconNewPage', 'onClick' => 'dijit.byId(\'shopNewTemplateMainDialogModproductos\').show()')),
                        array('resource' => 'shop/product/update', 'id' => 'productEdit', 'label' => 'Editar', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconPaste')),
                        array('resource' => 'shop/product/download', 'id' => 'productDownload', 'label' => 'Descargar', 'param' => array('iconClass' => 'commonIcons dijitIconConnector', 'onClick' => 'getDescargaPorMod("product")')),
                        array('resource' => 'shop/product/upload', 'id' => 'productUpload', 'label' => 'Cargar', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconInsertTable', 'onClick' => 'dijit.byId(\'shopMainDialogFuerventmyupload\').show()')),
                        array('resource' => '', 'id' => 'productFilter', 'label' => 'Filtros Avanzados', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconTabIndent', 'onClick' => 'dijit.byId(\'adminFilterMainDialog\').show()')),
                        array('resource' => 'shop/product/exportexcel', 'id' => 'productExportexcel', 'label' => 'Exportar a Excel', 'param' => array('iconClass' => 'dijitEditorIcon dijitEditorIconInsertTable', 'onClick' => 'getExcelExporter("gridproduct","product")')),
                        array('resource' => 'shop/product/reloadGrid', 'id' => 'productreloadGrid', 'label' => 'Actualizar Grid', 'param' => array('iconClass' => 'commonIcons dijitIconUndo', 'onClick' => 'reloadGrid("gridproduct","productPaneGrid","shop/product",layoutproduct)')),
                        array('resource' => 'shop/product/getpaginas', 'id' => 'productchangePage', 'label' => 'Ir a página', 'param' => array('iconClass' => 'commonIcons dijitIconDatabase', 'onClick' => 'sendPages("shopTemplateMainDialogfvPages","shop/product/getpaginas","Paginacionfv-paginastotales")')),
                        array('resource' => 'shop/product/filtroavanzado', 'id' => 'productAutAva', 'label' => 'Filtro Avanzado', 'param' => array('iconClass' => 'commonIcons dijitIconEditTask', 'onClick' => 'dijit.byId(\'shopFiltroaAvanMainDialogproduct\').show()')),
                    ),
                    'contentPaneGrid' => array(
                        'id' => 'productPaneGrid',
                        'resource' => 'shop/product/index',
                        'value' => '',
                        'params' => array(),
                        'url' => 'shop/product',
                        'layout' => array(
                            array('field' => 'id', 'name' => 'Id', 'width' => '50px'),
                            array('field' => 'sku', 'name' => 'SKU', 'width' => '50px'),
                            array('field' => 'nombre', 'name' => 'Nombre Articulo', 'width' => '150px'),
                            array('field' => 'descripcion', 'name' => 'Descripcion', 'width' => '350px'),
                            array('field' => 'precio', 'name' => 'Precio', 'width' => '50px')
                        )
                    )
                )
            )
        );
    }

    
}
