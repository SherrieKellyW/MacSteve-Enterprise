

<?php


include("includes/db.php");


?>


<?php    
if(isset($_GET['invoice_no'])){
    
    $invoice_no = $_GET['invoice_no'];
    
}
?>
                           
      <?php 
          
                                

      $payment_confirmed = "payment confirmed";
                             
      $get_payments = "select * from payments where payment_confirmation = '$payment_confirmed' and invoice_no = '$invoice_no'";
                                
      $run_payments = mysqli_query($con,$get_payments);
          
      $row_payments=mysqli_fetch_array($run_payments);
                                    
      $payment_id = $row_payments['payment_id'];
                                    
       $invoice_no = $row_payments['invoice_no'];
                                    
       $amount = $row_payments['amount'];
                                    
       $payment_mode = $row_payments['payment_mode'];
                                    
        $transaction_id = $row_payments['transaction_id'];
                                    
       $payment_number = $row_payments['payment_number'];

       $payment_date = $row_payments['payment_date'];

       $payment_confirmation = $row_payments['payment_confirmation'];

       $shipping_status = $row_payments['shipping_status'];

       $status_shipped = "shipped";


       if(isset($_GET['invoice_no'])){

            $update_shippingStatus = "update payments set shipping_status = '$status_shipped' where invoice_no = '$invoice_no' and payment_confirmation = '$payment_confirmed'";
            $run_updateshippingStatus = mysqli_query($con,$update_shippingStatus);

            

            if($run_updateshippingStatus){
                            
                            echo "<script>alert('Shipping confirmed successfuly')</script>";
                            
                            echo "<script>window.open('index.php?view_confirmedPayments','_self')</script>";
                            
                        }

       }
                                    
                            
       ?>
                            