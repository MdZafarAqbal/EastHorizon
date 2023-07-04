<?php $__env->startSection('main-content'); ?>
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
    <div class="row">
      <div class="col-md-12">
        <?php echo $__env->make('admin_panel.layouts.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Subcategory Lists</h6>
      <a href="<?php echo e(route('subcategory.create')); ?>" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Subcategory</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <?php if(count($subcategories)>0): ?>
          <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
              <th>S.N.</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>

              <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($subcategory->id); ?></td>
                  <td><?php echo e($subcategory->name); ?></td>
                  <td><?php echo e($subcategory->slug); ?></td>
                  <td><?php echo e($subcategory->category->name); ?></td>
                  <td>
                    <?php if($subcategory->status=='active'): ?>
                      <span class="badge badge-success"><?php echo e($subcategory->status); ?></span>
                    <?php else: ?>
                      <span class="badge badge-warning"><?php echo e($subcategory->status); ?></span>
                    <?php endif; ?>
                    </td>
                    <td>
                      <a href="<?php echo e(route('subcategory.edit',$subcategory->id)); ?>" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="<?php echo e(route('subcategory.destroy',[$subcategory->id])); ?>">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('delete'); ?>
                      <button class="btn btn-danger btn-sm dltBtn" data-id="<?php echo e($subcategory->id); ?>" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
          <?php echo $subcategories->withQueryString()->links('pagination::bootstrap-5'); ?>

          
        <?php else: ?>
          <h6 class="text-center">No Categories found!!! Please create Category</h6>
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

<?php echo $__env->make('admin_panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\East-Horizon\resources\views/admin_panel/subcategory/index.blade.php ENDPATH**/ ?>