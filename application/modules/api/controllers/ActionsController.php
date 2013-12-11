<?php

/**
 *  Sample Foo Resource
 */
class Api_ActionsController extends REST_Controller {

    /**
     * The index action handles index/list requests; it should respond with a
     * list of the requested resources.
     */
    public function indexAction() {
        if ($this->getRequest()->isPost()) {
            $this->view->params = $this->getRequest()->getPost();
            $this->view->message = 'indexAction has been called.';
            $this->_response->ok();
        }
    }

    /**
     * The head action handles HEAD requests; it should respond with an
     * identical response to the one that would correspond to a GET request,
     * but without the response body.
     */
    public function headAction() {
        $this->view->message = 'headAction has been called';
        $this->_response->ok();
    }

    /**
     * The get action handles GET requests and receives an 'id' parameter; it
     * should respond with the server resource state of the resource identified
     * by the 'id' value.
     */
    public function getAction() {
        $token = $this->_getParam('token', 0);
        $id = $this->_getParam('id', 0);
        if (ZendX_Utilities_SecurityWSCheck::isValid($token)) {
            $this->view->id = $id;
            $this->view->message = sprintf('Resource #%s', $id);
            $this->_response->ok();
        } else {
            $this->view->message = sprintf('Forbidden', $id);
            $this->_response->forbidden();
        }
    }

    /**
     * The post action handles POST requests; it should accept and digest a
     * POSTed resource representation and persist the resource state.
     */
    public function postAction() {
        $error = true;
        $requestBody = $this->getRequest()->getRawBody();
        $json2array = $this->_helper->getHelper('Jsontoarray');
        $arreglo = $json2array->setJsontoarray($requestBody);
        if (key_exists('token', $arreglo)) {
            $token = $arreglo['token'];
            if (ZendX_Utilities_SecurityWSCheck::isValid($token)) {
                $this->view->message = 'Resource was Created';
                $this->_response->created();
                $error=FALSE;
            }
        }
        if ($error) {
            $this->view->message = 'Forbiden';
            $this->_response->created();
        }
    }

    /**
     * The put action handles PUT requests and receives an 'id' parameter; it
     * should update the server resource state of the resource identified by
     * the 'id' value.
     */
    public function putAction() {
        $token = $this->_getParam('token', 0);
        $id = $this->_getParam('id', 0);
        if (ZendX_Utilities_SecurityWSCheck::isValid($token)) {
            $id = $this->_getParam('id', 0);

            $this->view->id = $id;
            $this->view->params = $this->_request->getParams();
            $this->view->message = sprintf('Resource #%s was Updated', $id);
            $this->_response->ok();
        } else {
//            $this->view->message = sprintf('Forbidden', $id);
            $this->_response->forbidden();
        }
    }

    /**
     * The delete action handles DELETE requests and receives an 'id'
     * parameter; it should update the server resource state of the resource
     * identified by the 'id' value.
     */
    public function deleteAction() {
        $id = $this->_getParam('id', 0);
        $token = $this->_getParam('token', 0);
        if (ZendX_Utilities_SecurityWSCheck::isValid($token)) {
            $this->view->id = $id;
            $this->view->message = sprintf('Resource #%s was Deleted', $id);
            $this->_response->ok();
        } else {
            $this->view->message = sprintf('Forbidden', $id);
            $this->_response->forbidden();
        }
    }

    private function _getParams($request) {
        $arreglo = array();
        foreach ($request as $key => $value) {
            switch ($key) {
                case'module':
                case'controller':
                case'action':
                case'format':
                    break;
                default:
                    array_push($arreglo, $key);
                    break;
            }
        }
        return $arreglo;
    }

}
