
<?php $__env->startSection('title','East Horizon || Banner Page'); ?>
<?php $__env->startSection('main-content'); ?>
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            <?php echo $__env->make('admin_panel.layouts.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Fixed Banners List</h6>
      <a href="<?php echo e(route('fixed.create')); ?>" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Fixed Banner</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <?php if(count($banner_fixeds)>0): ?>
        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              
              <th>Photo</th>
            
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Photo</th>
              
              <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            <?php $__currentLoopData = $banner_fixeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner_fixed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
                <tr>
                    <td><?php echo e($banner_fixed->id); ?></td>
                    <td>
                        <?php if($banner_fixed->photo_desktop): ?>
                            <img src="<?php echo e($banner_fixed->photo_desktop); ?> " class="img-fluid zoom" style="max-width:80px" alt="<?php echo e($banner_fixed->photo); ?>">
                            <img src="<?php echo e($banner_fixed->photo_tablet); ?> " class="img-fluid zoom" style="max-width:80px" alt="<?php echo e($banner_fixed->photo); ?>">
                            <img src="<?php echo e($banner_fixed->photo_mobile); ?> " class="img-fluid zoom" style="max-width:80px" alt="<?php echo e($banner_fixed->photo); ?>">
                        <?php else: ?>
                            <img src="<?php echo e(asset('admin_panel/img/thumbnail-default.jpg')); ?>" class="img-fluid zoom" style="max-width:100%" alt="avatar.png">
                        <?php endif; ?>
                    </td>
                   
                    <td>
                        <a href="<?php echo e(route('fixed.edit',$banner_fixed->id)); ?>" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        
                    </td>
                </tr>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
        <?php echo $banner_fixeds->withQueryString()->links('pagination::bootstrap-5'); ?>

        
        <?php else: ?>
          <h6 class="text-center">No banners found!!! Please create banner</h6>
        <?php endif; ?>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
  <link href="<?php echo e(asset('admin_panel/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
      .zoom {
        transition: transform .2s; /* Animation */
      }

      .zoom:hover {
        transform: scale(3.2);
      }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>

  <!-- Page level plugins -->
  <script src="<?php echo e(asset('admin_panel/vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin_panel/vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo e(asset('admin_panel/js/demo/datatables-demo.js')); ?>"></script>
  <script>
      
      $('#banner-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3,4,5]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){
            
        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          })
      })
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin_panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Herb_room1\resources\views/admin_panel/fixed/index.blade.php ENDPATH**/ ?>