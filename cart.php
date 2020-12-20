<?php 
session_start();
class Cart
{ 
	public $folder = 'uploads/'; 
	
	public function getVersion()
	{
		return 'Opencart 1.5.2 DEV';
	}
	
	public function Add($id, $size = 0, $quantity = 1)
    {
		include_once('blocks/LanguageCart.php'); 
		$lang = (isset($_SESSION['language'])) ? $_SESSION['language'] : 'ru';
		if($lang == 'ru') $ext = '';
			else $ext = '_'.$lang;

		$_SESSION['cart']['total']['sum'] = ($_SESSION['cart']['total']['sum'] < 0) ? 0 : $_SESSION['cart']['total']['sum']; 
		$_SESSION['cart']['total']['qty'] = ($_SESSION['cart']['total']['qty'] < 0) ? 0 : $_SESSION['cart']['total']['qty']; 

		if(isset($_SESSION['cart']['product'][$id]))
		{
			 $keys  = array_keys ($_SESSION['cart']['product'][$id]['options']);
			
			 if(in_array($size, $keys))
			 {	
				
				if($_SESSION['cart']['product'][$id]['options'][$size]['quantity'] += $quantity)
				{
					return self::recalc($id, $size, $_SESSION['cart']['product'][$id]['quantity'] + $quantity);
				}
			 }
			 else
			 {
				$_SESSION['cart']['product'][$id]['options'][$size] = array(
					'js'      => $this->prepend($size),
					'size'    => $size,
					'quantity'=> $quantity,
				);
				
				require_once("config.php");
				$result = mysql_query("SELECT * FROM `catalog` WHERE id NOT BETWEEN 7 AND 12 AND id='".$id."'");
				$product = mysql_fetch_array($result);
				
				$price = ($product['status'] == 3) ? $product['price_stock'] : $product['price'];
				
				$html = '<div id="product'. $id .'-'. $size .'" class="item"><div class="container"><img src="'. $this->folder . $product['image'] .'" alt="'. $product['name'.$ext] .'">';
				$html .= '<div class="content"><div class="name">'. $product['name'.$ext] .' ('.$product['description'.$ext] .')</div><div class="description">';
				$html .= '<div class="col">'. $product['article'] .'</div>'.' <div class="col"> '. $size .'</div>'.' <div class="col quantity'. $id .'-'. $size .'"> '. $options[$size]['quantity'] .' '. $language[$lang]['count'] .'</div>';
				$html .= '</div><div class="price">'. $price .'</div><div class="delete"><a class="delincart" class="delincart" href="javascript:void(0)" data-id="'. $product['id'] .'" data-size="'. $size .'" data-js="'. $this->prepend($size) .'"><img src="images/trash_icon.png" alt="delete"></a></div>';
				$html .= '</div></div></div>';
				
				$quantity += $_SESSION['cart']['product'][$id]['quantity'];
				return self::recalc($id, $size, $quantity, $html);
			 }
		}
		else 
		{			
			require_once("config.php");
			$result = mysql_query("SELECT * FROM `catalog` WHERE id NOT BETWEEN 7 AND 12 AND id='".$id."'  ");
			$product = mysql_fetch_array($result);
			if($product)
			{
				$price = ($product['status'] == 3) ? $product['price_stock'] : $product['price'];
				$options[$size] = array(
				    'js'      => $this->prepend($size),
					'size'    => $size,
					'quantity'=> $quantity,
				);
				
				$_SESSION['cart']['product'][$id] = array(
					'id'          => $id,
					'quantity'    => $quantity,
					'name'        => array(
						'ru' => $product['name'],
						'lv' => $product['name_lv'],
						'en' => $product['name_en'],
					),
					'description' => array(
						'ru' => $product['description'],
						'lv' => $product['description_lv'],
						'en' => $product['description_en'],
					),
					'model'       => $product['article'],
					'price'       => $price,
					'image'       => $product['image'],
					'options'     => $options
				);
								
				$_SESSION['cart']['total']['qty'] = isset($_SESSION['cart']['total']['qty']) ? $_SESSION['cart']['total']['qty'] + $quantity : $quantity;
				$_SESSION['cart']['total']['sum'] = isset($_SESSION['cart']['total']['sum']) ? $_SESSION['cart']['total']['sum'] + $quantity * $price : $quantity * $price;
				
			}
			else 
			{
				$json['error'] = "Товар не найден";
			}
			
			$html = '<div id="product'. $id .'-'. $this->prepend($size) .'" class="item"><div class="container"><img src="'. $this->folder . $product['image'] .'" alt="'. $product['name'.$ext] .'">';
			$html .= '<div class="content"><div class="name">'. $product['name'.$ext] .' ('.$product['description'.$ext] .')</div><div class="description">';
			$html .= '<div class="col">'. $product['article'] .'</div>'.' <div class="col"> '. $size .'</div>'.' <div class="col quantity'. $id .'-'. $this->prepend($size) .'"> '. $options[$size]['quantity'] .' '. $language[$lang]['count'] .'</div>';
			$html .= '</div><div class="price">'. $price .'</div><div class="delete"><a class="delincart" href="javascript:void(0)" data-id="'. $product['id'] .'" data-size="'. $size .'" data-js="'. $this->prepend($size) .'"><img src="images/trash_icon.png" alt="delete"></a></div>';
			$html .= '</div></div></div>';
			
			$json['total'] = $_SESSION['cart']['total']['sum'];
			$json['count'] = $_SESSION['cart']['total']['qty'];
			$json['html']  = $html;
						
			return json_encode($json);
			
		}
	}
	
