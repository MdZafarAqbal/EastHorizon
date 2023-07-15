<?php $__env->startSection('main-content'); ?>

<div class="card">
    <h5 class="card-header">Add Product</h5>
    
    <div class="card-body">
      <form method="post" action="<?php echo e(route('product.store')); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Plu Code <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="plu" placeholder="Enter Plu"  value="<?php echo e(old('plu')); ?>" class="form-control">
          <?php $__errorArgs = ['plu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="text-danger"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="name" placeholder="Enter Name"  value="<?php echo e(old('name')); ?>" class="form-control">
          <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="text-danger"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Model No</label>
          <input id="inputTitle" type="text" name="model_no" placeholder="Enter Model No"  value="<?php echo e(old('model_no')); ?>" class="form-control">
          <?php $__errorArgs = ['model_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="text-danger"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        
        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description"><?php echo e(old('description')); ?></textarea>
          <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="text-danger"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        
        <div class="form-group">
          <div id="category">
            <label for="category_id">Category</label>
            
            <select name="cat_id" id="category_id" class="form-control category_id">
              <option value="">--Select category--</option>
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          
            <div class="form-group d-none child_cat_div" id="child_cat_div">
              <label for="child_cat_id">Sub Category</label>
              <select name="subcat_id" id="child_cat_id" class="form-control child_cat_id">
                <option value="">--Select any category--</option>
                
              </select> 
              
            </div>
            <a href="javascript:void(0);" class="category_button" title="Add field">Add</a><br> 
          </div>
          <input type="hidden" id="cat_count" name="cat_count" value="">
        </div>
        
        <div class="form-group">
          <label for="brand_id">Brand</label>
          
          <div class="brand">
            <select name="brand_id" id="brand_id" class="form-control">
              <option value="">--Select Brand--</option>
              <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <a href="javascript:void(0);" class="brand_button" title="Add field">Add</a><br>
          </div>         
          <input type="hidden" id="brand_count" name="brand_count" value="">
        </div>
        
        <div class="form-group">
          <label for="promotion">Promotion</label>
          <select name="promotion" class="form-control">
              <option value="">--Select Promotion--</option>
              <option value="popular">Popular</option>
              <option value="new">New</option>
              <option value="trending">Trending</option>
          </select>
        </div>
        <div class="form-group">
          <label for="price" class="col-form-label">Price <span class="text-danger">*</span></label>
          <input id="price" type="number" name="price" value="<?php echo e(old('price')); ?>" class="form-control">
          <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="text-danger"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        
       <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
          <div class="input-group">
            <span class="input-group-btn">
              <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Choose
              </a>
            </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="<?php echo e(old('photo')); ?>">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger"></span></label>
          <div class="input-group">
              <span class="input-group-btn">
                <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="images[]" multiple>
              </span>          
          </div>
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="text-danger"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
          <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin_panel/summernote/summernote.min.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="<?php echo e(asset('admin_panel/summernote/summernote.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
  $('#lfm').filemanager('image');
  $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write detail description.....",
        tabsize: 2,
        height: 100
    });
  });
  
  
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $(".btn-success").click(function(){ 
        var html = $(".clone").html();
        $(".increment").after(html);
    });
    $("body").on("click",".btn-danger",function(){ 
        $(this).parents(".control-group").remove();
    });
  });


  $(document).ready(function() {
    var max_fields = 15;
    var wrapper = $(".brand");
    var add_button = $(".brand_button");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
          x++;
          $(wrapper).append(`<div><br><select name="brand_id${x}" id="brand_id${x}" class="form-control">
          <option value="">--Select Brand--</option><?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select>
          <a href="#" class="delete">Delete</a></div>`);//add input box
          $("#brand_count").val(x);
        } else {
          alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
      e.preventDefault();
      $(this).parent('div').remove();
      x--;
    })
  });

  $(document).ready(function() {
    var max_fields = 15;
    var x = 1;
    var wrapper = $("#category");
    var add_button = $(".category_button");
    
    $(add_button).click(function(e) {
      
      e.preventDefault();
      if (x < max_fields) {
        x++;
        $(wrapper).append(`<div class="category${x}"><br><label for="cat_id">Category</label>
        <select name="cat_id${x}" id="category_id${x}" class="form-control category_id${x}">
          <option value="">--Select category--</option>
          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        
        <div class="form-group d-none child_cat_div${x}" id="child_cat_div${x}">
          <label for="subcat_id${x}">Sub Category</label>
          <select name="subcat_id${x}" id="child_cat_id${x}" class="form-control child_cat_id${x}">
            <option value="">--Select any category--</option>
            
          </select>
        </div> <a href="#" class="delete">Delete</a></div>`);
        $("#cat_count").val(x);
        $("#subcat_count").val(x);
        
      } else {
        alert('You Reached the limits')
      }
      $(`.category_id${x}`).change(function (){    
       
        var category_id=$(this).val();
        if(category_id !=null) {         
          // Ajax call
          $.ajax({        
            url:`/admin/category/"+category_id+"/child`,
            data:{
              _token:"<?php echo e(csrf_token()); ?>",
              id:category_id
            },
            type:"POST",
            success:function(response){       
              if(typeof(response) !='object'){
                response=$.parseJSON(response)            
              }
              var html_option="<option value=''>----Select sub category----</option>"
              if(response.status){
                var data=response.data;
                if(response.data){
                  $(`.child_cat_div${x}`).removeClass('d-none');
                  $.each(data,function(id,name){
                    html_option +="<option value='"+id+"'>"+name+"</option>"
                  });
                }
                else{ 
                }
              }
              else{
                
                $(`.child_cat_div${x}`).addClass('d-none');
              }
              $(`.child_cat_id${x}`).html(html_option);
            }
          });
        }
        else{
        }
        
      })
    });
    $(wrapper).on("click", ".delete", function(e) {
      e.preventDefault();
      $(this).parent('div').remove();
      x--;
    })
  });
 
  $('.category_id').change(function (){ 
    var category_id=$(this).val();
    
    if(category_id !=null){
      //alert(category_id);
      // Ajax call
      $.ajax({        
        url:"/admin/category/"+category_id+"/child",
        data:{
          _token:"<?php echo e(csrf_token()); ?>",
          id:category_id
        },
        type:"POST",
        success:function(response){       
          if(typeof(response) !='object'){
            response=$.parseJSON(response)            
          }
          var html_option="<option value=''>----Select sub category----</option>"
          if(response.status){
            var data=response.data;
            if(response.data){
              $('.child_cat_div').removeClass('d-none');
              $.each(data,function(id,name){
                html_option +="<option value='"+id+"'>"+name+"</option>"
              });
            }
     
            else{ 
            }
          }
          else{
            
            $('.child_cat_div').addClass('d-none');
          }
          $('.child_cat_id').html(html_option);
        }
      });
    }
    else{
    }
    
  })
  
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin_panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\East-Horizon\resources\views/admin_panel/product/create.blade.php ENDPATH**/ ?>