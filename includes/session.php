<?php
	//before we store information of our member, we need to start first the session
	
	session_start();
	
	//create a new function to check if the session variable member_id is on set
	function logged_in() {
		return isset($_SESSION['GUESTID']);
        
	}
	//this function if session member is not set then it will be redirected to index.php
	function confirm_logged_in() {
		if (!logged_in()) {?>
			<script type="text/javascript">
				window.location = "admin/index.php";
			</script>

		<?php
		}
	}
	function admin_logged_in() {
		return isset($_SESSION['ADMIN_ID']);
        
	}
	//this function if session member is not set then it will be redirected to index.php
	function admin_confirm_logged_in() {
		if (!admin_logged_in()) {?>
			<script type="text/javascript">
				window.location = "index.php";
			</script>

		<?php
		}
	}
	
	function message($msg="", $msgtype="") {
	  if(!empty($msg)) {
	    // then this is "set message"
	    // make sure you understand why $this->message=$msg wouldn't work
	    $_SESSION['message'] = $msg;
	    $_SESSION['msgtype'] = $msgtype;
	  } else {
	    // then this is "get message"
			return $message;
	  }
	}
	function check_message(){
	
		if(isset($_SESSION['message'])){
			if(isset($_SESSION['msgtype'])){
				if ($_SESSION['msgtype']=="info"){
	 				echo  '<div class="alert alert-info">'. $_SESSION['message'] . '</div>';
	 				 
				}elseif($_SESSION['msgtype']=="error"){
					echo  '<div class="alert alert-danger">' . $_SESSION['message'] . '</div>';
									
				}elseif($_SESSION['msgtype']=="success"){
					echo  '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
				}	
				unset($_SESSION['message']);
	 			unset($_SESSION['msgtype']);
	   		}
  
		}	

	}
function product_exists($pid){
    $pid=intval($pid);
    $max=count($_SESSION['soudahbooking_cart']);
    $flag=0;
    for($i=0;$i<$max;$i++){
      if($pid==$_SESSION['soudahbooking_cart'][$i]['soudahbookingroomid']){
        $flag=1;
        
      	message("Item is already in the cart.","success");
        break;
      }
    }
    return $flag;
  }
 function addtocart($pid,$day, $price,$checkin,$checkout,$mealprice){
    if($pid<1 or $day<1) return;
    if (!empty($_SESSION['soudahbooking_cart'])){


    if(is_array($_SESSION['soudahbooking_cart'])){
      if(product_exists($pid)) return;
      $max=count($_SESSION['soudahbooking_cart']);
      $_SESSION['soudahbooking_cart'][$max]['soudahbookingroomid']=$pid; 
       $_SESSION['soudahbooking_cart'][$max]['soudahbookingday']=$day; 
      $_SESSION['soudahbooking_cart'][$max]['soudahbookingroomprice']=$price;
      $_SESSION['soudahbooking_cart'][$max]['soudahbookingcheckin']=$checkin;
      $_SESSION['soudahbooking_cart'][$max]['soudahbookingcheckout']=$checkout; 
      $_SESSION['soudahbooking_cart'][$max]['soudahbookingmealprice']=$mealprice;
    }
    else{
     $_SESSION['soudahbooking_cart']=array();
      $_SESSION['soudahbooking_cart'][0]['soudahbookingroomid']=$pid; 
       $_SESSION['soudahbooking_cart'][0]['soudahbookingday']=$day; 
      $_SESSION['soudahbooking_cart'][0]['soudahbookingroomprice']=$price;
      $_SESSION['soudahbooking_cart'][0]['soudahbookingcheckin']=$checkin;
      $_SESSION['soudahbooking_cart'][0]['soudahbookingcheckout']=$checkout;
      $_SESSION['soudahbooking_cart'][0]['soudahbookingmealprice']=$mealprice;

    }
}else{
     $_SESSION['soudahbooking_cart']=array();
      $_SESSION['soudahbooking_cart'][0]['soudahbookingroomid']=$pid; 
       $_SESSION['soudahbooking_cart'][0]['soudahbookingday']=$day; 
      $_SESSION['soudahbooking_cart'][0]['soudahbookingroomprice']=$price;
      $_SESSION['soudahbooking_cart'][0]['soudahbookingcheckin']=$checkin;
      $_SESSION['soudahbooking_cart'][0]['soudahbookingcheckout']=$checkout;
      $_SESSION['soudahbooking_cart'][0]['soudahbookingmealprice']=$mealprice;

}
}
  function removetocart($pid){
		$pid=intval($pid);
		$max=count($_SESSION['soudahbooking_cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['soudahbooking_cart'][$i]['soudahbookingroomid']){
				unset($_SESSION['soudahbooking_cart'][$i]);
				break;
			}
		}
		$_SESSION['soudahbooking_cart']=array_values($_SESSION['soudahbooking_cart']);
	}

?>
