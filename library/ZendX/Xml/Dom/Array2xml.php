<?php
class ZendX_Xml_Dom_Array2xml
{
	protected $_arreglo;
	protected $_xml;
	protected $_xmlfinal;
	protected $_pathxml;
	protected $_nameattrib;
	protected $_attrib;
	
	public function setArreglo($arreglo)
	{
		$this->_arreglo = $arreglo;	
	}
	public function getArreglo()
	{
		return $this->_arreglo;
	}
	public function setPathxml($path='/')
	{
		$this->_pathxml = $path;
	}
	public function setNameattrib($nameattrib)
	{
		$this->_nameattrib = $nameattrib;
	}
	public function setAttrib($attrib)
	{
		$this->_attrib = $attrib;
	}
	public function getXml()
	{
		$header = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?><files>";
		$footer = "</files>";
		$att	= $this->_nameattrib.'="'.$this->_attrib.'"';
		$file   = '<file '.$att.'>';
		$fileSlash="</file>";
		
		$this->_xmlfinal .= $header;
		$this->_xmlfinal .= $file;
		$this->_xmlfinal .= $this->_xml;
		$this->_xmlfinal .= $fileSlash;
		$this->_xmlfinal .= $footer;
		return $this->_xmlfinal;
	}
	public function arr2xml()
	{
		$this->array = $this->_arreglo;		
		if(is_array($array) && count($array) > 0)
		{
			$this->buildXml($this->_arreglo);
		}
		else
		{
			$this->_xml .= "no data";
		}
	}
	
	public function buildXml($arreglo)
	{
		foreach($array as $k=>$v)
		{
			if(is_array($v))
			{
				$tag = preg_replace('/[0-9]{1,}/', 'data',$k);
				$this->buildXml($v);
				$this->_xml .= "</$tag>";
			}
			else
			{
				$tag = preg_replace('/[0-9]{1,}/','data',$k);
				$this->_xml .= "<$tag>$v</$tag>";
			}
		}
	}
	
	public function writeXml($filename='')
	{
		$file = $this->_pathxml.$filename.'.xml';
		$fp = fopen($file, "a+");
		$string = $this->getXml();
		$write = fputs($fp, $string);
		fclose($fp);
	}
	
}