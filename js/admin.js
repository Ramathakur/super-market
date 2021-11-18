 
 $(document).ready(function(){

    var origin = window.location.origin;
    var path = window.location.pathname.split( '/' );
    var URL = origin+'/'+path[1]+'/';

  //  console.log( origin);
 
//-----------------------------------------Category---------------------------------------------------------------
  $("#submit").click(function(e){
    if ($("#formData")[0].checkValidity()) {
      e.preventDefault();
      $.ajax({
        url : "../controller/admin-controller.php",
        type : "POST",
        dataType: 'json',
        data : $("#formData").serialize()+"&action=categoryInsert",

        success:function(response){
        // alert(response);
            if (response.code == "200"){
        //     Swal.fire({
        //     // icon: 'success',
        //     title: 'Registration Successful',
        //   });
       
           $("#formData")[0].reset();
            window.location.href='category.php?msg1=insert';
            } else {

            
             
                $("#catTitleMsg").html(response.catTitleMsg);
               
                $("#catTitleMsg").css("display","block");
            }
          
        
        }

      });
    }
});

  
 // delete category
 $('.delete_category').click(function(){
    
    var tr = $(this);
    var id = $(this).attr('data-id');
   // alert(id);
    if(confirm('Are you Sure want to delete this')){
        $.ajax({
            url: '../controller/admin-controller.php',
            type: 'POST',
            data: {action:"delete",delete_id:id},
            dataType: 'json',
            success: function(response){
                // alert(response.code);
                 if (response.code=="200"){
                
                   
                       //$("#formData")[0].reset();
                         window.location.href ='category.php?msg3=delete';
                      // window.location.reload()
                        } 
            }
        });
    }
});


 // update category
 $('#updateCategory').submit(function(e){
  e.preventDefault();
  var cat = $('.cat_name').val();
  if(cat == ''){
      $('#updateCategory').prepend('<div class="alert alert-danger">Category Field is Empty.</div>');
  }else{
      var formdata = new FormData(this);
      formdata.append('updateCategory','1');
      $.ajax({
          url: "../controller/admin-controller.php",
          type: 'post',
          data: formdata,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(response){
              $('.alert').hide();
              console.log(response);
              var res = response;
              if(res.hasOwnProperty('success')){
                  $('#updateCategory').prepend('<div class="alert alert-success">Category Modified Successfully.</div>');
                  setTimeout(function(){  window.location.href='category.php?msg2=update'; }, 1000);
                  
              }else if(res.hasOwnProperty('error')){
                  $('#updateCategory').prepend('<div class="alert alert-danger">'+res.error+'</div>');
              }
          }
      })
  }
});

//----------------------------------------------------subCategory--------------------------------------------------

$("#submit2").click(function(e){
  if ($("#formData2")[0].checkValidity()) {
    e.preventDefault();
    $.ajax({
      url : "../controller/admin-controller.php",
      type : "POST",
      dataType: 'json',
      data : $("#formData2").serialize()+"&action=SubcategoryInsert",

      success:function(response){
      // alert(response);
          if (response.code == "200"){
    
         $("#formData2")[0].reset();
          window.location.href='sub-category.php?msg1=insert';
          } else {

              $("#catTitleMsg").html(response.catTitleMsg);
              $("#subCatMsg").html(response.subCatMsg);
              $("#catTitleMsg").css("display","block");
              $("#subCatMsg").css("display","block");
          }
        
      
      }

    });
  }
});

  // delete sub category
  $('.delete_subCategory').click(function(){
    var tr = $(this);
    var id = $(this).attr('data-id');
    if(confirm('Are you Sure want to delete this')){
        $.ajax({
            url: '../controller/admin-controller.php',
            type: 'POST',
            data: {action:"deleteSubCategory",delete_id:id},
            dataType: 'json',
            success: function(response){
              if (response.code=="200"){
                
                   
                //$("#formData")[0].reset();
                  window.location.href ='sub-category.php?msg3=delete';
               // window.location.reload()
                 } 
            }
        });
    }
});



    // update sub category
    $('#updateSubCategory').submit(function(e){
      e.preventDefault();
      var title = $('.sub_category').val();
      var parent = $('.parent_cat option:selected').val();
      if(title == ''){
          $('#updateSubCategory').prepend('<div class="alert alert-danger">Title Field is Empty.</div>');
      }else if(parent == ''){
          $('#updateSubCategory').prepend('<div class="alert alert-danger">Parent Category Field is Empty.</div>');
      }else{
          var formdata = new FormData(this);
          formdata.append('updateSubcategory','1');
          $.ajax({
            url : "../controller/admin-controller.php",
              type: 'post',
              data: formdata,
              processData: false,
              contentType: false,
              dataType: 'json',
              success: function(response){
                  $('.alert').hide();
                  console.log(response);
                  var res = response;
                  if(res.hasOwnProperty('success')){
                      $('#updateSubCategory').prepend('<div class="alert alert-success">Sub Category Modified Successfully.</div>');
                      setTimeout(function(){  window.location.href='sub-category.php?msg2=update'; }, 1000);
                      
                  }else if(res.hasOwnProperty('error')){
                      $('#updateSubCategory').prepend('<div class="alert alert-danger">'+res.error+'</div>');
                  }
              }
          })
      }
  });

//----------------------------------------Brands---------------------------------------------------------


$("#brandSubmit").click(function(e){
  if ($("#brandData")[0].checkValidity()) {
    e.preventDefault();
    $.ajax({
      url : "../controller/admin-controller.php",
      type : "POST",
      dataType: 'json',
      data : $("#brandData").serialize()+"&action=brandInsert",

      success:function(response){
      // alert(response);
          if (response.code == "200"){
    
         $("#brandData")[0].reset();
          window.location.href='brand.php?msg1=insert';
          } else {

              $("#catTitleMsg").html(response.catTitleMsg);
              $("#brandMsg").html(response.brandMsg);
              $("#catTitleMsg").css("display","block");
              $("#brandMsg").css("display","block");
          }
        
      
      }

    });
  }
});



  // delete sub category
  $('.delete_brand').click(function(){
    var tr = $(this);
    var id = $(this).attr('data-id');
    if(confirm('Are you Sure want to delete this')){
        $.ajax({
            url: '../controller/admin-controller.php',
            type: 'POST',
            data: {action:"deleteBrand",delete_id:id},
            dataType: 'json',
            success: function(response){
              if (response.code=="200"){
                
                   
                //$("#formData")[0].reset();
                  window.location.href ='brand.php?msg3=delete';
               // window.location.reload()
                 } 
            }
        });
    }
});


 // update brand
 $('#updateBrand').submit(function(e){
  e.preventDefault();
  $('.alert').hide();
 
  var title = $('.brand_name').val();
 // alert(title);
  var parent = $('.brand_category option:selected').val();
  if(title == ''){
      $('#updateBrand').prepend('<div class="alert alert-danger">Title Field is Empty.</div>');
  }else if(parent == ''){
      $('#updateBrand').prepend('<div class="alert alert-danger">Parent Category Field is Empty.</div>');
  }else{
      var formdata = new FormData(this);
      formdata.append('updateBrand','1');
      $.ajax({
        url: '../controller/admin-controller.php',
          type: 'post',
          data: formdata,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(response){
              $('.alert').hide();
              var res = response;
              if(res.hasOwnProperty('success')){
                  $('#updateBrand').prepend('<div class="alert alert-success">Brand Modified Successfully.</div>');
                  setTimeout(function(){ window.location.href='brand.php?msg2=update'; }, 1000);
                  
              }else if(res.hasOwnProperty('error')){
                  $('#updateBrand').prepend('<div class="alert alert-danger">'+res.error+'</div>');
              }
          }
      })
  }
});

//--------------------------------------------Product----------------------------------------------------

     // load product image with jquery
     $('.product_image').change(function(){
      readURL(this);
  })

  // preview image before upload
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#image').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

// add product
$('#createProduct').submit(function(e){
  e.preventDefault();
  $('.alert').hide();
  var title = $('.product_title').val();
  var cat = $('.product_category option:selected').val();
  var sub_cat = $('.product_sub_category option:selected').val();
  var des = $('.product_description').val();
  var price = $('.product_price').val();
  var qty = $('.product_qty').val();
  var status = $('.product_status').val();
  var image = $('.product_image').val();
  if(title == ''){
      $('#createProduct').prepend('<div class="alert alert-danger">Title Field is Empty.</div>');
  }else if(cat == ''){
      $('#createProduct').prepend('<div class="alert alert-danger">Category Field is Empty.</div>');
  }else if(sub_cat == ''){
      $('#createProduct').prepend('<div class="alert alert-danger">Sub Category Field is Empty.</div>');
  }else if(des == ''){
      $('#createProduct').prepend('<div class="alert alert-danger">Description Field is Empty.</div>');
  }else if(price == ''){
      $('#createProduct').prepend('<div class="alert alert-danger">Price Field is Empty.</div>');
  }else if(qty == ''){
      $('#createProduct').prepend('<div class="alert alert-danger">Quantity Field is Empty.</div>');
  }else if(image == ''){
      $('#createProduct').prepend('<div class="alert alert-danger">Image Field is Empty.</div>');
  }else{
      var formdata = new FormData(this);
      formdata.append('create',0);
      $.ajax({
          url    : '../controller/admin-controller.php',
          type   : "POST",
          data   : formdata,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(response){
              $('.alert').hide();
              alert(response);
              var res = response;
              if(res.hasOwnProperty('success')){
                  $('#createProduct').prepend('<div class="alert alert-success">Product Added Successfully.</div>');
                  setTimeout(function(){window.location.href ='product-list.php?msg1=insert'; }, 1000);
                  
              }else if(res.hasOwnProperty('error')){
                  $('#createProduct').prepend('<div class="alert alert-danger">'+res.error+'</div>');
              }
          }
      });
  }

});



  // delete sub category
  $('.delete_product').click(function(){
    var tr = $(this);
    var id = $(this).attr('data-id');
    if(confirm('Are you Sure want to delete this')){
        $.ajax({
            url: '../controller/admin-controller.php',
            type: 'POST',
            data: {action:"deleteProduct",delete_id:id},
            dataType: 'json',
            success: function(response){
              if (response.code=="200"){
                
                   
                //$("#formData")[0].reset();
                  window.location.href ='product-list.php?msg3=delete';
               // window.location.reload()
                 } 
            }
        });
    }
});

// update product
$('#updateProduct').submit(function(e){
  e.preventDefault();
  $('.alert').hide();
  var title = $('.product_title').val();
  var cat = $('.product_category option:selected').val();
  var sub_cat = $('.product_sub_category option:selected').val();
  var des = $('.product_description').val();
  var price = $('.product_price').val();
  var qty = $('.product_qty').val();
  var status = $('.product_status').val();
  var image = $('.product_image').val();
  var old_image = $('.old_image').val();
  if(title == ''){
      $('#updateProduct').prepend('<div class="alert alert-danger">Title Field is Empty.</div>');
  }else if(cat == ''){
      $('#updateProduct').prepend('<div class="alert alert-danger">Category Field is Empty.</div>');
  }else if(sub_cat == ''){
      $('#updateProduct').prepend('<div class="alert alert-danger">Sub Category Field is Empty.</div>');
  }else if(des == ''){
      $('#updateProduct').prepend('<div class="alert alert-danger">Description Field is Empty.</div>');
  }else if(price == ''){
      $('#updateProduct').prepend('<div class="alert alert-danger">Price Field is Empty.</div>');
  }else if(qty == ''){
      $('#updateProduct').prepend('<div class="alert alert-danger">Quantity Field is Empty.</div>');
  }else if(image == '' && old_image == ''){
      $('#updateProduct').prepend('<div class="alert alert-danger">Image Field is Empty.</div>');
  }else{
      var formdata = new FormData(this);
      formdata.append('update',1);
      $.ajax({
          url    :  '../controller/admin-controller.php',
          type   : "POST",
          data   : formdata,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(response){
              $('.alert').hide();
              console.log(response);
              var res = response;
              if(res.hasOwnProperty('success')){
                  $('#updateProduct').prepend('<div class="alert alert-success">Product Added Successfully.</div>');
                  setTimeout(function(){window.location.href ='product-list.php?msg2=update'; }, 1000);
                  
              }else if(res.hasOwnProperty('error')){
                  $('#updateProduct').prepend('<div class="alert alert-danger">'+res.error+'</div>');
              }
          }
      });
  }

});



 });
