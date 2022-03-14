<?php 
add_filter('woocommerce_product_tabs', 'woo_new_product_tab');
function woo_new_product_tab($tabs)
{

    // Adds the new tab
    $tabs['test_tab'] = array(
        'title' => __('Taksit Seçenekleri', 'woocommerce'),
        'priority' => 50,
        'callback' => 'woo_new_product_tab_content'
    );
    return $tabs;
}

      //echo $wp_gelenVeri[0]->meta_value;
    //burada veri tabanından gelen değişken sayısını aldık 0 > büyük olduğunda if çalışcak gelen veri 0 ise else: kısmı çalışcak
function woo_new_product_tab_content()
{
    //Include external resources 
    require_once('config.php');
    require_once ('style.css');
    require_once ('wp_dbRequest.php');
   
    //Get product price
    global $product;
    $regularPrice =  $product->get_display_price() ;


    // The new tab content
    echo '<h2>Taksit Seçenekleri</h2>';

    global $wpdb;
    $wpPostData2=$wpdb->get_results("select * from {$wpdb->prefix}taksit",OBJECT);

    /*if($wpPostData2):

    	foreach($wpPostData2 as $data2):
    		echo $data2->id;
    	endforeach;
    endif;*/
    




  
  

    echo 'Ürünün Fiyatı '.$regularPrice.' TL dir.';
    ?>
    <h2>Taksit Seçenekleri</h2>
<div class="rTable">
  <div class="rTableHeader">
    <div class="rTableRow">  
      <div class="rTableCell">TAKSİT TUTARI</div>
      <div class="rTableCell">FİYAT</div>
      <div class="rTableCell">TAKSİTLİ FİYAT</div>
      <div class="rTableCell">Banka</div>
     
    </div>
    <?php if($wpPostData2):
    	foreach($wpPostData2 as $data2): ?>
  </div>
  <div class="rTableBody">
    <div class="rTableRow">  
      <div class="rTableCell paymentInstallment"><?php echo $data2->instNumber; ?></div>
      <div class="rTableCell paymentDate"><?php echo $regularPrice; ?></div>
      <div class="rTableCell paymentAmount"><?php echo $paymentInstallment=($regularPrice * $data2->instPrice); ?> /<?php echo $paymentInstallment/$data2->instNumber; ?>
      </div>
      <div class="rTableCell paymentMethod"><?php echo $data2->İnstBank; ?></div>
    </div>
    <?php endforeach;
    endif; ?>
   
    
  </div>
</div>




<form method="post" action="" >
<label>Lütfen Kart Numaranızın İlk 6 Hanesini giriniz : </label>
<input type="text" name="BınNumber6" maxlength="6">
<input type="submit" name="update" value="Göster">
</form>





     <?php
     echo $_POST['BınNumber6'];
    
   
    $request = new \Iyzipay\Request\RetrieveInstallmentInfoRequest();
    $request->setLocale(\Iyzipay\Model\Locale::TR);
    $request->setConversationId(uniqid());
    if(isset($_POST['update']))
    {
    	$request->setBinNumber($_POST['BınNumber6']);

    }
    
    $request->setPrice("$regularPrice");
    
   
    $installmentInfo = \Iyzipay\Model\InstallmentInfo::retrieve($request, Config::options());
    
    # json decode
    $result = $installmentInfo->getRawResult();
    $result = json_decode($result);
    
    $data['statusApi'] = $installmentInfo->getStatus();
    
    if($data['statusApi'] != 'success')
        exit('Error');
        
    $result = $result->installmentDetails;
    $data['result'] = $result;
    
   
    $data['installments'] = array();
    $data['banks'] 	= array();
    $data['totalPrices'] = array();
    $data['installmentPrice'] = array();
    echo "<pre>";
    //var_dump($data);

    
    echo ('<div class="cards">');
   
    
    foreach ($result as $key => $dataParser) {
    
        $data['banks'][$key] = $dataParser->cardFamilyName;
       
        echo ('<div class="card card--'. $data['banks'][$key] . '">'); 
        echo('<div class="card__head">' . $data['banks'][$key] . '</div> <div class="card__content">');
        echo('<div class="card__col card__col--installment"><div class="card__cell card__cell--head">Taksit</div>');    
        foreach ($dataParser->installmentPrices as $key => $installment) {
            $data['installments'][$key] = $installment->installmentNumber;
            echo ( '<div class="card__cell card__cell--value">' . $data['installments'][$key] . '</div>');
        }
        echo('</div>');
        
        echo('<div class="card__col card__col--default"><div class="card__cell card__cell--head">Tutar</div>');
        foreach ($dataParser->installmentPrices as $key => $installment) {
        
            $data['installmentPrice'][$key] = $installment->installmentPrice;
            echo ('<div class="card__cell card__cell--value"> '. $data['installmentPrice'][$key] . '</div>');

        }
        echo('</div>');

        echo('<div class="card__col card__col--default"><div class="card__cell card__cell--head">Toplam</div>');
        foreach ($dataParser->installmentPrices as $key => $installment) {
        
            $data['totalPrices'][$key] = $installment->totalPrice;
            echo ('<div class="card__cell card__cell--value">' . $data['totalPrices'][$key] . '</div>');

        }
        echo('</div>');
    echo ('</div></div>');
    }
echo('</div>');

}


?>