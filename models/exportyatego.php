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
//require_once (JPATH_COMPONENT.DS.'models'.DS.'html2text.php');
	if (file_exists(JPATH_SITE.DS.'administrator/components/com_virtuemart/virtuemart.cfg.php') === true) {
			require_once JPATH_SITE.DS.'administrator/components/com_virtuemart/virtuemart.cfg.php';
                        //print CLASSPATH;
                        //require_once JPATH_SITE.DS.'administrator/components/com_virtuemart/global.php';
	} else {
                print 'You have to install virtueMart component!';
                exit;
		//throw new Exception('You have to install virtueMart component!');
	} 

class VirtuePortModelexportyatego extends JModel {

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
	 "� " => "�", "š" => "�", "�'" => "�", "�" => "�",
	 "Ÿ" => "�", "ÿ" => "�", "À" => "�", "� " => "�",
	 "Á" => "�", "á" => "�", "Â" => "�", "â" => "�",
	 "Ã" => "�", "ã" => "�", "Ä" => "�", "ä" => "�",
	 "Å" => "�", "å" => "�", "Æ" => "�", "æ" => "�",
	 "Ç" => "�", "ç" => "�", "È" => "�", "è" => "�",
	 "É" => "�", "é" => "�", "Ê" => "�", "ê" => "�",
	 "Ë" => "�", "ë" => "�", "Ì" => "�", "ì" => "�",
	 "Í" => "�", "í" => "�", "Î" => "�", "î" => "�",
	 "Ï" => "�", "ï" => "�", "Ð" => "�", "ð" => "�",
	 "�'" => "�", "ñ" => "�", "�'" => "�", "ò" => "�",
	 "�" => "�", "ó" => "�", "�" => "�", "ô" => "�",
	 "Õ" => "�", "õ" => "�", "Ö" => "�", "Ø" => "�",
	 "ø" => "�", "Ù" => "�", "ù" => "�", "Ú" => "�",
	 "ú" => "�", "Û" => "�", "û" => "�", "Ü" => "�",
	 "ü" => "�", "Ý" => "�", "ý" => "�", "Þ" => "�",
	 "þ" => "�", "ß" => "�", "ö" => "�","Դ"=>"�",
	 "�"=>"�","�©"=>"�","é"=>"�","�"=>"�"
	 ,"�ƒ�©"=>"�","Ã«"=>"�","�¢"=>"�","Hôteliéres"=>"H�teli�res"
	 ,"ZA�?RE"=>"ZAIRE","é"=>"�","�"=>"u","�"=>"-","²"=>"�","«" => "�","»" => "�"
	 );
         */
	//"’"=>"'"
	
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
	
	function getexportyatego(){
	//global $mainframe;

	$subtitle_export = false; //Se true esporta sottotitolo, campo a pagamento
	$product_discount_export = false; // se true esporta con eventuale prezzo scontato
	
	$auth = $_SESSION['auth'];
	//$tpl = new $GLOBALS['VM_THEMECLASS']();
	
	define('URLSITE',dirname(JURI::base()),true);
	
	$filename = 'virtueport_yatego.csv';
		
	/*
	$dbs	=& JFactory::getDBO();
	$sqls= ' SELECT * From #__virtueport_config where id=\'1\' ';
	$dbs->setQuery($sqls);
	$results=$dbs->loadRow();
        
		$sitenameS=$results['1'];
		$descS=$results['2'];
		$url_site = $_SERVER['HTTP_HOST'];	
	*/
		//Yatego
		$strExport  ='foreign_id;article_nr;title;tax;price;price_uvp;price_purchase;tax_differential;units;delivery_surcharge;delivery_calc_once;short_desc;long_desc;url;auto_linefeet;picture;picture2;picture3;picture4;picture5;categories;variants;discount_set_id;stock;delivery_date;quantity_unit;package_size;cross_selling;ean;isbn;manufacturer;mpn;delitem;status;top_offer';
		$strExport .= "\n";
		$db	=& JFactory::getDBO();
		$sql  = " SELECT DISTINCT * ";
		$sql .= " FROM #__vm_product ";
		$sql .=" LEFT JOIN #__vm_product_mf_xref ON #__vm_product_mf_xref.product_id = #__vm_product.product_id ";
		$sql .=" LEFT JOIN #__vm_manufacturer  ON #__vm_product_mf_xref.manufacturer_id = #__vm_manufacturer.manufacturer_id ";
		$sql .=" LEFT JOIN #__vm_product_price  ON #__vm_product_price.product_id = #__vm_product.product_id ";
		$sql .=" LEFT JOIN #__vm_tax_rate ON #__vm_tax_rate.tax_rate_id = #__vm_product.product_tax_id ";
		$sql .=" LEFT JOIN #__vm_product_category_xref ON #__vm_product_category_xref.product_id = #__vm_product.product_id ";
		$sql .=" LEFT JOIN #__vm_category ON #__vm_category.category_id = #__vm_product_category_xref.category_id ";
		//$sql .=" LEFT JOIN #__vp_export_cat ON #__vp_export_cat.vp_virtuemart_cat = #__vm_product_category_xref.category_id ";
		$sql .=" where product_publish= 'Y' and disponibilita = 'S' and product_price IS NOT NULL ";
		$sql .= " ORDER BY product_price DESC ";
		//$sql .=" and product_in_stock>0 "; 
                //print $sql .' ';
		$db->setQuery($sql);
		//$products=$db->loadRowList();
		$products=$db->loadAssocList();
	
		if(empty($products)){die('Echec ...');}
		
		//if(!isset($product['6'])){$product['6']=10;}
		$title_limit = 255;
		$subtitle_limit = 130;
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
			//$h2t =& new html2text($subtitle_max);
			//$subtitle_max = $h2t->get_text();

			$subtitle_max = str_replace("\n", ', ', $subtitle_max);
			$subtitle_max = str_replace("\t", '', $subtitle_max);
			$subtitle_max = str_replace(', ,', '', $subtitle_max);
			$subtitle_max = str_replace('"', '', $subtitle_max);
			$subtitle_max = str_replace(',', ', ', $subtitle_max);
			$subtitle_max = str_replace(',  ', ', ', $subtitle_max);
			$subtitle_max = str_replace('  ', ' ', $subtitle_max);
			$subtitle_max = $this->changeAccented($subtitle_max);
                        //print $subtitle_max.'<br>';
			
			//$title_max .= ' ' . $subtitle_max;
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
//foreign_id;article_nr;title;tax;price;price_uvp;price_purchase;tax_differential;units;
//delivery_surcharge;delivery_calc_once;short_desc;long_desc;url;auto_linefeet;
//picture;picture2;picture3;picture4;picture5;categories;variants;discount_set_id;stock;
//delivery_date;quantity_unit;package_size;cross_selling;ean;isbn;manufacturer;mpn;delitem;status;top_offer
/*
7509;10272211;"CELLULARE SAMSUNG XXAA";21;449,90;500;;0;0;0;1;"Descrizione breve dell'articolo";"Descrizione lunga <br> con codici html";"http://www.miosito.it/shop/7509-cellulare.html";0;"http://www.miosito.it/images/1ds223.jpg";"http://www.miosito.it/images/1ds223.jpg";"http://www.miosito.it/images/1ds2233.jpg";"http://www.miosito.it/images/1ds2234.jpg";"http://www.miosito.it/images/1ds2235.jpg";;;;50;"Tempi di consegna 2 - 3 giorno/i";;1;;;;"SAMSUNG";;;0;0
*/
			$strExport .= '"'.$product['product_id'].'";'; //foreign_id
			$strExport .= '"'.$product['product_sku'].'";'; //article_nr
			$strExport .= '"'.$title_max.'";'; //Title
			$strExport .= '"21";'; //tax $my_taxrate_int
			$strExport .= '"'.$price.'";'; //price
			$strExport .= '"'.$price.'";'; //price_uvp
			
			$strExport .= ';'; //price_purchase sempre vuoto
			$strExport .= ';'; //tax_differential sempre vuoto
			
			$strExport .= '"1";'; //units
			$strExport .= ';'; //delivery_surcharge
			$strExport .= ';'; //delivery_calc_once
			$strExport .= '"'.$subtitle_max.'";'; //short_desc
			$strExport .= '"'.$description_max.'";'; //long_desc
			$strExport .= '"'.$urlProd.'";'; //url
			$strExport .= '"1";'; //auto_linefeet
			$strExport .= '"'.URLSITE.'/components/com_virtuemart/shop_image/product/'.$product['product_full_image'].'";'; //picture
			$strExport .= ';'; //picture2
			$strExport .= ';'; //picture3
			$strExport .= ';'; //picture4
			$strExport .= ';'; //picture5
			$strExport .= '"'.$product['category_name'].'";'; //categories - al momento solo 1
			$strExport .= ';'; //variants
			$strExport .= ';'; //discount_set_id - aggiungere lo sconto
			$strExport .= '"-1";'; //stock - O=venduto -1=infinito
			$strExport .= ';'; //delivery_date
			$strExport .= '"pz";'; //quantity_unit
			$strExport .= '"1";'; //package_size
			$strExport .= ';'; //cross_selling
			$strExport .= ';'; //ean
			$strExport .= ';'; //isbn
			$strExport .= ';'; //manufacturer
			$strExport .= ';'; //mpn
			$strExport .= ';'; //delitem
			$strExport .= '"1";'; //status 0=inattivo 1=attivo
			$strExport .= ';'; //top-offer
			
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
			//	$strExport .= '<g:product_type>'.htmlspecialchars($this->getampers($categorie)).'</g:product_type>'."\n";
			//}
			
			$strExport .= "\n";
	
		}
		
        //ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'"');
		header('Cache-Control: max-age=0');
		print $strExport;
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