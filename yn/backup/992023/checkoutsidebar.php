
<aside class="sidebar" role="complementary">


          <div class="sidebar__content">
                <div id="order-summary" class="order-summary order-summary--is-collapsed" data-order-summary>
  <h2 class="visually-hidden-if-js">Order summary</h2>

  <div class="order-summary__sections">
    <div class="order-summary__section order-summary__section--product-list">
  <div class="order-summary__section__content">
    <table class="product-table">
      <caption class="visually-hidden">Shopping cart</caption>
      <thead class="product-table__header">
        <tr>
          <th scope="col"><span class="visually-hidden">Product image</span></th>
          <th scope="col"><span class="visually-hidden">Description</span></th>
          <th scope="col"><span class="visually-hidden">Quantity</span></th>
          <th scope="col"><span class="visually-hidden">Price</span></th>
        </tr>
      </thead>


      <tbody data-order-summary-section="line-items">
        <? 
        
        $total_amount = 0; 
        echo "select * from cart where user_id='".$userid."' and ac_typ='2'"; 
                    $sql = mysqli_query($con,"select * from cart where user_id='".$userid."' and ac_typ='2'");
                    while($sql_result = mysqli_fetch_assoc($sql)){ 
                    
                    $cartid = $sql_result['cart_id'];
                    $img =$sql_result['image']; 
                    $price = $sql_result['product_amt'];
                    $qty = $sql_result['qty'];
                    $total = $sql_result['total_amt'];
                    $type=$sql_result['product_type'];
                    $pid = $sql_result['product_id'];
                    $sku = $sql_result['sku'];
                    
                            
                            if($type=="1")
                            { 
                            $sql1="SELECT * FROM `product` WHERE `product_id`='".$pid."'"; 
                            }  
                            else if($type=="2")
                            { 
                            $sql1="select * from  `garment_product` where gproduct_id='".$pid."'"; 
                            }
                            $table=mysqli_query($con,$sql1);
                            $rws=mysqli_fetch_array($table);
                            $productname = $rws[3]; ?>
                            
                            
                            
                            
        <tr class="product" data-product-id="4491239784566" data-variant-id="31715443867766" data-product-type="Demo Type" data-customer-ready-visible>
          <td class="product__image">
            <div class="product-thumbnail ">
              <div class="product-thumbnail__wrapper">
                <img alt="Gabardine Bermuda Shorts - White" class="product-thumbnail__image" src="<? echo $img;?>" />
              </div>
                <span class="product-thumbnail__quantity" aria-hidden="true">4</span>
            </div>

          </td>
          <th class="product__description" scope="row">
                <span class="product__description__name order-summary__emphasis">
                    <a href="detail.php?id=<?echo $pid; ?>&&type=<? echo $type; ?>" style="user-select: auto;"><? echo $productname; ?></a>
                </span>
          </th>
          <td class="product__quantity">
            <span class="visually-hidden">
              <? echo $qty; ?>
            </span>
          </td>
          <td class="product__price">
            <span class="order-summary__emphasis skeleton-while-loading"><? echo $price; ?></span>
          </td>
        </tr>
        
        
                      <? 
              $total_amount = $total_amount + $total ; 
              } ?>
              



      </tbody>
    </table>

    <div class="order-summary__scroll-indicator" aria-hidden="true" tabindex="-1">
      Scroll for more items
      <svg aria-hidden="true" focusable="false" class="icon-svg icon-svg--size-12"> <use xlink:href="#down-arrow" /> </svg>
    </div>
  </div>
</div>



    <div class="order-summary__section order-summary__section--total-lines" data-order-summary-section="payment-lines">
      <table class="total-line-table">
  <caption class="visually-hidden">Cost summary</caption>
  <thead>
    <tr>
      <th scope="col"><span class="visually-hidden">Description</span></th>
      <th scope="col"><span class="visually-hidden">Price</span></th>
    </tr>
  </thead>
    <tbody class="total-line-table__tbody">
      <tr class="total-line total-line--subtotal">
  <th class="total-line__name" scope="row">Subtotal</th>
  <td class="total-line__price">
    <span class="order-summary__emphasis skeleton-while-loading" data-checkout-subtotal-price-target="19600">
      $196.00
    </span>
  </td>
