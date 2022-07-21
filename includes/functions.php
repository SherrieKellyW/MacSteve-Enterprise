  <?php 

$db = mysqli_connect("localhost","root","","cosmetics_test");

/// begin getRealIpUser functions ///

function getRealIpUser(){
    
    switch(true){
            
            case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
            case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
            case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
            
            default : return $_SERVER['REMOTE_ADDR'];
            
    }
    
}

/// finish getRealIpUser functions /// 

/// begin add_cart functions ///

function add_cart(){
    
    global $db;
    
    if(isset($_GET['add_cart'])){
        
        $ip_add = getRealIpUser();

        $p_id = $_GET['add_cart'];
        
        $product_qty = $_POST['product_qty'];

        $get_product = "select * from products where product_id='$p_id'";
    
        $run_product = mysqli_query($db,$get_product);
    
        $row_products = mysqli_fetch_array($run_product);

        $pro_title = $row_products['product_title'];

        $pro_label = $row_products['product_label'];
        
        $p_cat_id = $row_products['p_cat_id'];

        $get_p_cat = "select * from product_categories where p_cat_id='$p_cat_id'";
    
        $run_p_cat = mysqli_query($db,$get_p_cat);
    
        $row_p_cat = mysqli_fetch_array($run_p_cat);
    
        $p_cat_title = $row_p_cat['p_cat_title'];


        
        $shipping_county = 'null';

        $check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
        $run_check = mysqli_query($db,$check_product);

                if(mysqli_num_rows($run_check)>0){
            
            echo "<script>alert('This product is already added in cart')</script>";
            echo "<script>window.open('index.php?insert_order','_self')</script>";
            
        }else{
            
            $query = "insert into cart (p_id,ip_add,qty,county) values ('$p_id','$ip_add','$product_qty','$shipping_county')";
            
            $run_query = mysqli_query($db,$query);
            
            echo "<script>window.open('index.php?insert_order','_self')</script>";
            
        }
         
        }

        }


/// finish add_cart functions ///

/// begin getPro functions ///

function getPro(){
    
    global $db;
    
    $get_products = "select * from products order by 1 DESC LIMIT 0,8";
    
    $run_products = mysqli_query($db,$get_products);
    
    while($row_products=mysqli_fetch_array($run_products)){
        
        $pro_id = $row_products['product_id'];
        
        $pro_title = $row_products['product_title'];
        
        $pro_price = $row_products['product_price'];
        $pro_sale_price = $row_products['product_sale'];
        
        $pro_img1 = $row_products['product_img1'];
        $pro_label = $row_products['product_label'];
        $manufacturer_id = $row_products['manufacturer_id'];

        $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";

        $run_manufacturer = mysqli_query($db,$get_manufacturer);
        $row_manufacturer =mysqli_fetch_array($run_manufacturer);

        $manufacturer_title = $row_manufacturer['manufacturer_title'];

       if($pro_label == "sale"){
        $product_price = "<del> Ksh $pro_price </del>";

        $product_sale_price = " / Ksh $pro_sale_price";
       
       }else{

        $product_price = " Ksh $pro_price ";

        $product_sale_price = "";
       }



        if ($pro_label=="") {
            
        }else{
            $product_label =

              "

             <a href='#' class ='label $pro_label'>

             <div class ='theLabel'> $pro_label </div>
             <div class ='labelBackground'> </div>

             </a>

           ";


        }
        echo "
        
        <div class='col-md-4 col-sm-6 single'>
        
            <div class='product'>
            
                <a href='details.php?pro_id=$pro_id'>
                
                    <img class='img-responsive' src='admin_area/product_images/$pro_img1'>
                
                </a>
                
                <div class='text'>

                <center>
                      
                      <p class='btn btn-primary'>$manufacturer_title </p>

                </center>
                
                    <h3>
            
                        <a href='details.php?pro_id=$pro_id'>

                            $pro_title

                        </a>
                    
                    </h3>
                    
                    <p class='price'>
                    
                        $product_price &nbsp;$product_sale_price
                    
                    </p>
                    
                    <p class='button'>
                    
                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                            View Details

                        </a>
                    
                        <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                            <i class='fa fa-shopping-cart'></i> Add to Cart

                        </a>
                    
                    </p>
                
                </div>

                 $product_label
            
            </div>
        
        </div>
        
        ";
        
    }
    
}

/// finish getPro functions ///

/// begin getPCats functions ///

