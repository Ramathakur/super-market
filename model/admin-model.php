<?php
   
   class Database1
   {
        private $servername = "localhost";
        private $username   = "root";
        private $password   = "root";
        private $dbname = "demo";
        public $usersTable = "users";
        public $productsTable = "products";

        private $result = array(); // Any results from a query will be stored here
        private $mysqli = ""; // This will be our mysqli object
        private $myQuery = "";// used for debugging process with SQL return

        private $con ;
      public function __construct()
      {
         try {
            $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);   
         } catch (Exception $e) {
            echo $e->getMessage();
         }
      }


     
    public function displayAll($table)
    {
     $query = "SELECT * FROM $table";
     $result = $this->con->query($query);
    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
               $data[] = $row;
        }
         return $data;
        }else{
         echo "No found records";
        }
    }

    

  //--------------category------------------------------------------

    // Insert customer data into customer table
    public function insertCat($cat)
    {
        $sql = "INSERT INTO  categories (cat_title) VALUES('$cat')";
        $query = $this->con->query($sql);
        if ($query) {
            return true;
        }else{
            return false;
        }
    }
    


   // Fetch single record data for view profile
   public function getCatById($table,$id)
   {
      $query = "SELECT * FROM $table WHERE cat_id = '$id'";
      $result = $this->con->query($query);
      if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();
         return $row;
      }else{
         return false;
      }
   }
    
        // Delete customer data from customer table
		public function deleteCat($id)
		{
		    $query = "DELETE FROM categories WHERE cat_id = '$id'";
		    $sql = $this->con->query($query);
            if ($query) {
                return true;
             }else{
                return false;
             }

            }

            public function updateCateRecord($cat_name,$cat_id)
		{

             $query = "UPDATE categories SET cat_title='$cat_name' WHERE cat_id = '$cat_id'";
             $sql = $this->con->query($query);
            
            if ($sql) {
                return true;
            }else{
                return false;
            }
            
          }
		
 

   //-------------------------------userData------------------------------------------         
        
//----------------------------------------------------------Sub-Category--------------------------------------
   

        // Fetch single record data for view profile
        public function getSubCatById($table,$id)
        {
            $query = "SELECT * FROM $table WHERE sub_cat_id = '$id'";
            $result = $this->con->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            }else{
                return false;
            }
        }
     // Insert customer data into subCategory table
        public function insertSubCat($sub_cat_title,$cat_parent)
        {
            $sql = "INSERT INTO  sub_categories (sub_cat_title,cat_parent) VALUES('$sub_cat_title','$cat_parent')";
            $query = $this->con->query($sql);
            if ($query) {
                return true;
            }else{
                return false;
            }
        }

    // display subCategory data into subCategory table
         public function displaySubcate()
         {
         $query = "SELECT * FROM sub_categories INNER JOIN  categories ON sub_categories.cat_parent = categories.cat_id";
         $result = $this->con->query($query);
         if ($result->num_rows > 0) {
             $data = array();
             while ($row = $result->fetch_assoc()) {
                     $data[] = $row;
             }
             return $data;
             }else{
             echo "No found records";
             }
         }


         // Delete customer data from customer table
		public function deleteSubCat($id)
		{
		    $query = "DELETE FROM sub_categories WHERE sub_cat_id = '$id'";
		    $sql = $this->con->query($query);
            if ($query) {
                return true;
             }else{
                return false;
             }

            }

            public function updateSubCateRecord($cat_id,$cat_name,$parent_cat)
            {
    
                 $query = "UPDATE sub_categories SET sub_cat_title='$cat_name', cat_parent='$parent_cat'  WHERE sub_cat_id = '$cat_id'";
                 $sql = $this->con->query($query);
                
                if ($sql) {
                    return true;
                }else{
                    return false;
                }
                
              }
            
   //----------------------------------------Brands-------------------------------------------------------------------------------------

        
        // display subCategory data into subCategory table
        public function displayBrand()
        {
        $query = "SELECT * FROM brands INNER JOIN  categories ON brands.brand_cat = categories.cat_id";
        $result = $this->con->query($query);
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
            }
            return $data;
            }else{
            echo "No found records";
            }
        }


        // Fetch single record data for view profile
        public function getBrandById($table,$id)
        {
            $query = "SELECT * FROM $table WHERE brand_id = '$id'";
            $result = $this->con->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            }else{
                return false;
            }
        }

        // Insert customer data into subCategory table
        public function insertBrand($brand_title,$brand_cat)
        {
            $sql = "INSERT INTO  brands (brand_title,brand_cat) VALUES('$brand_title','$brand_cat')";
            $query = $this->con->query($sql);
            if ($query) {
                return true;
            }else{
                return false;
            }
          }


         // Delete customer data from customer table
		public function deleteBrand($id)
		{
		    $query = "DELETE FROM brands WHERE brand_id = '$id'";
		    $sql = $this->con->query($query);
            if ($query) {
                return true;
             }else{
                return false;
             }

            }


            public function updateBrandRecord($brand_id,$brand_name,$brand_cat)
            {
    
                 $query = "UPDATE brands SET brand_title='$brand_name', brand_cat='$brand_cat'  WHERE brand_id = '$brand_id'";
                 $sql = $this->con->query($query);
                
                if ($sql) {
                    return true;
                }else{
                    return false;
                }
                
              }
