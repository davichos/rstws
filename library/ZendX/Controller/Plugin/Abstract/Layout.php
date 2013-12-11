<?php

class ZendX_Controller_Plugin_Abstract_Layout extends Zend_Layout_Controller_Plugin_Layout {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        $layout = $this->getLayout();
        $filename = $layout->getLayoutPath() . '/' . $request->getModuleName() . '/' . $request->getModuleName() . '.' . $layout->getViewSuffix();
        //check if the layout template exists, if not use the default layout set in application.ini
        if (file_exists($filename)) {
            $this->getLayout()->setLayoutPath($layout->getLayoutPath() . '/'.$request->getModuleName() . '/');
            $this->getLayout()->setLayout($request->getModuleName());
        }
    }

}