function getPCats(){
    
    global $db;
    
    $get_p_cats = "select * from product_categories";
    
    $run_p_cats = mysqli_query($db,$get_p_cats);
    
    while($row_p_cats=mysqli_fetch_array($run_p_cats)){
        
        $p_cat_id = $row_p_cats['p_cat_id'];
        
        $p_cat_title = $row_p_cats['p_cat_title'];
        
        echo "
        
            <li>
            
                <a href='shop.php?p_cat=$p_cat_id'> $p_cat_title </a>
            
            </li>
        
        ";
        
    }
    
}
    
/// finish getPCats functions ///

/// begin getCats functions ///

function getCats(){
    
    global $db;
    
    $get_cats = "select * from categories";
    
    $run_cats = mysqli_query($db,$get_cats);
    
    while($row_cats=mysqli_fetch_array($run_cats)){
        
        $cat_id = $row_cats['cat_id'];
        
        $cat_title = $row_cats['cat_title'];
        
        echo "
        
            <li>
            
                <a href='shop.php?cat=$cat_id'> $cat_title </a>
            
            </li>
        
        ";
        
    }
    
}
    
/// finish getCats functions ///

/// begin getRealIpUser functions ///

function items(){
    
    global $db;
    
    $ip_add = getRealIpUser();
    
    $get_items = "select * from cart where ip_add='$ip_add'";
    
    $run_items = mysqli_query($db,$get_items);
    
    $count_items = mysqli_num_rows($run_items);
    
    echo $count_items;
    
}

/// finish getRealIpUser functions ///

/// begin total_price functions ///

function total_price(){
    
    global $db;
    
    $ip_add = getRealIpUser();
    
    $total = 0;
    
    $select_cart = "select * from cart where ip_add='$ip_add'";
    
    $run_cart = mysqli_query($db,$select_cart);
    
    while($record=mysqli_fetch_array($run_cart)){
        
        $pro_id = $record['p_id'];
        
        $pro_qty = $record['qty'];
        
        $get_price = "select * from products where product_id='$pro_id'";
        
        $run_price = mysqli_query($db,$get_price);
        
        while($row_price=mysqli_fetch_array($run_price)){
            
            $sub_total = $row_price['product_price']*$pro_qty;
            
            $total += $sub_total;
            
        }
        
    }
    
    echo "Ksh" . $total;
    
}

/// finish total_price functions ///

/// Begin getProducts(); functions ///

function getProducts(){

    global $db;
    $aWhere = array();

    /// Begin for Manufacturer ///
    
    if(isset($_REQUEST['man'])&&is_array($_REQUEST['man'])){

        foreach($_REQUEST['man'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'manufacturer_id='.(int)$sVal;

            }

        }

    }

    /// Finish for Manufacturer ///  

    /// Begin for Product Categories /// 

    if(isset($_REQUEST['p_cat'])&&is_array($_REQUEST['p_cat'])){

        foreach($_REQUEST['p_cat'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'p_cat_id='.(int)$sVal;

            }

        }

    }    

    /// Finish for Product Categories /// 

    /// Begin for Categories /// 

    if(isset($_REQUEST['cat'])&&is_array($_REQUEST['cat'])){

        foreach($_REQUEST['cat'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'cat_id='.(int)$sVal;

            }

        }

    }    

    /// Finish for Categories /// 

    $per_page=6;

    if(isset($_GET['page'])){

        $page = $_GET['page'];

    }else{
        $page=1;
    }

    $start_from = ($page-1) * $per_page;
    $sLimit = " order by 1 DESC LIMIT $start_from,$per_page";
    $sWhere = (count($aWhere)>0?' WHERE '.implode(' or ',$aWhere):'').$sLimit;
    $get_products = "select * from products ".$sWhere;
    $run_products = mysqli_query($db,$get_products);
    while($row_products=mysqli_fetch_array($run_products)){
        
        $pro_id = $row_products['product_id'];
        
        $pro_title = $row_products['product_title'];
        
        $pro_price = $row_products['product_price'];
        $pro_sale_price = $row_products['product_sale'];
        
        $pro_img1 = $row_products['product_img1'];
        $pro_label = $row_products['product_label'];
        $manufacturer_id = $row_products['manufacturer_id'];

        $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";

        $run_manufacturer = mysqli_query($db,$get_manufacturer);
        $row_manufacturer =mysqli_fetch_array($run_manufacturer);

        $manufacturer_title = $row_manufacturer['manufacturer_title'];

       if($pro_label == "sale"){
        $product_price = "<del> ksh $pro_price </del>";

        $product_sale_price = " / Ksh $pro_sale_price";
       
       }else{

        $product_price = " Ksh $pro_price ";

        $product_sale_price = "";
       }



        if ($pro_label=="") {
            
        }else{
            $product_label =

              "

             <a href='#' class ='label $pro_label'>

             <div class ='theLabel'> $pro_label </div>
             <div class ='labelBackground'> </div>

             </a>

           ";


        }
        echo "
        
        <div class='col-md-4 col-sm-6 center_responsive'>
        
            <div class='product'>
            
                <a href='details.php?pro_id=$pro_id'>
                
                    <img class='img-responsive' src='admin_area/product_images/$pro_img1'>
                
                </a>
                
                <div class='text'>

                <center>
                      
                      <p class='btn btn-primary'>$manufacturer_title </p>

                </center>
                
                    <h3>
            
                        <a href='details.php?pro_id=$pro_id'>

                            $pro_title

                        </a>
                    
                    </h3>
                    
                    <p class='price'>
                    
                        $product_price &nbsp;$product_sale_price
                    
                    </p>
                    
                    <p class='button'>
                    
                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                            View Details

                        </a>
                    
                        <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                            <i class='fa fa-shopping-cart'></i> Add to Cart

                        </a>
                    
                    </p>
                
                </div>

                 $product_label
            
            </div>
        
        </div>
        
        ";
        
    }

}

