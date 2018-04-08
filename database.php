<?php 
ini_set("display_errors", "1");
error_reporting(E_ALL);

function connectdb(){
	$fp = mysqli_connect("Localhost", "root", "", "test");
	if(!($fp)){
		die(" Database Connection Failure ");
	}
	return $fp;
}

function getvenderlist(){
   $vlist = array();
   $fp1 = connectdb();
   $sql = "select vid, vname from vendor where 1";
   $row = mysqli_query($fp1, $sql);
   if($row){
      while($res = mysqli_fetch_assoc($row)){
         $vlist[$res['vid']] = $res['vname'];
      }
   }
   return $vlist;
} 

function insertskumeal($data){
   
   $fp2 = connectdb();
   $sql = "INSERT INTO `meals`	(`id`,`sku`,`mealtype`,`meal`,`price`,`vendorId`,`mealorigin`,`imageurl`,`createdon`) 
			VALUES 
			( 'null',
				'".$data['sku']."',
				'".$data['mealstype']."',
				'".$data['meals']."',
				'".$data['price']."',
				'".$data['vid']."',
				'".$data['mealorigin']."',
				'".$data['imageurl']."',
				'".date('Y-m-d H:i:s')."' 
			)";
	mysqli_query($fp2, $sql);	
}



?>