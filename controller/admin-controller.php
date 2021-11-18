
<?php
   // Include config.php file
   include_once('../model/admin-model.php');
   $dbObj = new Database1();



//-----------------------------------product--------------------------------------------------------------

// product insert script

if(isset($_POST['create'])){
	if(!isset($_POST['product_title']) || empty($_POST['product_title'])){
		echo json_encode(array('error'=>'Title Field is Empty.')); exit;
	}elseif(!isset($_POST['product_cat']) || empty($_POST['product_cat'])){
		echo json_encode(array('error'=>'Category Field is Empty.')); exit;
	}elseif(!isset($_POST['product_sub_cat']) || empty($_POST['product_sub_cat'])){
		echo json_encode(array('error'=>'Sub Category Field is Empty.')); exit;
	}elseif(!isset($_POST['product_desc']) || empty($_POST['product_desc'])){
		echo json_encode(array('error'=>'Description Field is Empty.')); exit;
	}elseif(!isset($_POST['product_price']) || empty($_POST['product_price'])){
		echo json_encode(array('error'=>'Price Field is Empty.')); exit;
	}elseif(!isset($_POST['product_qty']) || empty($_POST['product_qty'])){
        echo json_encode(array('error'=>'Quantity Field is Empty.')); exit;
    }elseif(!isset($_POST['product_status']) || empty($_POST['product_status'])){
		echo json_encode(array('error'=>'Status Field is Empty.')); exit;
	}elseif(!isset($_FILES['featured_img']['name']) || empty($_FILES['featured_img']['name'])){
		echo json_encode(array('error'=>'Image Field is Empty.')); exit;
    }else{

		$errors= array();
        /* get details of the uploaded file */
        $file_name = $_FILES['featured_img']['name'];
        $file_size = $_FILES['featured_img']['size'];
        $file_tmp = $_FILES['featured_img']['tmp_name'];
        $file_type = $_FILES['featured_img']['type'];
        $file_name = str_replace(array(',',' '),'',$file_name);
        $file_ext = explode('.',$file_name);
        $file_ext = strtolower(end($file_ext));
        $extensions = array("jpeg","jpg","png");
        if(in_array($file_ext,$extensions)=== false){
            $errors[]='<div class="alert alert-danger"> extension not allowed, please choose a JPEG or PNG file.</div>';
        }
        if($file_size > 2097152){
            $errors[]='<div class="alert alert-danger">File size must be exactely 2 MB</div>';
        }
        // check image errors
        if(!empty($errors)){
        	echo json_encode($errors); exit;
        }else{
        	
            $file_name = time().str_replace(array(' ','_'), '-', $file_name);

            if(isset($_POST['product_brand']) && !empty($_POST['product_brand'])){
    			$product_brand = $_POST['product_brand'];
	    	}else{
				$product_brand = '0';
	    	}
		    	
        

        	
            $product_title = $_POST['product_title'];
            $product_code = uniqid();
            $product_cat = $_POST['product_cat'];
            $product_sub_cat = $_POST['product_sub_cat'];
            $product_brand = $product_brand;
            $featured_image = $file_name;
            $product_desc = $_POST['product_desc'];
            $product_price = $_POST['product_price'];
            $qty = $_POST['product_qty'];
            $product_status = $_POST['product_status'];
        	

        	$exist = $dbObj->isExist($product_title);
        	// print_r($exist);die;
        	if(empty($exist)){
                $response=	 $dbObj->insertProduct($product_code,$product_cat,$product_sub_cat,$product_brand,$product_title,$product_price,$product_desc,$featured_image,$qty,$product_status);
        	
                if($response){
        			/* directory in which the uploaded file will be moved */
            		move_uploaded_file($file_tmp,"/var/www/html/Demo/product-images/".$file_name);

            		echo json_encode(array('success'=>$response)); exit;
        		}
        		
        	}else{
                echo json_encode(array('error'=>'Title is Already Exists.')); exit;
        	}
        }
    }
}


