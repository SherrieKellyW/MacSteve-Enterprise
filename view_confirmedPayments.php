


<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li class="active"><!-- active begin -->
                
                <i class="fa fa-dashboard"></i> Dashboard / View Payments
                
            </li><!-- active finish -->
        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
               <h3 class="panel-title"><!-- panel-title begin -->
               
                   <i class="fa fa-tags"></i>  View Payments 
                
               </h3><!-- panel-title finish --> 
            </div><!-- panel-heading finish -->
            
            <div class="panel-body"><!-- panel-body begin -->
                <div class="table-responsive"><!-- table-responsive begin -->
                    <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->
                        
                        <thead><!-- thead begin -->
                            <tr><!-- tr begin -->
                                <th> No: </th>
                                <th> Invoice No: </th>
                                <th> Amount Paid: </th>
                                <th> Method: </th>
                                <th> Transaction ID: </th>
                                <th> Payment Number/paybill: </th>
                                <th> Payment Date: </th>
                                <th> Confirmed Payments</th>
                                <th> Shipping status </th>
                                <th>Order Details</th>
                                <th>Receiver's Details</th>
                                <th>Shipping</th>
                                
                            </tr><!-- tr finish -->
                        </thead><!-- thead finish -->
                        
                        <tbody><!-- tbody begin -->
                            
                            <?php 
          
                                $i=0;

                                $payment_confirmed = "payment confirmed";
                            
                                $get_payments = "select * from payments where payment_confirmation = '$payment_confirmed'";
                                
                                $run_payments = mysqli_query($con,$get_payments);
          
                                while($row_payments=mysqli_fetch_array($run_payments)){
                                    
                                    $payment_id = $row_payments['payment_id'];
                                    
                                    $invoice_no = $row_payments['invoice_no'];
                                    
                                    $amount = $row_payments['amount'];
                                    
                                    $payment_mode = $row_payments['payment_mode'];
                                    
                                    $transaction_id = $row_payments['transaction_id'];
                                    
                                    $payment_number = $row_payments['payment_number'];
                                    
                                    $payment_date = $row_payments['payment_date'];

                                    $payment_confirmation = $row_payments['payment_confirmation'];

                                    $shipping_status = $row_payments['shipping_status'];


                                    
                                    $i++;
                            
                            ?>
                            
                            <tr><!-- tr begin -->
                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo $invoice_no; ?> </td>
                                <td> <?php echo $amount; ?></td>
                                <td> <?php echo $payment_mode; ?> </td>
                                <td> <?php echo $transaction_id; ?></td>
                                <td> <?php echo $payment_number; ?> </td>
                                <td> <?php echo $payment_date; ?> </td>
                                <td> <?php echo $payment_confirmation; ?></td>
                                <td> <?php echo $shipping_status; ?></td>
                                <td> 

                                    <a href="order_details.php?invoice_no=<?php echo $invoice_no; ?>"  class="btn btn-primary btn-sm"> Order Details </a>
                                    


                                </td>
                                <td>
                                    
                                   <a href="productreceiver_details.php?invoice_no=<?php echo $invoice_no; ?>"  class="btn btn-primary btn-sm"> Cover details </a>
                                </td>

                                <td>
                                    
                                    <a href="confirm_orderShipped.php?invoice_no=<?php echo $invoice_no; ?>"  class="btn btn-primary btn-sm green"> Confirmed shipped </a>


                                </td>
                                
                            </tr><!-- tr finish -->
                            
                            <?php } ?>
                            
                        </tbody><!-- tbody finish -->
                        
                    </table><!-- table table-striped table-bordered table-hover finish -->
                </div><!-- table-responsive finish -->
            </div><!-- panel-body finish -->
            
        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->

<?php } ?>