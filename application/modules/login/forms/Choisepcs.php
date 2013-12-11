<?php

class Login_Form_Choisepcs extends Zend_Dojo_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	    	$this->setDecorators(array(
            'FormElements',
            array('ContentPane', array(
                'id' => 'contContainer',
                'style' => 'width: 280px; height: 150px;',
                'dijitParams' => array(
                ),
            )),
            'DijitForm',
        ));
        $datosForm	= new Zend_Dojo_Form_SubForm();
		$datosForm->addElement(
            'FilteringSelect',
            'resourcepcs',
	            array(
	                'label' 		=> 'Selecciona Programa Comercial',
	            	'storeId'     => 'stateStore',
	            	'storeType'   => 'dojo.data.ItemFileReadStore',
	               'storeParams' => array(
								            'url' => '',
								        ),
								        'dijitParams' => array(
								            'searchAttr' => 'name',
								        ),		        
	            )
        )
       ->addElement(
			    'SubmitButton',
			    'loginIni',
			    array(
			        'required'   => false,
			        'ignore'     => true,
			        'label'      => 'Ir a PCS',
			    	'region'	 =>	'right',
			    	'onsubmit'	 => 'setSing()',
			    )
	    );
	  	

        $this->addSubForm($datosForm,'choise');
    }


}

