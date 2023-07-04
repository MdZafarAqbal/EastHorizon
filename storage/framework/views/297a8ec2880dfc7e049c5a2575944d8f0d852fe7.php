<?php $__env->startSection('main-content'); ?>

<div class="card">
    <h5 class="card-header">Add City</h5>
    <div class="card-body">
        <form method="post" action="<?php echo e(route('city.store')); ?>">
          <?php echo e(csrf_field()); ?>

          <div class="form-group">
            <label for="inputName" class="col-form-label">City Name <span class="text-danger">*</span></label>
            <input id="inputName" type="text" name="name" placeholder="Enter City name"  value="<?php echo e(old('name')); ?>" class="form-control">
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
          <?php
            $countries = DB::table('countries')->where('status', 'active')->get();
          ?>
          <div class="form-group" id='country_id'>
              <label for="country_id">Country</label>
              <select name="country_id" class="form-control">
                  <option value="">--Select any category--</option>
                  <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value='<?php echo e($country->id); ?>'><?php echo e($country->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
          </div>
          <?php
            $states = DB::table('states')->where('status', 'active')->get();
          ?>
          <div class="form-group" id='state_id'>
              <label for="state_id">State Name</label>
              <select name="state_id" class="form-control">
                  <option value="">--Select any category--</option>
                  <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value='<?php echo e($state->id); ?>'><?php echo e($state->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
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

</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="<?php echo e(asset('admin_panel/summernote/summernote.min.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('admin_panel/summernote/summernote.min.js')); ?>"></script>
<script>  
  $(function() {
    let cnty = $('#country');
    cnty.val('United Arab Emirates');

    $('#country').on('change', function() {
      let dl= $("#countries")[0];
      $('#state').val('');
      $('#city').val('');
      $('#states').empty();
      $('#cities').empty();
      if(this.value.trim() != ''){
        let opSelected = dl.querySelector(`[value="${this.value}"]`);
        let id = opSelected.getAttribute('id');

        /* AJAX request for adding shopping list items to cart */
        $.ajax({
          type: 'get',
          url: '/states',
          data: {
            id: id,
          },
          success: function (resp) {
            if(resp == '') {
              $('#state-div').hide();
              $('#city-div').hide();
            }
            else {
              $('#state-div').show();
              $('#city-div').show();
              let stDl = $('#states')[0];
              resp.forEach((element) => {
                let option = document.createElement("option");
                option.value = element['name'];
                option.text = element['name'];
                option.setAttribute('id', element['id']);
                option.setAttribute('data-country', id);
                stDl.appendChild(option);
              });
            }
          },
          error: function () {
            alert("An error occured while accessing states")
          }
        });
      }
    });


    $('#state').on('change', function() {
      let dl= $("#states")[0];
      $('#city').val('');
      $('#cities').empty();
      if(this.value.trim() != ''){
        let opSelected = dl.querySelector(`[value="${this.value}"]`);
        let id = opSelected.getAttribute('data-country');
        let st_id = opSelected.getAttribute('id');

        /* AJAX request for adding shopping list items to cart */
        $.ajax({
          type: 'get',
          url: '/cities',
          data: {
            id: id,
            st_id: st_id
          },
          success: function (resp) {
            if(resp == '') {
              $('#city-div').hide();
            }
            else {
              $('#city-div').show();
              let stDl = $('#cities')[0];
              resp.forEach((element) => {
                let option = document.createElement('option');
                option.value = element['name'];
                option.text = element['name'];
                stDl.appendChild(option);
              });
            }
          },
          error: function () {
            alert("An error occured while accessing states")
          }
        });
      }
    });
    cnty.trigger('change');
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin_panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\East-Horizon\resources\views/admin_panel/city/create.blade.php ENDPATH**/ ?>