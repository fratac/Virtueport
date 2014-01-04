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


	if (file_exists(JPATH_SITE.DS.'administrator/components/com_virtuemart/virtuemart.cfg.php') === true) {
			require_once JPATH_SITE.DS.'administrator/components/com_virtuemart/virtuemart.cfg.php';
                        //print CLASSPATH;
                        //require_once JPATH_SITE.DS.'administrator/components/com_virtuemart/global.php';
	}else {
                print 'You have to install virtueMart component!';
                exit;
		//throw new Exception('You have to install virtueMart component!');
	}


class VirtuePortModelexportebay extends JModel {

//protected $db;
    function __construct() {
		//$this->db =& JFactory::getDBO();
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
	 $text = preg_replace("/\n", "", $text);
     return $text;
 }
 
	function stripArgumentFromTags( $htmlString ) {

	$regEx = '/([^<]*<\s*[a-z](?:[0-9]|[a-z]{0,9}))(?:(?:\s*[a-z\-]{2,14}\s*=\s*(?:"[^"]*"|\'[^\']*\'))*)(\s*\/?>[^<]*)/i'; // match any start tag
	$chunks = preg_split($regEx, $htmlString, -1,  PREG_SPLIT_DELIM_CAPTURE);
        $chunkCount = count($chunks);
	$strippedString = '';

        for ($n = 1; $n < $chunkCount; $n++) {
		$strippedString .= $chunks[$n];
	}
	
	return $strippedString;
}
 
 function changeAccented($text) {
	 /*
	 $replace = array(
	 "ï¿½ " => "ï¿½", "Å¡" => "ï¿½", "ï¿½'" => "ï¿½", "ï¿½" => "ï¿½",
	 "Å¸" => "ï¿½", "Ã¿" => "ï¿½", "Ã€" => "ï¿½", "ï¿½ " => "ï¿½",
	 "Ã" => "ï¿½", "Ã¡" => "ï¿½", "Ã‚" => "ï¿½", "Ã¢" => "ï¿½",
	 "Ãƒ" => "ï¿½", "Ã£" => "ï¿½", "Ã„" => "ï¿½", "Ã¤" => "ï¿½",
	 "Ã…" => "ï¿½", "Ã¥" => "ï¿½", "Ã†" => "ï¿½", "Ã¦" => "ï¿½",
	 "Ã‡" => "ï¿½", "Ã§" => "ï¿½", "Ãˆ" => "ï¿½", "Ã¨" => "ï¿½",
	 "Ã‰" => "ï¿½", "Ã©" => "ï¿½", "ÃŠ" => "ï¿½", "Ãª" => "ï¿½",
	 "Ã‹" => "ï¿½", "Ã«" => "ï¿½", "ÃŒ" => "ï¿½", "Ã¬" => "ï¿½",
	 "Ã" => "ï¿½", "Ã­" => "ï¿½", "ÃŽ" => "ï¿½", "Ã®" => "ï¿½",
	 "Ã" => "ï¿½", "Ã¯" => "ï¿½", "Ã" => "ï¿½", "Ã°" => "ï¿½",
	 "ï¿½'" => "ï¿½", "Ã±" => "ï¿½", "ï¿½'" => "ï¿½", "Ã²" => "ï¿½",
	 "ï¿½" => "ï¿½", "Ã³" => "ï¿½", "ï¿½" => "ï¿½", "Ã´" => "ï¿½",
	 "Ã•" => "ï¿½", "Ãµ" => "ï¿½", "Ã–" => "ï¿½", "Ã˜" => "ï¿½",
	 "Ã¸" => "ï¿½", "Ã™" => "ï¿½", "Ã¹" => "ï¿½", "Ãš" => "ï¿½",
	 "Ãº" => "ï¿½", "Ã›" => "ï¿½", "Ã»" => "ï¿½", "Ãœ" => "ï¿½",
	 "Ã¼" => "ï¿½", "Ã" => "ï¿½", "Ã½" => "ï¿½", "Ãž" => "ï¿½",
	 "Ã¾" => "ï¿½", "ÃŸ" => "ï¿½", "Ã¶" => "ï¿½","Ô´"=>"ï¿½",
	 "ï¿½"=>"ï¿½","ï¿½Â©"=>"ï¿½","Ã©"=>"ï¿½","ï¿½Â”"=>"ï¿½"
	 ,"ï¿½Æ’ï¿½Â©"=>"ï¿½","ÃƒÂ«"=>"ï¿½","ï¿½Â¢"=>"ï¿½","HÃ´teliÃ©res"=>"Hï¿½teliï¿½res"
	 ,"ZAï¿½?RE"=>"ZAIRE","Ã©"=>"ï¿½","ï¿½"=>"u","ï¿½"=>"-","Â²"=>"ï¿½","Â«" => "ï¿½","Â»" => "ï¿½"
	 );
	*/
	//"â€™"=>"'"
	
	 //foreach($replace as $key => $val)
	 //$text = str_replace($key, $val, $text);
	 
         //$text = iconv('UTF-8','ASCII//TRANSLIT',$text);
         
	 return $text;
} 
 
 
	function getampers($document){
	 $text = preg_replace('#&#', 'et', $document);
	
     return $text;
	
	}
	