</tr>


        <tr class="total-line total-line--shipping">
  <th class="total-line__name" scope="row">
      <span>
        Shipping
      </span>

      <a aria-haspopup="dialog" data-modal="policy-shipping-policy" data-title-text="Shipping policy" data-close-text="Close" data-iframe="true" href="/27646165110/policies/shipping-policy.html?locale=en">
            <span class="visually-hidden">Shipping costs</span>
            <svg class="icon-svg icon-svg--color-adaptive-lighter icon-svg--size-14 icon-svg--inline-after icon-svg--clickable" role="presentation" aria-hidden="true" focusable="false"> <use xlink:href="#question" /> </svg>
</a>  </th>
  <td class="total-line__price">
    <span class="skeleton-while-loading order-summary__small-text" data-checkout-total-shipping-target="0">
      Calculated at next step
    </span>
  </td>
</tr>



        <tr class="total-line total-line--taxes hidden" data-checkout-taxes>
  <th class="total-line__name" scope="row">Taxes (estimated)</th>
  <td class="total-line__price">
    <span class="order-summary__emphasis skeleton-while-loading" data-checkout-total-taxes-target="0">$0.00</span>
  </td>
</tr>


      

    </tbody>
  <tfoot class="total-line-table__footer">
    <tr class="total-line">
      <th class="total-line__name payment-due-label" scope="row">
        <span class="payment-due-label__total">Total</span>
      </th>
      <td class="total-line__price payment-due" data-presentment-currency="USD">
          <span class="payment-due__currency remove-while-loading">USD</span>
        <span class="payment-due__price skeleton-while-loading--lg" data-checkout-payment-due-target="19600">
          $196.00
        </span>
      </td>
    </tr>

  </tfoot>
</table>

    </div>
  </div>
</div>

<div class="visually-hidden" data-order-summary-section="accessibility-live-region">
  <div aria-live="polite" aria-atomic="true" role="status">
    Updated total price:
    <span data-checkout-payment-due-target="19600">
      $196.00
    </span>
  </div>
</div>


  <div id="partial-icon-symbols" class="icon-symbols" data-tg-refresh="partial-icon-symbols" data-tg-refresh-always="true"><svg xmlns="http://www.w3.org/2000/svg"><symbol id="info"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 11h1v7h-2v-5c-.552 0-1-.448-1-1s.448-1 1-1h1zm0 13C5.373 24 0 18.627 0 12S5.373 0 12 0s12 5.373 12 12-5.373 12-12 12zm0-2c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zM10.5 7.5c0-.828.666-1.5 1.5-1.5.828 0 1.5.666 1.5 1.5 0 .828-.666 1.5-1.5 1.5-.828 0-1.5-.666-1.5-1.5z"/></svg></symbol>
<symbol id="caret-down"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><path d="M0 3h10L5 8" fill-rule="nonzero"/></svg></symbol>
<symbol id="spinner-button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M20 10c0 5.523-4.477 10-10 10S0 15.523 0 10 4.477 0 10 0v2c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8h2z"/></svg></symbol>
<symbol id="chevron-right"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"/></svg></symbol>
<symbol id="down-arrow"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12"><path d="M10.817 7.624l-4.375 4.2c-.245.235-.64.235-.884 0l-4.375-4.2c-.244-.234-.244-.614 0-.848.245-.235.64-.235.884 0L5.375 9.95V.6c0-.332.28-.6.625-.6s.625.268.625.6v9.35l3.308-3.174c.122-.117.282-.176.442-.176.16 0 .32.06.442.176.244.234.244.614 0 .848"/></svg></symbol>
<symbol id="question"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm.7 13H6.8v-2h1.9v2zm2.6-7.1c0 1.8-1.3 2.6-2.8 2.8l-.1 1.1H7.3L7 7.5l.1-.1c1.8-.1 2.6-.6 2.6-1.6 0-.8-.6-1.3-1.6-1.3-.9 0-1.6.4-2.3 1.1L4.7 4.5c.8-.9 1.9-1.6 3.4-1.6 1.9.1 3.2 1.2 3.2 3z"/></svg></symbol>
<symbol id="close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M15.1 2.3L13.7.9 8 6.6 2.3.9.9 2.3 6.6 8 .9 13.7l1.4 1.4L8 9.4l5.7 5.7 1.4-1.4L9.4 8"/></svg></symbol>
<symbol id="spinner-small"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M32 16c0 8.837-7.163 16-16 16S0 24.837 0 16 7.163 0 16 0v2C8.268 2 2 8.268 2 16s6.268 14 14 14 14-6.268 14-14h2z"/></svg></symbol></svg></div>


          </div>
 
 
        </aside>