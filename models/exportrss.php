<?php
/*------------------------------------------------------------------------
# VirtuePort
# ------------------------------------------------------------------------
# Copyright (C) 2011 Francesco Tacconi. All Rights Reserved.
# Website: http://www.francescotacconi.it
-------------------------------------------------------------------------*/
// no direct access

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class VirtuePortModelexportrss extends JModel
{  

 function __construct() {
		parent::__construct();
	
    }
	
	
	function html2txt($document){
     $search = array('@<script[^>]*?>.*?</script>@si', 
     '@<style[^>]*?>.*?</style>@siU', 
     '@<[?]php[^>].*?[?]>@si',
     '@<[?][^>].*?[?]>@si', 
     '@<[\/\!]*?[^<>]*?>@si', 
	 '@<![\s\S]*?--[ \t\n\r]*>@',            
     '@([\r\n])[\s]+@',                
     '@&(quot|#34);@i',               
     '@&(amp|#38);@i',
     '@&(lt|#60);@i',
     '@&(gt|#62);@i',
     '@&(nbsp|#160);@i',
     '@&(iexcl|#161);@i',
     '@&(cent|#162);@i',
     '@&(pound|#163);@i',
     '@&(copy|#169);@i',
     '@&#(\d+);@e'  
     );
	 $text = preg_replace($search, '', $document);
	
     return $text;
	 }
	
	function getampers($document){
	 $text = preg_replace('#&#', 'et', $document);
	
     return $text;
	
	
	}

	function getexportxml(){
		global $mainframe;
	
	define('URLSITE',dirname(JURI::base()),true);
	
	$dbs	=& JFactory::getDBO();
	$sqls= ' SELECT * From #__virtueport_config where id=\'1\' ';
	$dbs->setQuery($sqls);
	$results=$dbs->loadRow();
		$sitenameS=$results['1'];
		$descS=$results['2'];
		$path_parts = $_SERVER['DOCUMENT_ROOT'];
		$url_site = $_SERVER['HTTP_HOST'];	
		
		// Endroit où générer le fichier
			$generate_file_path = $path_parts.'/xml_exports/googleshopping.xml';
			@mkdir($path_parts.'/xml_exports/', 0755, true);
			@chmod($path_parts.'/xml_exports', 0755);
		
		

		//Google XML
		$xml  = '<?xml version="1.0" encoding="UTF-8" ?>'."\n";
		$xml .= '<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0" encoding="UTF-8" >'."\n";
		$xml .= '<channel>'."\n";
		$xml .= '<title>Google Base feed for '.$sitenameS.'</title>'."\n";
		$xml .= '<link>'.$url_site.'</link>'."\n";
		$xml .= '<description>'.$descS.'</description>'."\n";
		
		$db	=& JFactory::getDBO();
		
		$sql  = " SELECT DISTINCT * ";
		
		$sql .= " FROM #__vm_product ";
		
		$sql .=" LEFT JOIN #__vm_product_mf_xref ON #__vm_product_mf_xref.product_id = #__vm_product.product_id ";
		$sql .=" LEFT JOIN #__vm_manufacturer  ON #__vm_product_mf_xref.manufacturer_id = #__vm_manufacturer.manufacturer_id ";
		$sql .=" LEFT JOIN #__vm_product_price  ON #__vm_product_price.product_id = #__vm_product.product_id ";
		$sql .=" LEFT JOIN #__vm_tax_rate ON #__vm_tax_rate.tax_rate_id = #__vm_product.product_tax_id ";
		$sql .=" where product_publish= \"Y\" and product_price IS NOT NULL";
		
		//$sql .=" and product_in_stock>0 "; 
		
		$db->setQuery($sql);
		$products=$db->loadRowList();
		

	
		if(empty($products)){die('Echec ...');}
		
		
		
		$title_limit = 70;
		$description_limit = 300;//10000 default

		foreach($products as $product)
		{ 
			if($product['59']>0){
			$price=round(100*(($product['45']*$product['59'])+$product['45']))/100;}
			else
			{
			$price=round($product['45']);
			}

			$title_max = $product['24'];
			if(strlen($product['24']) > $title_limit)
			{
			$title_max = substr($title_max, 0, ($title_limit-1));
			$title_max = substr($title_max, 0, strrpos($title_max," "));
			}
			
			
				$description_max = $this->html2txt($product['5']);
			
			if(strlen($description_max) > $description_limit)
			{
			$description_max = strip_tags(substr($description_max, 0, ($description_limit-1)));
			$description_max = substr($description_max, 0, strrpos($description_max," "));
			}
			if(strlen($description_max)<15)
			{
			$description_max=$product['24'].' de '.$product['38'];
			}
			$xml .= '<item>'."\n";
			$xml .= '<g:id>'. $product['3'].'</g:id>'."\n";
			$xml .= '<title>'.htmlspecialchars($title_max).'</title>'."\n";
			$xml .= '<g:description>'.trim($description_max).'</g:description>'."\n";
			$xml .= '<g:price>'.$price.' EURO</g:price>'."\n";
		
			$xml .= '<g:condition>new</g:condition>'."\n"; 
			$xml .= '<g:image_link>'.URLSITE.'/components/com_virtuemart/shop_image/product/'.$product['6'].'</g:image_link>'."\n";
			
			// Quantité
	
			if($results['4'] != '0')
			{
				$xml .= '<g:quantity>'.$product['16'].'</g:quantity>'."\n";
			}

			// Marque
			if($results['3'] != '0')
			{
				$xml .= '<g:brand>'.htmlspecialchars($product['38']).'</g:brand>'."\n";
			}
				
			$dbcat	=& JFactory::getDBO();
			$sql2  = "SELECT category_name,category_flypage FROM #__vm_category ";
			$sql2 .= " LEFT JOIN #__vm_product_category_xref ON #__vm_category.category_id=#__vm_product_category_xref.category_id ";
			$sql2 .= " WHERE #__vm_product_category_xref.product_id='".$product['0']."' ";
			$dbcat->setQuery($sql2);
			$cat=$dbcat->loadRow();
			//if(empty($cat)){die('Echec f...');}
			$categorie=$cat['0'];
			$flypage=$cat['1'];
			$xml .= '<link>'. URLSITE.'/index.php?page=shop.product_details&amp;flypage=shop.flypage='.$flypage.'&amp;product_id='.$product['0'].'&amp;option=com_virtuemart&amp;Itemid=29.</link>'."\n";
			//Category
		
			if($results['5'] != '0')
			{
			$xml .= '<g:product_type>'.htmlspecialchars($this->getampers($categorie)).'</g:product_type>'."\n";
			}
			$xml .= '</item>'."\n";
			}
			$xml .= '</channel>';
	
			$xml .= '</rss>';
		
			$googleshoppingfile = fopen($generate_file_path,'w');
			fwrite($googleshoppingfile, $xml);
			fclose($googleshoppingfile);

			@chmod($generate_file_path, 0777);
			
			echo $generate_file_path;

			
		
	}

}
    


?>