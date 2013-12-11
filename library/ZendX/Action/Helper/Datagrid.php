<?php
class ZendX_Action_Helper_Datagrid extends Zend_Controller_Action_Helper_Abstract
{	

	protected $_Idgridiv;
	
	
	private function _setItemfilewritestore($id=null,$url=null)
	{
		$script						= ' var store'.$id.' = new dojo.data.ItemFileWriteStore({url: "'.$url.'"});';
		return $script;
	}
	
	private function _setLayoutgrid($id=null,$layout)
	{	
		$layoutElements ='var layout'.$id.' = [[';
		foreach ($layout as $items)
		{
			$layoutElements .= "{field:'".$items['field']."',";
			$layoutElements .= "name:'".$items['name']."',";
			$layoutElements .= "width:'".$items['width']."'},";			
		}
		$layoutElements = substr($layoutElements,0,-1);
		$layoutElements .= ']];';
		return $layoutElements;
		
	}
	
	private function _setEnhancedgrid($id=null,$idgridiv=null)
	{
		$enhancedgrid		= " var grid".$id."=new dojox.grid.EnhancedGrid({id:'grid".$id."',";
		$enhancedgrid	   .= "store:store".$id.",structure:layout".$id.",rowSelector:'20px',";
		$enhancedgrid	   .= "plugins:{pagination:{pageSizes:[''],description:true,sizeSwitch:";
		$enhancedgrid	   .= "true,pageStepper:true,gotoButton:true,maxPageStep:4,position:'top'},";
		$enhancedgrid	   .= "filter:{itemsName:'id',closeFilterbarButton:true,ruleCount:9}}},";
   		$enhancedgrid	   .= "document.createElement('div'));dojo.byId('".$idgridiv."').appendChild(grid".$id.".domNode);grid".$id.".startup();";    
		return $enhancedgrid;
	}
	
	public function setIddivgrid($iddivgrid)
	{	
		
		
		$arregloidgrid = array();
		foreach ($iddivgrid as $items)
		{
			$arregloidgrid[]= array(
									'id'=>$items['contentPaneGrid']['id'],
									'url'=>$items['contentPaneGrid']['url'],
									'layout'=>$items['contentPaneGrid']['layout']
									);
		}
		$this->_Idgridiv = $arregloidgrid;
	}
	
	public function getScript()
	{
		$script='';
		
		foreach ($this->_Idgridiv as $items){
			$ids=preg_split('/[A-Z]/',$items['id']);
			$id = ucfirst($ids[0]);
			$script	.= $this->_setItemfilewritestore($id,$items['url']);
			$script	.= $this->_setLayoutgrid($id,$items['layout']);			
			$script	.= $this->_setEnhancedgrid($id,$items['id']);
				
		}
		
		return 'function(){'.$script.'}';
	}
	
}