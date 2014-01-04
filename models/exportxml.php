<?php

/*------------------------------------------------------------------------
# VirtuePort
# ------------------------------------------------------------------------
# Copyright (C) 2011 Francesco Tacconi. All Rights Reserved.
# Website: http://www.francescotacconi.it
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted access');

// Import Joomla! libraries
jimport('joomla.application.component.model');

class VirtuePortModelexportxml extends JModel {
    function __construct() {
		parent::__construct();
    }
	function html2txt($document){
     $search = array('@<script[^>]*?>.*?</script>@si',
     '@<style[^>]*?>.*?</style>@siU', 
     '@<[?]php[^>].*?[?]>@si', 
     '@<[?][^>].*?[?]>@si', 
     '@<[\/\!]*?[^<>]*?>@si', 
     '@<![\s\S]*?--[ \t\n\r]*>@' 
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
	
		$url_site = $_SERVER['HTTP_HOST'];	
						
		//Google XML
		$xml  = '<?xml version="1.0" encoding="UTF-8" ?>'."\n";
		$xml .= '<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0" encoding="UTF-8" >'."\n";
		$xml .= '<channel>'."\n";
		$xml .= '<title>Google Base feed for '.$sitenameS.'</title>'."\n";
		$xml .= '<link>'.$url_site.'</link>'."\n";
		$xml .= '<description>'.$descS.'</description>'."\n";
		
		$db	=& JFactory::getDBO();
		$sql  = " SELECT DISTINCT * ";//p.product_id as pid, p.product_sku as sku, p.product_name as name, p.product_description as desc, pp.product_price as price, m.mf_name as mfname, ";
		
		//$sql .= " t.tax_rate as tr,p.product_quantity as qty,p.product_thumb_image as thumb ";
		
		$sql .= " FROM #__vm_product ";
		
		$sql .=" LEFT JOIN #__vm_product_mf_xref ON #__vm_product_mf_xref.product_id = #__vm_product.product_id ";
		$sql .=" LEFT JOIN #__vm_manufacturer  ON #__vm_product_mf_xref.manufacturer_id = #__vm_manufacturer.manufacturer_id ";
		$sql .=" LEFT JOIN #__vm_product_price  ON #__vm_product_price.product_id = #__vm_product.product_id ";
		$sql .=" LEFT JOIN #__vm_tax_rate ON #__vm_tax_rate.tax_rate_id = #__vm_product.product_tax_id ";
		$sql .=" where product_publish= \"Y\" and product_price IS NOT NULL";
		
		//$sql .=" and product_in_stock>0 "; 
		$db->setQuery($sql);
		//$products=$db->loadRowList();
		$products=$db->loadAssocList();
		

	
		if(empty($products)){die('Echec ...');}
		
		if(!isset($product['6'])){$product['6']=10;}
		
		$title_limit = 70;
		$description_limit = 300;//10000 default
		//dump($products, 'Prodotti');
		//print_r($products);
		foreach($products as $product)
		{ 
			if($product['tax_rate']>0){
				$price=round(100*(($product['product_price']*$product['tax_rate'])+$product['product_price']))/100;
			} else {
				$price=round($product['product_price']);
			}

			$title_max = $product['product_name'];
			if(strlen($product['product_name']) > $title_limit) {
				$title_max = substr($title_max, 0, ($title_limit-1));
				$title_max = substr($title_max, 0, strrpos($title_max," "));
			}
			
			$description_max = $this->html2txt($product['product_desc']);
			
			if(strlen($description_max) > $description_limit) {
				$description_max = strip_tags(substr($description_max, 0, ($description_limit-1)));
				$description_max = substr($description_max, 0, strrpos($description_max," "));
			}
			if(strlen($description_max)<15) {
				$description_max=$product['product_name'] .' de '.$product['mf_name'];
			}
			$xml .= '<item>'."\n";
			$xml .= '<g:id>'. $product['product_sku'].'</g:id>'."\n";
			$xml .= '<title>'.htmlspecialchars($title_max).'</title>'."\n";
			$xml .= '<g:description>'.trim($description_max).'</g:description>'."\n";
			$xml .= '<g:price>'.$price.' EURO</g:price>'."\n";
		
			$xml .= '<g:condition>new</g:condition>'."\n"; 
			$xml .= '<g:image_link>'.URLSITE.'/components/com_virtuemart/shop_image/product/'.$product['product_full_image'].'</g:image_link>'."\n";
			
			// Quantità
	
			if($results['4'] != '0')
			{
				$xml .= '<g:quantity>'.$product['16'].'</g:quantity>'."\n";
			}

			// Risultati
			if($results['3'] != '0')
			{
				$xml .= '<g:brand>'.htmlspecialchars($product['38']).'</g:brand>'."\n";
			}
		
			
			$dbcat	=& JFactory::getDBO();
			$sql2  = "SELECT category_name,category_flypage FROM #__vm_category ";
			$sql2 .= " LEFT JOIN #__vm_product_category_xref ON #__vm_category.category_id=#__vm_product_category_xref.category_id ";
			$sql2 .= " WHERE #__vm_product_category_xref.product_id='".$product['product_id']."' ";
			$dbcat->setQuery($sql2);
			$cat=$dbcat->loadRow();
			//if(empty($cat)){die('Echec f...');}
			$categorie=$cat['0'];
			$flypage=$cat['1'];
			$xml .= '<link>'. URLSITE.'/index.php?page=shop.product_details&amp;flypage=shop.flypage='.$flypage.'&amp;product_id='.$product['product_id'].'&amp;option=com_virtuemart&amp;Itemid=29.</link>'."\n";
			//Categorie
			
			if($results['5'] != '0')
			{
			$xml .= '<g:product_type>'.htmlspecialchars($this->getampers($categorie)).'</g:product_type>'."\n";
			}
			$xml .= '</item>'."\n";
			}
			$xml .= '</channel>';
			$xml .= '</rss>';
			
			Header("content-type: application/xml");
			header("Content-disposition: attachment; filename=VirtuePort.xml");
	
			print $xml;
			exit;
		
	}


	
}
?>