//-------------------------------------------Product------------------------------------------





        // display subCategory data into subCategory table
        public function displayProduct()
        {
        $query = "SELECT * FROM  products AS p LEFT JOIN categories As c ON p.product_cat =  c.cat_id  LEFT JOIN  sub_categories As s ON p.product_sub_cat =  s.sub_cat_id LEFT JOIN  brands As b ON p.product_brand = b.brand_id  ORDER BY p.product_id DESC ";
        $result = $this->con->query($query);
        // if ($result->num_rows > 0) {
        //     $data = array();
        //     while ($row = $result->fetch_assoc()) {
        //             $data[] = $row;
        //     }
            return  $result ;
            // }else{
            // echo "No records  found";
            // }
        }
        public function displayProductLimit($limit,$offset)
        {
        $query = "SELECT * FROM  products AS p LEFT JOIN categories As c ON p.product_cat =  c.cat_id  LEFT JOIN  sub_categories As s ON p.product_sub_cat =  s.sub_cat_id LEFT JOIN  brands As b ON p.product_brand = b.brand_id WHERE limit $offset,$limit ";
        $result = $this->con->query($query);
        // if ($result->num_rows > 0) {
        //     $data = array();
        //     while ($row = $result->fetch_assoc()) {
        //             $data[] = $row;
        //     }
            return  $result ;
            // }else{
            // echo "No records  found";
            // }
        }


        // Insert customer data into subCategory table
        public function insertProduct($product_code,$product_cat,$product_sub_cat,$product_brand,$product_title,$product_price,$product_desc,$featured_image,$qty,$product_status)
        {
            $sql = "INSERT INTO  products (product_code,product_cat,product_sub_cat,product_brand,product_title,product_price,product_desc,featured_image,qty,product_status) VALUES('$product_code','$product_cat','$product_sub_cat','$product_brand','$product_title','$product_price','$product_desc','$featured_image','$qty','$product_status')";
            $query = $this->con->query($sql);
            if ($query) {
                return true;
            }else{
                return false;
            }
          }

          // Update customer data into subCategory table
        public function updateProduct($product_cat,$product_sub_cat,$product_brand,$product_title,$product_price,$product_desc,$featured_image,$qty,$product_status,$id)
        {   
            $query = "UPDATE products SET  product_cat = '$product_cat', product_sub_cat='$product_sub_cat',product_brand='$product_brand',product_title='$product_title',product_price='$product_price',product_desc='$product_desc',featured_image= '$featured_image', qty= '$qty', product_status= '$product_status' WHERE product_id = '$id'";
            $sql = $this->con->query($query);
            
            if ($sql) {
                return true;
            }else{
                return false;
            }
          }


         // Delete customer data from customer table
		public function deleteProduct($id)
		{
		    $query = "DELETE FROM products WHERE product_id = '$id'";
		    $sql = $this->con->query($query);
            if ($query) {
                return true;
             }else{
                return false;
             }

            }
        //check email is already exist or not

        public function isExist($id){  
            $query = "SELECT * FROM products WHERE product_title = '$id'";
            $result = $this->con->query($query);
            if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
            }else{
            return false;
            }
        }  


         // Fetch single record data for view profile
   public function getProductById($table,$id)
   {
      $query = "SELECT * FROM $table WHERE product_id = '$id'";
      $result = $this->con->query($query);
      if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();
         return $row;
      }else{
         return false;
      }
   }

    }
?>