/// finish getProducts(); functions ///

/// begin getPaginator(); functions ///

function getPaginator(){

    global $db;

    $per_page=6;
    $aWhere = array();
    $aPath = '';

    /// Begin for Manufacturer ///
    
    if(isset($_REQUEST['man'])&&is_array($_REQUEST['man'])){

        foreach($_REQUEST['man'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'manufacturer_id='.(int)$sVal;
                $aPath .= 'man[]='.(int)$sVal.'&';

            }

        }

    }

    /// Finish for Manufacturer ///  

    /// Begin for Product Categories /// 

    if(isset($_REQUEST['p_cat'])&&is_array($_REQUEST['p_cat'])){

        foreach($_REQUEST['p_cat'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'p_cat_id='.(int)$sVal;
                $aPath .= 'p_cat[]='.(int)$sVal.'&';

            }

        }

    }    

    /// Finish for Product Categories /// 

    /// Begin for Categories /// 

    if(isset($_REQUEST['cat'])&&is_array($_REQUEST['cat'])){

        foreach($_REQUEST['cat'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'cat_id='.(int)$sVal;
                $aPath .= 'cat[]='.(int)$sVal.'&';

            }

        }

    }    

    /// Finish for Categories ///   
    
    $sWhere = (count($aWhere)>0?' WHERE '.implode(' or ',$aWhere):'');
    $query = "select * from products".$sWhere;
    $result = mysqli_query($db,$query);
    $total_records = mysqli_num_rows($result);
    $total_pages = ceil($total_records / $per_page);

    echo "<li> <a href='shop.php?page=1";
    if(!empty($aPath)){

        echo "KSh".$aPath;

    }

    echo "'>".'First Page'."</a></li>";

    for($i=1; $i<=$total_pages; $i++){

        echo "<li> <a href='shop.php?page=".$i.(!empty($aPath)?'&'.$aPath:'')."'>".$i."</a></li>";

    };

    echo "<li> <a href='shop.php?page=$total_pages";

    if(!empty($aPath)){

        echo "&".$aPath;

    }

    echo "'>".'Last Page'."</a></li>";

}

/// finish getPaginator(); functions ///


