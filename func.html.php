<?php


function htmlCatItem( $offer )
{
  global $folder;
  $o = '
<li class="product-list__items" '.( $offer['status'] == 3 ? 'style="box-shadow: 0px 0 0px 3px red;"' : '' ).'>
  <div class="product-list__links-blocks">
    <a href="view.php?item='.$offer['id'].'" class="product-list__links">
    <div class="view_item">';
  if( $offer['status'] == '1' )
    $o .= '<img src="img/blue.svg" alt="blue" class="svg"><div class="status status-new">new</div>';
  else if( $offer['status'] == '2' )
    $o .= '<img src="img/red.svg" alt="red" class="svg"><div class="status status-sold">sold</div>';
  if( $offer['catalog_image'] )
    $o .= '<img src="'.$folder.'catalog/'.$offer['catalog_image'].'" alt="'.$offer['catalog_image'].'" class="product-list__img">';
  $o .= '
    </div>
    <div class="title">'.$offer['name'].'</div>
    <div class="description">'.$offer['description'].'</div>
    <div class="article">'.$offer['article'].'</div>
<!--          <div class="type new-product">Новый товар</div>-->
  ';
  if( $offer['status'] != '2' )
  {
    $o .= '<div class="price-block">';
    if( $offer['price_stock'] > 0 )
      $o .= '<p class="discount-on">'.(int)$offer['price_stock'].'</p>';
    else
      $o .= '<p class="discount-off"></p>';

    $o .= '<p class="price">€'.(int)$offer['price'].'</p>
      </div>';
    }
    $o .= '
  </a>
  </div>
</li>
  ';
  return $o;
}


?>