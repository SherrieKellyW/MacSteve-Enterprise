<?php


include("includes/db.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>MacSteve Enterprise</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    

    <!--     inserted     -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

    <style type="text/css">
      tr td{
        padding-top:-10px!important;
        border: 1px solid #000;
      }
      @media print {
          .btn-print {
            display:none !important;
          }
      }
    </style>
    </head>
<body>

<?php    
if(isset($_GET['invoice_no'])){
    
    $invoice_no = $_GET['invoice_no'];
    
}
?>

<?php       

            
            $get_orderdetails = "select * from customer_orders where invoice_no = '$invoice_no'";

            $run_orderdetails = mysqli_query($con,$get_orderdetails); 
       
            $row_orderdetails = mysqli_fetch_array($run_orderdetails);

            $ordercustomer_id = $row_orderdetails['customer_id'];

            $order_id = $row_orderdetails['order_id'];

            $product_id = $row_orderdetails['product_id'];

            $product_title = $row_orderdetails['product_title'];

            $due_amount = $row_orderdetails['due_amount'];

            $invoice_number = $row_orderdetails['invoice_no'];

            $qty = $row_orderdetails['qty'];

            $shipping_county = $row_orderdetails['county'];

            $order_date = substr($row_orderdetails['order_date'],0,11);
            
            $get_productTitle = "select * from products where product_id = '$product_id'";

            $run_productTitle = mysqli_query($con,$get_productTitle);

            $row_productTitle = mysqli_fetch_array($run_productTitle);

            $product_unitPrice = $row_productTitle['product_price'];


            $get_customername= "select * from customers where customer_id='$ordercustomer_id'";
            
            $run_customername = mysqli_query($con,$get_customername);
            
            $row_customername = mysqli_fetch_array($run_customername);
            
            $customer_id = $row_customername ['customer_id'];

            $customer_name = $row_customername['customer_name'];

            $customer_contact = $row_customername['customer_contact'];

            $customer_city = $row_customername['customer_city'];


            $get_productreceiver = "select * from payments where invoice_no = '$invoice_no'";

            $run_productreceiver = mysqli_query($con,$get_productreceiver);

            $row_productreceiver = mysqli_fetch_array($run_productreceiver);

            $receiver_number = 'null';

            $receiver_firstname = 'null';

            $receiver_secondname = 'null';

            $receiver_thirdname = 'null';

            $receiver_idnumber = 'null';
     


           
        
 ?>














<div class="main">
            <div class="section section-basic">
                <div class="container">
                      

                         <br><br>
<center><!--  center Begin  -->
    
    <h1> <?php echo $customer_name;?>'s order! </h1>
    
    <p class="lead"> Order details</p>
    
    
</center><!--  center Finish  -->


<hr>


<div class="table-responsive"><!--  table-responsive Begin  -->
    
    <table class="table table-bordered table-hover"><!--  table table-bordered table-hover Begin  -->
        
        <thead><!--  thead Begin  -->
            
            <tr><!--  tr Begin  -->
                
                <th> BILL TO: </th>
                
                <th> INVOICE: </th>
                 

                
            </tr><!--  tr Finish  -->
            <tr>
                <td>Name: <?php echo $customer_name;?> 
                <h3></h3>Contact: <?php echo $customer_contact; ?>
                <h3></h3>County: <?php echo $customer_city; ?></td>
                <td>Invoice No: <?php echo $invoice_no;?> 
                <h3></h3>Order id: <?php echo $order_id; ?>
                <h3></h3>Order date: <?php echo $order_date; ?></td>
            </tr>
            
        </thead><!--  thead Finish  -->
        
        <tbody><!--  tbody Begin  -->





         </tbody><!--  tbody Finish  -->
        
    </table><!--  table table-bordered table-hover Finish  -->
    
</div><!--  table-responsive Finish  -->
                      <hr color="orange"> 
                
                <div class="col-md-12">
                <br>
            
                <div class="panel panel-success panel-size-custom">
                        <div class="panel-body">  

              <center>
              <h3>Receipt Total********Ksh <?php echo $due_amount?></h3>
<hr color="orange"> 

<div class="table-responsive"><!--  table-responsive Begin  -->
    
    <table class="table table-bordered table-hover"><!--  table table-bordered table-hover Begin  -->
        
        <thead><!--  thead Begin  -->
            
            <tr><!--  tr Begin  -->
                
                <th> ITEM: </th>
                <th> QTY: </th>
                <th> UNIT PRICE: </th>
                <th> AMOUNT: </th>

                
            </tr><!--  tr Finish  -->
            <tr>
                <td><?php echo $product_title;?></td>
                <td><?php echo $qty;?></td>
                <td><?php echo $product_unitPrice;?></td>
                <td><?php echo $due_amount;?></td>
            </tr>
            
        </thead><!--  thead Finish  -->
        
        <tbody><!--  tbody Begin  -->





         </tbody><!--  tbody Finish  -->
        
    </table><!--  table table-bordered table-hover Finish  -->
    
</div><!--  table-responsive Finish  -->

        
     <button type="button" class="btn btn-warning btn-round" onclick = "window.print()"><span class="now-ui-icons ui-1_check"></span> Print</button> 
     <a href="index.php?view_orders" ><button type="button" class="btn btn-success btn-round"><span class="now-ui-icons ui-1_check"></span> Back</button></a>
    
    </center>

                               </div>



                        </div>
                    </div> 
                </div>
            </div>
        </div>
<br><br><br><br>
<footer class="footer" data-background-color="black">
            <div class="container">
                <nav>
                    <ul>
                        <li>
                            <a href="" target="_blank">
                                MacSteve 
                            </a>
                        </li>
                        <li>
                                Enterprise
                        </li>
                    </ul>
                </nav>
                <div class="copyright">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script> MacSteve
                </div>
            </div>
        </footer>
    </div>

    </body>
<script src="./assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="./assets/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="./assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="./assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // the body of this function is in assets/js/now-ui-kit.js
        nowuiKit.initSliders();
    });

    function scrollToDownload() {

        if ($('.section-download').length != 0) {
            $("html, body").animate({
                scrollTop: $('.section-download').offset().top
            }, 1000);
        }
    }
</script>


   <!---  inserted  -->
    <!-- SlimScroll -->
    <script src="./plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="./plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./plugins/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./plugins/demo.js"></script>
    <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="./plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
      $(function () {
        $("#example1").DataTable({
        });
      });
    </script>
     <!--  inserted  -->

</html>


