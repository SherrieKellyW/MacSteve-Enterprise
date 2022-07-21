<?php 

    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Insert Order</title>
    <link rel="stylesheet" href="css/styleOrders.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<div class="row"><!-- row Begin -->
    
    <div class="col-lg-12"><!-- col-lg-12 Begin -->
        
        <ol class="breadcrumb"><!-- breadcrumb Begin -->
            
            <li class="active"><!-- active Begin -->
                
                <i class="fa fa-dashboard"></i> Dashboard / Insert Order
                
            </li><!-- active Finish -->
            
        </ol><!-- breadcrumb Finish -->
        
    </div><!-- col-lg-12 Finish -->
    
</div><!-- row Finish -->
       
<div class="row"><!-- row Begin -->
    
    <div class="col-lg-4"><!-- col-lg-12 Begin -->
        
        <div class="panel panel-default"><!-- panel panel-default Begin -->
            
           <div class="panel-heading"><!-- panel-heading Begin -->
               
               <h3 class="panel-title"><!-- panel-title Begin -->
                   
                   <i class="fa fa-money fa-fw"></i> Insert Order 
                   
               </h3><!-- panel-title Finish -->
               
           </div> <!-- panel-heading Finish -->
           
           <div class="panel-body"><!-- panel-body Begin -->
               
               <form method="post" class="form-horizontal" enctype="multipart/form-data"><!-- form-horizontal Begin -->

               <div class="form-group"><!-- form-group Begin -->
                       
                       <label class="col-md-3 control-label"> Customer Name </label> 
                       
                       <div class="col-md-6"><!-- col-md-6 Begin -->
                           
                           <select name="customer"  class="form-control"><!-- form-control Begin -->
                               
                               <option selected disabled> Select Customer </option>
                               
                               <?php 
                               $get_customer = "select * from customers";
                               $run_customer = mysqli_query($con,$get_customer);
                               
                               while ($row_customer=mysqli_fetch_array($run_customer)){
                                   
                                   $customer_id = $row_customer['customer_id'];
                                   $customer_email = $row_customer['customer_email'];
                                   $customer_name = $row_customer['customer_name'];
                                   echo "
                                   
                                   <option  value='$customer_email'> $customer_name </option>
                                   
                                   ";
                                   
                               }
                               
                               ?>
                               
                           </select><!-- form-control Finish -->
                           
                       </div><!-- col-md-6 Finish -->
                        
                    </div><!-- form-group Finish -->
                                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> Product Name </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <select name="product"  class="form-control"><!-- form-control Begin -->
                              
                              <option selected disabled> Select product </option>
                              
                              <?php 
                              $get_product = "select * from products";
                              $run_product = mysqli_query($con,$get_product);
                              
                              while ($row_product=mysqli_fetch_array($run_product)){
                                  
                                  $product_id = $row_product['product_id'];
                                  $product_title = $row_product['product_title'];
                                  
                                  echo "
                                  
                                  <option  value='$product_id'> $product_title </option>
                                  
                                  ";
                                  
                              }
                              
                              ?>
                              
                          </select><!-- form-control Finish -->
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label">Quantity </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                      <div class="input">
                      <?php 
                              
                              $get_product = "select * from products where product_id ='$product_id'";
                              $run_productx = mysqli_query($con,$get_product);
                              
                              while ($row_product=mysqli_fetch_array($run_productx)){
                                  $p_quantity = $row_product['product_quantity'];                                
                                  echo "<select class='btn btn-primary dropdown-toggle  quantity='1' name='product_qty' id='product_qty'> ";
                                          $i=1; $p_quantity =$p_quantity;
                                          while ($i <= 20 ){
                                          echo "<option value=".$i.">".$i."</option>";
                                             $i++;
                                           }
                                          echo "</select>";
                                  
                              }
                              
                              ?>
                                        </div>
                         
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"></label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input name="submit" value="Add to cart" type="submit" class="btn btn-primary form-control">
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
               </form><!-- form-horizontal Finish -->
               
           </div><!-- panel-body Finish -->
            
        </div><!-- canel panel-default Finish -->
        
    </div><!-- col-lg-12 Finish -->
    <div id="content"><!-- #content Begin -->
    <div id="cart" class="col-md-8"><!-- col-md-9 Begin -->
               
               <div class="box"><!-- box Begin -->
                   
                   <form action="index.php?insert_order" method="post" enctype="multipart/form-data"><!-- form Begin -->
                       
                       <h1>Order Summary</h1>
                       
                      
                       
                       <p class="text-muted">You currently have 0 item(s) in your cart</p>
                       
                       <div class="table-responsive"><!-- table-responsive Begin -->
                           
                           <table class="table"><!-- table Begin -->
                               
                               <thead><!-- thead Begin -->
                                   
                                   <tr><!-- tr Begin -->
                                       
                                       <th colspan="2">Product</th>
                                       <th>Quantity</th>
                                       <th>Unit Price</th>                                   
                                       <th colspan="1">Delete</th>
                                       <th colspan="2">Sub-Total</th>
                                       
                                   </tr><!-- tr Finish -->
                                   
                               </thead><!-- thead Finish -->
                               
                               <tbody><!-- tbody Begin -->
                                  
                                  <?php 
                                   
                                   $total = 0;
                                   $select_cart = "select * from cart";
                       
                                   $run_cart = mysqli_query($con,$select_cart);
                                   
                                   $count = mysqli_num_rows($run_cart);
                                   while($row_cart = mysqli_fetch_array($run_cart)){
                                       
                                     $pro_id = $row_cart['p_id'];
                                       
                                     $shipping_county = $row_cart['county'];
                                       
                                     $pro_qty = $row_cart['qty'];
                                       
                                       $get_products = "select * from products where product_id='$pro_id'";
                                       
                                       $run_products = mysqli_query($con,$get_products);
                                       
                                       while($row_products = mysqli_fetch_array($run_products)){
                                           
                                           $product_title = $row_products['product_title'];

                                            $pro_sale_price = $row_products['product_sale']; 
                                           
                                           $product_img1 = $row_products['product_img1'];
                                           
                                           $only_price = $row_products['product_price'];
                                           
                                           $sub_total = $row_products['product_price']*$pro_qty;
                                           
                                           $total += $sub_total;
                                           
                                   ?>
                                   
                                   <tr><!-- tr Begin -->
                                       
                                       <td>
                                           
                                           <img class="img-responsive" src="product_images/<?php echo $product_img1; ?>" alt="Product 3a">
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           <?php echo $product_title; ?>
                                           
                                       </td>
                                       
                                       <td>
                                          
                                           <?php echo $pro_qty; ?>
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           <?php echo $only_price; ?>
                                           
                                       </td>
                                       
                                    
                                       
                                       <td>
                                           
                                           <input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>">
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           Ksh <?php echo $sub_total; ?>
                                           
                                       </td>
                                       
                                   </tr><!-- tr Finish -->
                                   
                                   <?php } } ?>
                                   
                               </tbody><!-- tbody Finish -->
                               
                               <tfoot><!-- tfoot Begin -->
                                   
                                   <tr><!-- tr Begin -->
                                       
                                       <th colspan="5">Total</th>
                                       <th colspan="2">Ksh <?php echo $total; ?></th>
                                       
                                   </tr><!-- tr Finish -->
                                   
                               </tfoot><!-- tfoot Finish -->
                               
                           </table><!-- table Finish -->
                           
                       </div><!-- table-responsive Finish -->
                       
                       <div class="box-footer"><!-- box-footer Begin -->
                           
                           
                           
                           <div class="pull-right"><!-- pull-right Begin -->
                               
                               <button type="submit" name="update" value="Update Cart" class="btn btn-default"><!-- btn btn-default Begin -->
                                   
                                   <i class="fa fa-refresh"></i> Update Cart
                                   
                               </button><!-- btn btn-default Finish -->
                                                       
                               <button type="submit" name="checkout" value="checkout order" class="btn btn-primary"><!-- btn btn-default Begin -->
                                   
                                   <i class="fa fa-note"></i> Proceed Checkout
                                   
                               </button><!-- btn btn-default Finish -->
                               
                           </div><!-- pull-right Finish -->
                           
                       </div><!-- box-footer Finish -->
                       
                   </form><!-- form Finish -->
                   
               </div><!-- box Finish -->
               <?php 
               
                function update_cart(){
                    
                    global $con;
                    
                    if(isset($_POST['update'])){
                        
                        foreach($_POST['remove'] as $remove_id){
                            
                            $delete_product = "delete from cart where p_id='$remove_id'";
                            
                            $run_delete = mysqli_query($con,$delete_product);
                            
                            if($run_delete){
                                
                                echo "<script>window.open('index.php?insert_order','_self')</script>";
                                
                            }
                            
                        }
                        
                    }
                    
                }
               
               echo @$up_cart = update_cart();
               
               ?>

           <?php 
               
               function checkout_order(){
                   
                   global $con;
                   
                   if(isset($_POST['checkout'])){
                       
                    $select_cart = "select * from cart";
                    $invoice_no = mt_rand();
                    $run_cart = mysqli_query($con,$select_cart);
                    
                    $count = mysqli_num_rows($run_cart);
                    while($row_cart = mysqli_fetch_array($run_cart)){
                        
                      $pro_id = $row_cart['p_id'];
                        
                      $shipping_county = $row_cart['county'];

                      $c_email =   $row_cart['customer_email'];   

                      $query2=mysqli_query($con,"SELECT * FROM customers WHERE customer_email='$c_email'") or die (mysqli_error());
                      $row2=mysqli_fetch_array($query2);
                      $customer_id=$row2['customer_id'];
                      $customer_name=$row2['customer_name'];
                      $customer_email=$row2['customer_email'];
                        
                      $pro_qty = $row_cart['qty'];
                        
                        $get_products = "select * from products where product_id='$pro_id'";
                        
                        $run_products = mysqli_query($con,$get_products);
                        mysqli_query($con,"UPDATE products SET product_quantity = product_quantity - $pro_qty WHERE product_id ='$pro_id'");
                        
                        while($row_products = mysqli_fetch_array($run_products)){
                            
                            $product_title = $row_products['product_title'];
                           
                            $only_price = $row_products['product_price'];
                            
                            $sub_total = $row_products['product_price']*$pro_qty;
                            
                            $total += $sub_total;
                             



                            $insert_customer_order = "insert into customer_orders (customer_id,due_amount,invoice_no,product_id,product_title,qty,county,order_date,order_status) values ('$customer_id','$sub_total','$invoice_no','$pro_id','$product_title','$pro_qty','$shipping_county',NOW(),'complete')";
        
                            $run_customer_order = mysqli_query($con,$insert_customer_order);
                    
                            
                            
                    
                            $insert_pending_order = "insert into pending_orders (customer_id,invoice_no,product_id,qty,county,order_status) values ('$customer_id','$invoice_no','$pro_id','$pro_qty','$shipping_county','pending')";
                            
                            $run_pending_order = mysqli_query($con,$insert_pending_order);
                    
                            
                            
                            $delete_cart = "delete from cart where customer_email='$c_email'";
                            
                            $run_delete = mysqli_query($con,$delete_cart);
                            
                            echo "<script>alert('Your orders have been submitted')</script>";
                            
                            echo "<script>window.open('index.php?insert_order','_self')</script>";


                            
                        }
                    }
                       
                   }
                   
               }
              
              echo @$up_cart = checkout_order();
              
              ?>
               
           </div><!-- col-md-9 Finish -->
        </div>
</div><!-- row Finish -->


   
    <script src="js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea'});</script>
</body>
</html>


<?php 

if(isset($_POST['submit'])){
    $customer_email = $_POST['customer'];
    $product_id = $_POST['product'];
    $product_quantity = $_POST['product_qty'];
    
    $insert_product = "insert into cart (p_id,customer_email,qty) values ('$product_id','$customer_email','$product_quantity')";
    
    $run_product = mysqli_query($con,$insert_product);
    if($run_product){
        
        echo "<script>alert('Product has been inserted sucessfully')</script>";
        echo "<script>window.open('index.php?insert_order','_self')</script>";
        
    }
    
}

?>


<?php } ?>