function searchProduct(){

    global $db;

    if (isset($_POST['search'])){
                                                            
     $search=$_POST['user_query'];
                                                                
     $querry="SELECT * FROM products  WHERE product_title LIKE '%$search%' OR product_keywords LIKE '%$search%' OR product_desc LIKE '%$search%' ORDER BY 1 DESC LIMIT 0,8 ";
     $runn_check = mysqli_query($db,$querry);

    while($row_products=mysqli_fetch_array($runn_check)){
      
        $pro_id = $row_products['product_id'];
        
        $pro_title = $row_products['product_title'];
        
        $pro_price = $row_products['product_price'];
         $prod_qty = $row_products['product_quantity'];

        $pro_sale_price = $row_products['product_sale'];
        
        $pro_img1 = $row_products['product_img1'];
        $pro_label = $row_products['product_label'];
        $manufacturer_id = $row_products['manufacturer_id'];

        $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";

        $run_manufacturer = mysqli_query($db,$get_manufacturer);
        $row_manufacturer =mysqli_fetch_array($run_manufacturer);

        $manufacturer_title = $row_manufacturer['manufacturer_title'];

       if($pro_label == "sale"){
        $product_price = "<del> Ksh $pro_price </del>";

        $product_sale_price = " / Ksh $pro_sale_price";
       
       }else{

        $product_price = " Ksh $pro_price ";

        $product_sale_price = "";
       }



        if ($pro_label=="") {
            
        }else{
            $product_label =

              "

             <a href='#' class ='label $pro_label'>

             <div class ='theLabel'> $pro_label </div>
             <div class ='labelBackground'> </div>

             </a>

           ";


        }
        echo "
        
        <div class='col-md-3 col-sm-6 center-responsive'>
        
            <div class='product'>
            
                <a href='details.php?pro_id=$pro_id'>
                
                    <img class='img-responsive' src='admin_area/product_images/$pro_img1'>
                
                </a>
                
                <div class='text'>

                <center>
                      
                      <p class='btn btn-primary'>$manufacturer_title </p>

                </center>
                
                    <h3>
            
                        <a href='details.php?pro_id=$pro_id'>

                            $pro_title

                        </a>
                    
                    </h3>
                    
                    <p class='price'>
                    
                        $product_price &nbsp;$product_sale_price
                    
                    </p>
                    
                    <p class='button'>
                    
                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                            View Details

                        </a>
                    
                        <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                            <i class='fa fa-shopping-cart'></i> Add to Cart

                        </a>
                    
                    </p>
                
                </div>

                 $product_label
            
            </div>
        
        </div>
        
        ";
                   }
                 }
  }


function searchProductShop(){

    global $db;

    if (isset($_POST['search'])){
                                                            
     $search=$_POST['user_query'];
                                                                
     $querry="SELECT * FROM products  WHERE product_title LIKE '%$search%' OR product_keywords LIKE '%$search%' OR product_desc LIKE '%$search%' ORDER BY 1 DESC LIMIT 0,6 ";
     $runn_check = mysqli_query($db,$querry);

    while($row_products=mysqli_fetch_array($runn_check)){
      
        $pro_id = $row_products['product_id'];
        
        $pro_title = $row_products['product_title'];
        
        $pro_price = $row_products['product_price'];
         $prod_qty = $row_products['product_quantity'];

        $pro_sale_price = $row_products['product_sale'];
        
        $pro_img1 = $row_products['product_img1'];
        $pro_label = $row_products['product_label'];
        $manufacturer_id = $row_products['manufacturer_id'];

        $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";

        $run_manufacturer = mysqli_query($db,$get_manufacturer);
        $row_manufacturer =mysqli_fetch_array($run_manufacturer);

        $manufacturer_title = $row_manufacturer['manufacturer_title'];

       if($pro_label == "sale"){
        $product_price = "<del> Ksh $pro_price </del>";

        $product_sale_price = " / Ksh $pro_sale_price";
       
       }else{

        $product_price = " Ksh $pro_price ";

        $product_sale_price = "";
       }



        if ($pro_label=="") {
            
        }else{
            $product_label =

              "

             <a href='#' class ='label $pro_label'>

             <div class ='theLabel'> $pro_label </div>
             <div class ='labelBackground'> </div>

             </a>

           ";


        }
        echo "
        
        <div class='col-md-3 col-sm-6 center-responsive'>
        
            <div class='product'>
            
                <a href='details.php?pro_id=$pro_id'>
                
                    <img class='img-responsive' src='admin_area/product_images/$pro_img1'>
                
                </a>
                
                <div class='text'>

                <center>
                      
                      <p class='btn btn-primary'>$manufacturer_title </p>

                </center>
                
                    <h3>
            
                        <a href='details.php?pro_id=$pro_id'>

                            $pro_title

                        </a>
                    
                    </h3>
                    
                    <p class='price'>
                    
                        $product_price &nbsp;$product_sale_price
                    
                    </p>
                    
                    <p class='button'>
                    
                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                            View Details

                        </a>
                    
                        <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                            <i class='fa fa-shopping-cart'></i> Add to Cart

                        </a>
                    
                    </p>
                
                </div>

                 $product_label
            
            </div>
        
        </div>
        
        ";
                   }
                 }
  }


?>