	function strwrap($str, $width, $break=' ')
	{
            if (strlen($str) <= $width) {
            return $str;
        }
            $return = '';
            $str = substr($str, 0, $width);
            $end = strripos($str, $break);
            if ($end === false) {
                    $return = $str;
            } else {
                    $return = substr($str, 0, $end);
            } 

        return $return;
	}
	
	function getexportebay(){
	//global $mainframe;
            
	$subtitle_export = false; //Se true esporta sottotitolo, campo a pagamento
	$product_discount_export = false; // se true esporta con eventuale prezzo scontato
	
	$auth = $_SESSION['auth'];
	//$tpl = new $GLOBALS['VM_THEMECLASS']();
	
	define('URLSITE',dirname(JURI::base()),true);
	
	$filename = 'virtueport_ebay.csv';
        
	/*
	$dbs	=& JFactory::getDBO();
	$sqls= ' SELECT * From #__virtueport_config where id=\'1\' ';
	$dbs->setQuery($sqls);
	$results=$dbs->loadRow();
        
		$sitenameS=$results['1'];
		$descS=$results['2'];
         * 
         */
		
                $url_site = $_SERVER['HTTP_HOST'];	
						
		//Ebay
		$xml  ='Action;Category;StoreCategory;CustomLabel;Title;';
		if ($subtitle_export) {
			$xml .= 'Subtitle;';
		}
		$xml .= 'Description;ConditionID;PicURL;Quantity;Format;StartPrice;Duration;ImmediatePayRequired;Location;PayPalAccepted;PayPalEmailAddress;';
		$xml .= 'ShippingService-1:Option;ShippingService-1:Cost;DispatchTimeMax;ReturnsAcceptedOption;HitCounter'."\n";
		
                $db	=& JFactory::getDBO();
		$sql  = " SELECT DISTINCT * ";//p.product_id as pid, p.product_sku as sku, p.product_name as name, p.product_description as desc, pp.product_price as price, m.mf_name as mfname, ";
		//$sql .= " t.tax_rate as tr,p.product_quantity as qty,p.product_thumb_image as thumb ";
		
		$sql .= " FROM #__vm_product ";
		$sql .=" LEFT JOIN #__vm_product_mf_xref ON #__vm_product_mf_xref.product_id = #__vm_product.product_id ";
		$sql .=" LEFT JOIN #__vm_manufacturer  ON #__vm_product_mf_xref.manufacturer_id = #__vm_manufacturer.manufacturer_id ";
		$sql .=" LEFT JOIN #__vm_product_price  ON #__vm_product_price.product_id = #__vm_product.product_id ";
		$sql .=" LEFT JOIN #__vm_tax_rate ON #__vm_tax_rate.tax_rate_id = #__vm_product.product_tax_id ";
		$sql .=" LEFT JOIN #__vm_product_category_xref ON #__vm_product_category_xref.product_id = #__vm_product.product_id ";
		$sql .=" LEFT JOIN #__vp_export_cat ON #__vp_export_cat.vp_virtuemart_cat = #__vm_product_category_xref.category_id ";
		$sql .=" where product_publish= \"Y\" and product_price IS NOT NULL AND vp_export_cat IS NOT NULL";
		//$sql .=" and product_in_stock>0 "; 
                //print $sql .' ';
		$db->setQuery($sql);
		//$products=$db->loadRowList();
		$products=$db->loadAssocList();
	
		if(empty($products)){die('Echec ...');}
		
		//if(!isset($product['6'])){$product['6']=10;}
		$title_limit = 80;
		$subtitle_limit = 55;
		$description_limit = 5000;//10000 default
		//dump($products, 'Prodotti');
		//print_r($products);
		foreach($products as $product)
		{ 
        //print $product['product_name'].'<br> ';
			//dump($product, 'product');
			$urlProd = URLSITE . '/index.php?page=shop.product_details&amp;flypage=shop.flypage'.$flypage.'&amp;product_id='.$product['product_id'].'&amp;option=com_virtuemart&amp;Itemid=29';
			$price = '';
			
			$my_taxrate = $product['tax_rate'];
			$my_taxrate_int = my_taxrate * 100;
			//dump($my_taxrate, 'my_taxrate');
			
        //print $my_taxrate.'<br>';
			//$base_price = $GLOBALS['CURRENCY']->convert( $product['product_price'], $product['product_currency'] );
			//$base_price = $GLOBALS['CURRENCY']->convert( $product['product_price'] );
                        $base_price = $product['product_price'];
        //print $base_price.'<br>';
			$priceprod = $base_price;

                        /*
			if($product['tax_rate'] > 0){
				//$pricer=round(100*(($product['product_price']*$product['tax_rate'])+$product['product_price']))/100;
				$pricer=100*(($product['product_price']*$my_taxrate)+$product['product_price'])/100;
			} else {
				$pricer=round($product['product_price'],2);
			}
			*/
			//dump($pricer, 'pricer');
			
			$product_discount = $this->getDiscount($product['product_discount_id']);
			$product_discount_amount = $product_discount->amount;
                        $product_discount_is_percent = $product_discount->is_percent;
			
			//if( !$product_discount_is_percent && $product_discount_amount != 0 ) {
			//	$product_discount_amount = $GLOBALS['CURRENCY']->convert($product_discount_amount);
			//}
			if ($auth["show_price_including_tax"] == 1) {
				//$my_taxrate = $this->get_product_taxrate($product_id);
				$base_price += ($my_taxrate * $base_price);
			} else {
				$my_taxrate = 0;
			}
			//print 'calc discount '.'<br> ';
			// Calculate discount
			$discount = 0;
			if( $product_discount_export ) {
				if( $product_discount_amount != 0) {
                                        //print 'discount > 0 ';
					$undiscounted_price = $base_price;
					$discount = 1;
					switch( $product_discount_is_percent ) {
						case 0:
							// If we subtract discounts BEFORE tax
							$discount = 2;
							if( PAYMENT_DISCOUNT_BEFORE == '1' ) {
								// and if our prices are shown with tax
								if( $auth["show_price_including_tax"] == 1) {
									// then we add tax to the (untaxed) discount
									$product_discount_amount += ($my_taxrate*$product_discount_amount);
									$discount = 3;
								} 
								// but if our prices are shown without tax
									// we just leave the (untaxed) discount amount as it is
									
							}
							// But, if we subtract discounts AFTER tax
								// and if our prices are shown with tax
									// we just leave the (untaxed) discount amount as it is
								// but if  prices are shown without tax
									// we just leave the (untaxed) discount amount as it is
									// even though this is not really a good combination of settings
	
							$base_price -= $product_discount_amount;
							$discount = 4;
							break;
						case 1:
							$base_price *= (100 - $product_discount_amount)/100;
							$discount = 5;
							break;
					}
				}
			}
			
			//$price = $priceprod . '-' . $base_price .'-'. $GLOBALS['CURRENCY_DISPLAY']->getValue($base_price, 2) . '-' . $discount .'-'.$product_discount_amount;
			//$price = $GLOBALS['CURRENCY_DISPLAY']->getValue($base_price, 2);
                        $price = $base_price;
			//print $price.'<br> ';
			$title_max = $product['product_name'];
			//$title_max = $this->html2txt($title_max);
			$title_max = str_replace('"', '', $title_max);
			$title_max = str_replace(',', ', ', $title_max);
			$title_max = str_replace(',  ', ', ', $title_max);
			$title_max = str_replace('  ', ' ', $title_max);
			$title_max = $this->changeAccented($title_max);
			//print $title_max.'<br>';
                        
			$subtitle_max = $product['product_s_desc'];
			//$subtitle_max = $this->html2txt($subtitle_max);

			$subtitle_max = str_replace("\n", ', ', $subtitle_max);
			$subtitle_max = str_replace("\t", '', $subtitle_max);
			$subtitle_max = str_replace(', ,', '', $subtitle_max);
			$subtitle_max = str_replace('"', '', $subtitle_max);
			$subtitle_max = str_replace(',', ', ', $subtitle_max);
			$subtitle_max = str_replace(',  ', ', ', $subtitle_max);
			$subtitle_max = str_replace('  ', ' ', $subtitle_max);
			$subtitle_max = $this->changeAccented($subtitle_max);
                        //print $subtitle_max.'<br>';
			
			$title_max .= ' ' . $subtitle_max;
			//$title_max .= htmlspecialchars($title_max);
			if(strlen($title_max) > $title_limit) {
				//$title_max = substr($title_max, 0, ($title_limit-1));
				//$title_max = substr($title_max, 0, strrpos($title_max," "));
				$title_max = $this->strwrap($title_max, $title_limit, " ");
			}
			
			//$subtitle_max .= htmlspecialchars($subtitle_max);
			if(strlen($subtitle_max) > $subtitle_limit) {
				//$subtitle_max = substr($subtitle_max, 0, ($subtitle_limit-1));
				//$subtitle_max = substr($subtitle_max, 0, strrpos($subtitle_max," "));
				$subtitle_max = $this->strwrap($subtitle_max, $subtitle_limit, " ");
			}
			
			$description_max =$product['product_desc'];
			$description_max = preg_replace( "{\r+|\n+}", '', $description_max );
			/* $description_max = preg_replace('@<style[^>]*?>.*?</style>@siU', '', $description_max); //remove html style */
			$description_max = $this->stripArgumentFromTags($description_max);
			$description_max = str_replace('"', "'", $description_max);
			//$description_max = $this->html2txt($product['product_desc']);
			//$description_max = $this->changeAccented($description_max);
			//$description_max .= htmlspecialchars($description_max);
			//$description_max = htmlspecialchars($description_max, ENT_QUOTES, "UTF-8");
			if(strlen($description_max) < 10) {
				$description_max=$title_max;
			}
			if(strlen($description_max) > $description_limit) {
				//$description_max = strip_tags(substr($description_max, 0, ($description_limit-1)));
				//$description_max = substr($description_max, 0, strrpos($description_max," "));
				$description_max = $this->strwrap($description_max, $description_limit, " ");
			}
//Action;Category;StoreCategory;CustomLabel;Title;Subtitle;Description;ConditionID;PicURL;Quantity;
//Format;StartPrice;Duration;ImmediatePayRequired;Location;PayPalAccepted;PayPalEmailAddress;
//ShippingService-1:Option;ShippingService-1:Cost;DispatchTimeMax;ReturnsAcceptedOption;HitCounter
//"VerifyAdd";"132801";"Gel UV 15ml";"Gel UV sottotitolo";"Gel UV descrizione";"1000";"http://www.diamondnailstore.it/components/com_virtuemart/shop_image/product/Super_Pink_Gel_U_4fe56f01e5dfd.jpg";"10";"FixedPrice";"18.00";"7";"1";"Via XXIV Maggio 17, 19124 La Spezia";"1";"info@diamondnailstore.it";"IT_RegularPackage";"5.00";"1";"ReturnsAccepted";"HiddenStyle"
			$xml .= '"VerifyAdd";'; //Action
			$xml .= '"'.$product['vp_export_cat'].'";'; //Category
			$xml .= '"'.$product['vp_export_cat2'].'";'; //StoreCategory
			$xml .= '"'.$product['product_sku'].'";'; //CustomLabel
			$xml .= '"'.$title_max.'";'; //Title
			if ($subtitle_export) {
				$xml .= '"'.$subtitle_max.'";'; //Subtitle
			}
			$xml .= '"'.$description_max.'";'; //Description
			$xml .= '"1000";'; //ConditionID
			$xml .= '"'.URLSITE.'/components/com_virtuemart/shop_image/product/'.$product['product_full_image'].'";'; //PicURL
			//$xml .= '<link>'. URLSITE.'/index.php?page=shop.product_details&amp;flypage=shop.flypage='.$flypage.'&amp;product_id='.$product['product_id'].'&amp;option=com_virtuemart&amp;Itemid=29.</link>'."\n";
			
			$xml .= '"10";'; //Quantity
			$xml .= '"FixedPrice";'; //Format
			$xml .= '"'.$price.'";'; //StartPrice
			$xml .= '"7";'; //Duration
			$xml .= '"1";'; //ImmediatePayRequired
			$xml .= '"Via XXIV Maggio 17, 19124 La Spezia";'; //Location
			$xml .= '"1";'; //PayPalAccepted
			$xml .= '"info@diamondnailstore.it";'; //PayPalEmailAddress
			$xml .= '"IT_ExpressCourier";'; //ShippingService-1:Option
			$xml .= '"5.00";'; //ShippingService-1:Cost
			$xml .= '"1";'; //DispatchTimeMax
			$xml .= '"ReturnsAccepted";'; //ReturnsAcceptedOption
			$xml .= '"HiddenStyle"'; //ReturnsAcceptedOption

			//$dbcat	=& JFactory::getDBO();
			//$sql2  = "SELECT category_name,category_flypage FROM #__vm_category ";
			//$sql2 .= " LEFT JOIN #__vm_product_category_xref ON #__vm_category.category_id=#__vm_product_category_xref.category_id ";
			//$sql2 .= " WHERE #__vm_product_category_xref.product_id='".$product['product_id']."' ";
			//$dbcat->setQuery($sql2);
			//$cat=$dbcat->loadRow();
			//if(empty($cat)){die('Echec f...');}
			//$categorie=$cat['0'];
			//$flypage=$cat['1'];
			//if($results['5'] != '0') {
			//	$xml .= '<g:product_type>'.htmlspecialchars($this->getampers($categorie)).'</g:product_type>'."\n";
			//}
			
			$xml .= "\n";
	
		}
		
        //ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'"');
		header('Cache-Control: max-age=0');
		print $xml;
		exit;
		
	}
	/**
	 * Gets the product discount in string format
	 * @param integer $productId
	 * @return string 
	 */
	protected function getDiscount($productDiscountId) {
		
		$productDiscount = new stdClass();
		
		$amount = 0;
		
		if ($productDiscountId != 0) {
                   //print 'Discount ID '.$productDiscountId.'<br>';
		   $discountSelect = 'select * from #__'.VM_TABLEPREFIX.'_product_discount t where t.discount_id = '.$productDiscountId; 
                   $db	=& JFactory::getDBO();
		   //print 'Discount sql '.$discountSelect.'<br>';
                   $db->setQuery($discountSelect);
                   //print 'Discount query<br>';
		   $discount = $db->loadObjectList();
                   //print 'Discount load<br>';
		   $productDiscount->amount = $discount[0]->amount;
		   $productDiscount->is_percent = $discount[0]->is_percent;
		}else{
		   $productDiscount->amount = 0;
		   $productDiscount->is_percent = 0;
		}
	   return $productDiscount;  
	}//getDiscount()
	
}
?>