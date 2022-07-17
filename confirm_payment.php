<?php 

    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>


<div class="box"><!-- box Begin -->
    
  <div class="box-header"><!-- box-header Begin -->
      
      <center><!-- center Begin -->
          
          <h1> Confirm Payment Received </h1>
          
          
          <p class="text-muted"> Enter the Phone Number of the payment message and the Transaction ID of the payment, in the fields below. </p>
          
      </center><!-- center Finish -->
      
  </div><!-- box-header Finish -->
   
  <form method="post" ><!-- form Begin -->
      
      <div class="form-group"><!-- form-group Begin -->
          
          <label> Phone Number / paybill </label>
          
          <input name="phone_number"  class="form-control" required>
          
      </div><!-- form-group Finish -->
      
       <div class="form-group"><!-- form-group Begin -->
          
          <label> Transaction ID </label>
          
          <input name="transaction_ID"  class="form-control" required>
          
      </div><!-- form-group Finish -->
      
      <div class="text-center"><!-- text-center Begin -->
          
          <button name="confirm_payment" value="confirm_payment" class="btn btn-primary">
              
              <i class="fa fa-check"></i> Confirm paid.
              
           </button>
          
      </div><!-- text-center Finish -->     
      
  </form><!-- form Finish -->
    
</div><!-- box Finish -->





                                 <?php

                                 

                                 if(isset($_POST['confirm_payment'])){

    
                                  $customer_phoneNo = $_POST['phone_number'];
    
                                  $customer_transactionID = $_POST['transaction_ID'];

                                  $payment_confirmed = "payment confirmed";

                                  $con = mysqli_connect("localhost","root","","cosmetics_test");
    
                                  $select_payment = "select * from payments where payment_number='$customer_phoneNo' and transaction_id ='$customer_transactionID'";
    
                                   $run_paymentConfirmation = mysqli_query($con,$select_payment);
 
                                   $check_payment = mysqli_num_rows($run_paymentConfirmation);

                                   if($check_payment==0){
        
                                   echo "<script>alert('Payment is not Confirmed')</script>";
        
                                   exit();
        
                                    }
    
                                   if($check_payment==1){

                                   $update_paymentConfirmation ="update payments set payment_confirmation='$payment_confirmed' where transaction_id ='$customer_transactionID'";

                                   $run_updatePaymentConfirmation = mysqli_query($con,$update_paymentConfirmation);

                                   echo "<script>alert('Payment  Confirmed Successifully')</script>";
        
        
                                  }  
    
                                  } 


                                 ?>




                                <?php }?>