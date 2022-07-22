<?php 

    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
    <div class="row"><!-- row Begin -->
    
    <div class="col-lg-12"><!-- col-lg-12 Begin -->
        
        <ol class="breadcrumb"><!-- breadcrumb Begin -->
            
            <li class="active"><!-- active Begin -->
                
                <i class="fa fa-dashboard"></i> Dashboard / Insert Customer
                
            </li><!-- active Finish -->
            
        </ol><!-- breadcrumb Finish -->
        
    </div><!-- col-lg-12 Finish -->
    
</div><!-- row Finish -->
    <div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
           <div class="col-md-12"><!-- col-md-12 Begin -->
               
               
           </div><!-- col-md-12 Finish -->
           
           
           
           <div class="col-md-12"><!-- col-md-12 Begin -->
               
               <div class="box"><!-- box Begin -->
                   
                   <div class="box-header"><!-- box-header Begin -->
                       
                       <center><!-- center Begin -->
                           
                           <h2> Add new user </h2>
                           
                       </center><!-- center Finish -->
                       
                       <form method="post" enctype="multipart/form-data"><!-- form Begin -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Your Name</label>
                               
                               <input type="text" class="form-control" name="c_name" >
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Your Email</label>
                               
                               <input type="text" class="form-control" name="c_email" >
                               
                           </div><!-- form-group Finish -->
                           
                          
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label> Country</label>
                               
                               <input type="text" class="form-control" name="c_country" >
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label> City</label>
                               
                               <input type="text" class="form-control" name="c_city">
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label> Contact</label>
                               
                               <input type="text" class="form-control" name="c_contact" >
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label> Address</label>
                               
                               <input type="text" class="form-control" name="c_address">
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label> Profile Picture</label>
                               
                               <input type="file" class="form-control form-height-custom" name="c_image" >
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="text-center"><!-- text-center Begin -->
                               
                               <button type="submit" name="register" class="btn btn-primary">
                               
                               <i class="fa fa-user-md"></i> Add customer
                               
                               </button>
                               
                           </div><!-- text-center Finish -->
                           
                       </form><!-- form Finish -->
                       
                   </div><!-- box-header Finish -->
                   
               </div><!-- box Finish -->
               
           </div><!-- col-md-12 Finish -->
           
       </div><!-- container Finish -->
   </div><!-- #content Finish -->
   
    
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
    
    
</body>
</html>


<?php 

if(isset($_POST['register'])){
    
    $c_name = $_POST['c_name'];
    
    $c_email = $_POST['c_email'];
    

    
    $c_country = $_POST['c_country'];
    
    $c_city = $_POST['c_city'];
    
    $c_contact = $_POST['c_contact'];
    
    $c_address = $_POST['c_address'];
    
    $c_image = $_FILES['c_image']['name'];
    
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    
    
    move_uploaded_file($c_image_tmp,"./admin_images/$c_image");
    
    $insert_customer = "insert into customers (customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image,customer_ip) values ('$c_name','$c_email','x','$c_country','$c_city','$c_contact','$c_address','$c_image','223')";
    
    $run_customer = mysqli_query($con,$insert_customer);
    
    if($run_customer){
        
        
        echo "<script>alert(Customer has been added Sucessfully')</script>";
        
        echo "<script>window.open('index.php?view_customers','_self')</script>";
        
    }
    
}

?>

<?php } ?>