if (isset($_POST['action']) && $_POST['action'] == "deleteProduct") {
    
    $id = $_POST['delete_id'];
    $dbObj->deleteProduct($id);

    echo json_encode(['code'=>200]);
  
} 

// product update script
// ============================
if(isset($_POST['update'])){
   
	if(!isset($_POST['product_id']) || empty($_POST['product_id'])){
       
		echo json_encode(array('error'=>'Product ID is missing.')); exit;
	}elseif(!isset($_POST['product_title']) || empty($_POST['product_title'])){
		echo json_encode(array('error'=>'Title Field is Empty.')); exit;
	}elseif(!isset($_POST['product_cat']) || empty($_POST['product_cat'])){
		echo json_encode(array('error'=>'Category Field is Empty.')); exit;
	}elseif(!isset($_POST['product_sub_cat']) || empty($_POST['product_sub_cat'])){
		echo json_encode(array('error'=>'Sub Category Field is Empty.')); exit;
	}elseif(!isset($_POST['product_desc']) || empty($_POST['product_desc'])){
		echo json_encode(array('error'=>'Description Field is Empty.')); exit;
	}elseif(!isset($_POST['product_price']) || empty($_POST['product_price'])){
		echo json_encode(array('error'=>'Price Field is Empty.')); exit;
	}elseif(!isset($_POST['product_qty']) || empty($_POST['product_qty'])){
        echo json_encode(array('error'=>'Quantity Field is Empty.')); exit;
    }elseif(!isset($_POST['product_status']) || empty($_POST['product_status'])){
       
        echo json_encode(array('error'=>'Status Field is Empty.')); exit;
       
	}else if(empty($_POST['old_image']) && empty($_FILES['new_image']['name'])){
     
        echo json_encode(array('error'=>'Image Field is Empty.')); exit;
    }else{

     
        if(!empty($_POST['old_image'])  && empty($_FILES['new_image']['name'])){
            $file_name = $_POST['old_image'];
           
        }else if(!empty($_POST['old_image']) && !empty($_FILES['new_image']['name'])){
          
            $errors= array();
             /* get details of the uploaded file */
            $file_name = $_FILES['new_image']['name'];
            $file_size =$_FILES['new_image']['size'];
            $file_tmp =$_FILES['new_image']['tmp_name'];
            $file_type=$_FILES['new_image']['type'];
            $file_name = str_replace(array(',',' '),'',$file_name);
            $file_ext=explode('.',$file_name);
            $file_ext=strtolower(end($file_ext));
            $extensions= array("jpeg","jpg","png");
            if(in_array($file_ext,$extensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }
            if($file_size > 2097152){
                $errors[]='File size must be excately 2 MB';
            }
            if(file_exists("/var/www/html/Demo/product-images/".$_POST{'old_image'})){
                unlink("/var/www/html/Demo/product-images/".$_POST{'old_image'});
            }
            $file_name = time().str_replace(array(' ','_'), '-', $file_name);

        }else if(empty($_POST['old_image']) && !empty($_FILES['new_image']['name'])){
          
            $errors= array();
             /* get details of the uploaded file */
            $file_name = $_FILES['new_image']['name'];
            $file_size =$_FILES['new_image']['size'];
            $file_tmp =$_FILES['new_image']['tmp_name'];
            $file_type=$_FILES['new_image']['type'];
            $file_name = str_replace(array(',',' '),'',$file_name);
            $file_ext=explode('.',$file_name);
            $file_ext=strtolower(end($file_ext));
            $extensions= array("jpeg","jpg","png");
            if(in_array($file_ext,$extensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }
            if($file_size > 2097152){
                $errors[]='File size must be excately 2 MB';
            }
            $file_name = time().str_replace(array(' ','_'), '-', $file_name);
        }

        if(!empty($errors)){
    	   echo json_encode($errors); exit;
        }else{
           

            if(isset($_POST['product_brand']) && !empty($_POST['product_brand'])){
    			$product_brand = $_POST['product_brand'];
	    	}else{
				$product_brand = '0';
	    	}
        	
      
            $product_title = $_POST['product_title'];
            $product_cat = $_POST['product_cat'];
            $product_sub_cat = $_POST['product_sub_cat'];
            $product_brand = $product_brand;
            $featured_image = $file_name;
            $product_desc = $_POST['product_desc'];
            $product_price = $_POST['product_price'];
            $qty = $_POST['product_qty'];
            $product_status = $_POST['product_status'];
        	$id = $_POST['product_id'];

    		$response = $dbObj->updateProduct($product_cat,$product_sub_cat,$product_brand,$product_title,$product_price,$product_desc,$featured_image,$qty,$product_status,$id);
    		
            
    		if(!empty($response)){
              
    		
    			if(!empty($_FILES['new_image']['name'])){
                   
    				/* directory in which the uploaded file will be moved */
                    move_uploaded_file($file_tmp,"/var/www/html/Demo/product-images/".$file_name);
                }
        		echo json_encode(array('success'=>$response[0])); exit;
    		}
        }
    }
}
   //-----------------------------------------Category------------------------------------------
   // Insert Record   
   if (isset($_POST['action']) && $_POST['action'] == "categoryInsert") {
   
     $catTitleMsg = "";

    /* CAT NAME */
    if (empty($_POST["cat_title"])) {
        
        $catTitleMsg = "Category is required";
    } else {
        $title_nme = $_POST["cat_title"];
    }
    //print_r($_POST);die;
    $dbObj->insertCat($title_nme);
        
 
    if(empty($catTitleMsg) ){
        $msg = "cat_title: ".$title_nme;
        echo json_encode(['code'=>200, 'msg'=>$msg]);
        exit;
    }
   $arr = array(
    
    "catTitleMsg"=>$catTitleMsg
    
   );

    echo json_encode( $arr);
    
}


if (isset($_POST['action']) && $_POST['action'] == "delete") {
    
        $id = $_POST['delete_id'];
        $dbObj->deleteCat($id);
   
        echo json_encode(['code'=>200]);
      
	} 


    
    if( isset($_POST['updateCategory']) ){
      
    	if(!isset($_POST['cat_id']) || empty($_POST['cat_id'])){
    		echo json_encode(array('error'=>'ID is Empty.')); exit;
    	}if(!isset($_POST['cat_name']) || empty($_POST['cat_name'])){
    		echo json_encode(array('error'=>'Category Field is Empty.')); exit;
    	}else{
           
    		$cat_id = $_POST['cat_id'];
    		$cat_name = $_POST['cat_name'];

    		$response =	$dbObj->updateCateRecord($cat_name,$cat_id);
    	 
           // print_r($response);die;
    		if(!empty($response)){
              //  print_r($_POST);die;
    			echo json_encode(array('success'=>$response)); exit;
    		}
    	}
    }

//---------------------------------------sub-category----------------------------------------------


 // Insert Record   
 if (isset($_POST['action']) && $_POST['action'] == "SubcategoryInsert") {
   // print_r($_POST);die;
    $catTitleMsg = $subCatMsg = "";
  
   /* CAT NAME */
   if (empty($_POST["sub_cat_title"])) {
       
       $subCatMsg = "Sub Category is required";
   } else {
       $sub_cat_title = $_POST["sub_cat_title"];
   }
   if (empty($_POST["cat_parent"])) {
       
    $catTitleMsg = "Category is required";
} else {
    $cat_parent = $_POST["cat_parent"];
}
  
   $dbObj->insertSubCat($sub_cat_title, $cat_parent);
       

   if(empty($catTitleMsg) &&  empty($subCatMsg)){
       $msg = "cat_parent: ".$cat_parent. " sub_cat_title:".$sub_cat_title;
       echo json_encode(['code'=>200, 'msg'=>$msg]);
       exit;
   }
  $arr2 = array(
   
   "catTitleMsg"=>$catTitleMsg,
   "subCatMsg"=>$subCatMsg
   
  );

   echo json_encode( $arr2);
   
}


if (isset($_POST['action']) && $_POST['action'] == "deleteSubCategory") {
    
    $id = $_POST['delete_id'];
    $dbObj->deleteSubCat($id);

    echo json_encode(['code'=>200]);
  
} 


if( isset($_POST['updateSubcategory']) ){

    
    if(!isset($_POST['sub_cat_id']) || empty($_POST['sub_cat_id'])){
        echo json_encode(array('error'=>'ID is Empty.')); exit;
    }elseif(!isset($_POST['sub_cat_name']) || empty($_POST['sub_cat_name'])){
        echo json_encode(array('error'=>'Title Field is Empty.'));
    }elseif(!isset($_POST['parent_cat']) || empty($_POST['parent_cat'])){
        echo json_encode(array('error'=>'Parent Category Field is Empty.'));
    }else{
        
      
        $cat_id = $_POST['sub_cat_id'];
        $cat_name = $_POST['sub_cat_name'];
        $parent_cat = $_POST['parent_cat'];

        $response =  $dbObj->updateSubCateRecord($cat_id,$cat_name,$parent_cat);
      
        if(!empty($response)){
           // print_r($_POST);die;
      
            echo json_encode(array('success'=>$response)); exit;
        }
    }
}
//---------------------------------------Brand--------------------------------------------




 // Insert Record   
 if (isset($_POST['action']) && $_POST['action'] == "brandInsert") {
    // print_r($_POST);die;
     $catTitleMsg = $brandMsg = "";
   
    /* CAT NAME */
    if (empty($_POST["brand_title"])) {
        
        $brandMsg = "Brand is required";
    } else {
        $brand_title = $_POST["brand_title"];
    }
    if (empty($_POST["brand_cat"])) {
        
     $catTitleMsg = "Category is required";
 } else {
     $brand_cat = $_POST["brand_cat"];
 }
   
    $dbObj->insertBrand($brand_title, $brand_cat);
        
 
    if(empty($catTitleMsg) &&  empty($brandMsg)){
        $msg = "brand_title: ".$brand_title. " brand_cat:".$brand_cat;
        echo json_encode(['code'=>200, 'msg'=>$msg]);
        exit;
    }
   $arr2 = array(
    
    "catTitleMsg"=>$catTitleMsg,
    "brandMsg"=>$brandMsg
    
   );
 
    echo json_encode( $arr2);
    
 }



 if (isset($_POST['action']) && $_POST['action'] == "deleteBrand") {
    
    $id = $_POST['delete_id'];
    $dbObj->deleteBrand($id);

    echo json_encode(['code'=>200]);
  
} 




if( isset($_POST['updateBrand']) ){
     
    if(!isset($_POST['brand_id']) || empty($_POST['brand_id'])){
        echo json_encode(array('error'=>'ID is Empty.')); exit;
    }elseif(!isset($_POST['brand_name']) || empty($_POST['brand_name'])){
        echo json_encode(array('error'=>'Title Field is Empty.'));
    }elseif(!isset($_POST['brand_cat']) || empty($_POST['brand_cat'])){
        echo json_encode(array('error'=>'Brand Category Field is Empty.'));
    }else{
       
        $brand_id =  $_POST['brand_id'];
        $brand_name = $_POST['brand_name'];
        $brand_cat = $_POST['brand_cat'];
       
        $response =  $dbObj->updateBrandRecord($brand_id,$brand_name,$brand_cat);
         
       // print_r($response);die;
        if(!empty($response)){
           
            echo json_encode(array('success'=>$response)); exit;
        }
    }
}





?>
