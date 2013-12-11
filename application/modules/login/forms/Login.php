<?php

class Login_Form_Login extends Zend_Dojo_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */
        $this->setAttribs(array(
            'name' => 'login',
            'action' => 'login/index/sign',
            'method' => 'post',
        ));

        $datosForm = new Zend_Form_SubForm();
        $datosForm->addElement(
                        'text', 'username', array(
                    'value' => '',
                    'label' => 'Usuario',
                    'required' => true,
                    'trim' => true,
                    'propercase' => false,
                    'decorators' => $this->_getDecorators('username')
                        )
                )
                ->addElement(
                        'password', 'password', array(
                    'value' => '',
                    'label' => 'Contraseña',
                    'required' => true,
                    'trim' => true,
                    'propercase' => false,
                    'decorators' => $this->_getDecorators('password')
                        )
                )
                ->addElement(
                        'submit', 'loginIni', array(
                    'required' => false,
                    'ignore' => true,
                    'label' => 'Entrar',
                    'region' => 'right',
                    'onsubmit' => 'setSing()',
                        )
                )
                ->addElement(
                        'button', 'register', array(
                    'required' => false,
                    'ignore' => true,
                    'label' => 'Registrar',
                    'region' => 'left',
                    
                        )
        );


        $this->addSubForm($datosForm, 'loginN');
    }

    private function _getDecorators($element) {
        return array(
            'ViewHelper',
            // array('HtmlTag', array('tag' => 'div', 'class' => 'divInput' . $element)),
            // array('Label', array('tag' => 'div', 'tagClass' => 'labelSpan' . $element)),
            // array(array('div' => 'HtmlTag'), array('tag' => 'div', 'class' => 'divContenedor' . $element)));
		 
		 array('HtmlTag', array('tag' => 'div', 'class' => 'caja'.$element)),
         array('Label', array('tag' => 'div', 'tagClass' => 'etiqueta')),
         array(array('div' => 'HtmlTag'), array('tag' => 'div', 'class' => 'control-group'))
		 
		 );
			
    }

//    public function getErrorDecorators($element) {
//        return array(
//            'ViewHelper',
//            array('HtmlTag', array('tag' => 'div', 'class' => 'divInput' . $element)),
//            array('Label', array('tag' => 'div', 'tagClass' => 'labelSpan' . $element)),
//            array(array('div' => 'HtmlTag'), array('tag' => 'div', 'class' => 'divError')));
//    }
    /*
      $datosForm = new Zend_Dojo_Form_SubForm();
      $datosForm->addElement(
      'ValidationTextBox', 'username', array(
      'value' => '',
      'label' => 'Usuario',
      'required' => true,
      'trim' => true,
      'propercase' => false,
      )
      )
      ->addElement(
      'PasswordTextBox', 'password', array(
      'value' => '',
      'label' => 'Password',
      'required' => true,
      'trim' => true,
      'propercase' => false,
      )
      )
      ->addElement(
      'SubmitButton', 'loginIni', array(
      'required' => false,
      'ignore' => true,
      'label' => 'Iniciar Sesion',
      'region' => 'right',
      'onsubmit' => 'setSing()',
      )
      );


      $this->addSubForm($datosForm, 'loginN');
      }
     */
}
