<?php 

add_action('admin_menu', 'adminProductPlugin');

function adminProductPlugin(){
 add_menu_page('Taksitlendirme','Taskitlendirme', 'manage_options', 'paymentInstallment', 'adminInstallment');
}

function adminInstallment()
{

global $wpdb;

$wpPostData1=$wpdb->get_results("select * from {$wpdb->prefix}taksit",OBJECT);   
$deleteİnst =  $wpdb->delete( 'conference_register', array( 'id' => $data2->id ) );
?>
    

<div style="margin-top:10px;">

            <h2>Taksitlendirme</h2>
               
                	<table>
  <tr>
    <th>Taksit Miktarı</th>
    <th>Banka</th>
    <th>Taksit Oranı</th>
    
    <th>Sil</th>
   
  </tr>
  <?php if($wpPostData1):
    	foreach($wpPostData1 as $data2): ?>
  <tr>
    <td><input type="text" name="instNumber" value ="<?php echo $data2->instNumber; ?>" disabled></td>
     <td><center><input type="text"  value ="<?php echo $data2->İnstBank; ?>" disabled></center></td>
    <td><center><input type="text"  value ="<?php echo $data2->instPrice; ?>" disabled></center></td>
   
    <th>
    	<form method="post" action="">

    		<input type="submit"  name="delete" value="SİL" />
    		<input type="hidden"  name="id" value="<?php echo $data2->id; ?>" />
    	</form>


    </th>

   
  </tr>
   <?php endforeach;
    endif; ?>
</table>
<br>
           <input type="checkbox" id="ınstStatus" name="ınstStatus" checked /> Aktif / Pasif Et<br />
                    <br></br>
                
           
        </div>





  <h2>Taksit Ekle</h2>
                <form method="post" aciton= "">
                	<table>
  <tr>
    <th>Taksit Miktarı</th>
    <th>Banka Adı</th>
    <th>Taksit Oranı</th>
    
   
  </tr>
  
  <tr>
    <td><input type="text" name="instNumber" ></td>
    <td><input type="text" name="İnstBank" ></td>
    <td><center><input type="text" name="instPrice"></center></td>
    
</table>
                    <br></br>
                    <input type="submit"  name="update" />
                </form>
           
        </div>
<a href="#"><img src="iyziimage.jpeg" alt="Örnek Resim" /></a>
  

<?php


if(isset($_POST['update']))
{	
global $wpdb;

$table_name = $wpdb->prefix."taksit";
$wpdb->insert(
                    $table_name,
                    array(
                            'instNumber'=>$_POST['instNumber'],
                            'İnstBank'=>$_POST['İnstBank'],
                            'instPrice' =>$_POST['instPrice'],
                            'instStatus'=>$_POST['instStatus']

                        ),
                    array( '%s','%s' ,'%s'  ,'%s')
                 );


}
if(isset($_POST['delete']))
{
	//echo $_POST['id'];

	$wpdb->delete( 'wp_taksit', array( 'id' => $_POST['id'] ) );
}

/*$newData   = $_POST['ınstStatus'];
$ınstRate2 = $_POST['ınstRate2'];
$ınstRate4 = $_POST['ınstRate4'];
$ınstRate6 = $_POST['ınstRate6'];

 
$oldınstRate2 = get_post_meta(69,"ınstRate",1,true);
$oldınstRate4 = get_post_meta(70,4,1,true);
$oldınstRate6 = get_post_meta(71,6,1,true);
$oldData      = get_post_meta(68,"statusInst",1,true);

if($newData != $oldData)
{
    update_post_meta(68,"statusInst",$newData,$oldData,true);

}
if($ınstRate2 != $oldınstRate2)
{
    update_post_meta(69,"ınstRate2",$ınstRate2 ,$oldınstRate2,true);

}*/



}



?>