	public function recalc($id, $size, $quantity = 0, $html = false)
    {
		if(!isset($_SESSION['cart']['product'][$id])) return false;

		if ($quantity > 0)
		{
			$_SESSION['cart']['product'][$id]['quantity'] = $quantity;	
						
			$keys  = array_keys ($_SESSION['cart']['product']);
			
			$sum = 0;
			$qty = 0;
			
			foreach ($keys as $key)
			{		
				$sum = $sum + $_SESSION['cart']['product'][$key]['quantity'] * $_SESSION['cart']['product'][$key]['price'];
				$qty = $qty + $_SESSION['cart']['product'][$key]['quantity'];		
			}
			
			$_SESSION['cart']['total']['qty'] = $qty;
			$_SESSION['cart']['total']['sum'] = $sum;
		}
		else {
				
			$qtyMinus = $_SESSION['cart']['product'][$id]['quantity'];
			$sumMinus = $_SESSION['cart']['product'][$id]['quantity'] * $_SESSION['cart']['product'][$id]['price'];
			$_SESSION['cart']['qty'] -= $qtyMinus;
			$_SESSION['cart']['sum'] -= $sumMinus;
			
			$_SESSION['cart']['total']['qty'] -= $qtyMinus;
			$_SESSION['cart']['total']['sum'] -= $sumMinus;
			
			unset($_SESSION['cart']['product'][$id]);
		}
		
		if($html) $json['html'] = $html;
		$json['quantity'] = ($_SESSION['cart']['product'][$id]['options'][$size]['quantity']) ? $_SESSION['cart']['product'][$id]['options'][$size]['quantity'] .' шт.' : 0;
		$json['js'] = $this->prepend($size);
		$json['total'] = $_SESSION['cart']['total']['sum'];
		$json['count'] = $_SESSION['cart']['total']['qty'];
		
		return json_encode($json);
			
	}
	
	public function Clear()
    {
        unset($_SESSION['cart']);
		
		$json['total'] = 0;
		$json['count'] = 0;
		
		return json_encode($json);
	}
	
    public function Remove($id, $size)
    {
		$option_quantity = $_SESSION['cart']['product'][$id]['options'][$size]['quantity'];
		$_SESSION['cart']['product'][$id]['options'][$size]['quantity'] = 0;

		
		if($_SESSION['cart']['total']['qty'] - $option_quantity == 0)
		{
			unset($_SESSION['cart']);
			$json['count'] = 0;
			$json['total'] = 0;
		}
		else
		{
			$_SESSION['cart']['total']['qty'] -= $option_quantity;
			$json['total'] = $_SESSION['cart']['total']['sum'] -= $option_quantity * $_SESSION['cart']['product'][$id]['price'];
			
			if($_SESSION['cart']['product'][$id]['quantity'] - $option_size == 0)
			{
				$_SESSION['cart']['product'][$id]['quantity'] = 0;
				unset($_SESSION['cart']['product'][$id]);
			}
			else
			{
				$_SESSION['cart']['product'][$id]['quantity'] -= $option_quantity;
				unset($_SESSION['cart']['product'][$id]['options'][$size]);
			}
			$json['count'] = $_SESSION['cart']['total']['qty'];
			$json['total'] = $_SESSION['cart']['total']['sum'];
		}
		
		return json_encode($json);	
	}

    public function edit($id, $quantity, $size)
    {
		$_SESSION['cart']['product'][$id]['options'][$size]['quantity'] = $quantity;
		return self::recalc($id, $size, $quantity);	
	}
	
	public function prepend($filter) {
		
		$filter = str_replace('/', '', $filter);
		$filter = str_replace(' ', '', $filter);
		
		return $filter;
	}
	
	public function language($key)
	{
		if($_SESSION['language'] = $key)
		{
			$json['success'] = 'success';
			return json_encode($json);	
		}
	}
}

$cart = new Cart();


if(isset($_GET['add'])) echo $cart->add($_GET['id'], $_GET['options'], $_GET['quantity']);
if(isset($_GET['edit'])) echo $cart->edit($_GET['key'], $_GET['quantity'], $_GET['options'] );
if(isset($_GET['remove'])) echo $cart->Remove($_GET['key'], $_GET['options']);
if(isset($_GET['clear'])) echo $cart->Clear();
if(isset($_GET['language'])) echo $cart->language($_GET['key']);


?>
