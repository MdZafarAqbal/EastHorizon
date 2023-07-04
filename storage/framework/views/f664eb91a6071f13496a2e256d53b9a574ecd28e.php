

<?php $__env->startSection('title','Order Detail'); ?>

<?php $__env->startSection('main-content'); ?>
<div class="card">
  <h5 class="card-header">Order<a href="<?php echo e(route('sale.pdf', ['id' => $order->id, 'download' => 1])); ?>" class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i> Invoice </a>
  </h5>
  <div class="card-body">
    <?php if($order): ?>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>S.N.</th>
            <th>Order No.</th>
            <th>Name</th>
            <th>Email</th>           
            <th>Amount</th>
            <th>Tax</th>
            <th>Shipping</th>
            <th>Total Amount</th>
            <th>Payment Status</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>         
            <td><?php echo e($order->id); ?></td>
            <td><?php echo e($order->order_no); ?></td>
            <td><?php if($order->fname): ?>
                <?php echo e($order->fname); ?> <?php echo e($order->lname); ?> 
              <?php else: ?> 
                <?php echo e($order->cname); ?> <?php echo e($order->trn_no); ?>

              <?php endif; ?>
            </td>
            <td><?php echo e($order->email); ?></td>          
            <td>AED <?php echo e($order->payment->subtotal); ?></td>
            <td>AED <?php echo e($order->payment->tax); ?></td>
            <td>AED <?php echo e(number_format($order->payment->shipping,2)); ?></td>
            <td>AED <?php echo e(number_format($order->payment->total,2)); ?></td>
            <td><?php echo e($order->payment->status); ?></td>
            <td>
              <?php if($order->status=='new'): ?>
                <span class="badge badge-primary"><?php echo e($order->status); ?></span>
              <?php elseif($order->status=='process'): ?>
                <span class="badge badge-warning"><?php echo e($order->status); ?></span>
              <?php elseif($order->status=='delivered'): ?>
                <span class="badge badge-success"><?php echo e($order->status); ?></span>
              <?php else: ?>
                <span class="badge badge-danger"><?php echo e($order->status); ?></span>
              <?php endif; ?>
            </td>
            <td>
              <a href="<?php echo e(route('order.edit',$order->id)); ?>" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
              <form method="POST" action="<?php echo e(route('order.destroy',[$order->id])); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('delete'); ?>
                  <button class="btn btn-danger btn-sm dltBtn" data-id=<?php echo e($order->id); ?> style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
              </form>
            </td>                      
          </tr>
        </tbody>
      </table>
      <section class="confirmation_part section_padding">
        <div class="order_boxes">
          <div class="row">
            <div class="col-lg-6 col-lx-4">
              <div class="order-info">
                <h4 class="text-center pb-4">ORDER INFORMATION</h4>
                <table class="table">
                  <tr class="">
                    <td>Order Number</td>
                    <td> : <?php echo e($order->order_no); ?></td>
                  </tr>
                  <tr>
                    <td>Order Date</td>
                    <td> : <?php echo e($order->created_at->format('D d M, Y')); ?> at <?php echo e($order->created_at->format('H:i:s')); ?> </td>
                  </tr>                    
                  <tr>
                    <td>Order Status</td>
                    <td> : <?php echo e($order->status); ?></td>
                  </tr>
                  <tr>
                    <td>Total</td>
                    <td> : AED <?php echo e($order->payment->subtotal); ?></td>
                  </tr>
                  <?php if($order->payment->shipping > 0): ?>
                    <tr>                                        
                      <td>Shipping Charge</td>
                      <td> : AED <?php echo e($order->payment->shipping); ?></td>                      
                    </tr>
                  <?php endif; ?>
                  <?php if($order->coupon): ?>
                    <tr>                    
                      <td>Coupon</td>
                      <td> : AED <?php echo e(number_format($order->coupon->value,2)); ?></td>
                    </tr>
                  <?php endif; ?>
                  <tr>
                    <td>Total Amount</td>
                    <td> : AED <?php echo e(number_format($order->payment->total,2)); ?></td>
                  </tr>
                  <tr>
                    <td>Payment Method</td>
                    <td> : <?php if($order->payment->method=='cod'): ?> Cash on Delivery <?php else: ?> Online Payment <?php endif; ?></td>
                  </tr>
                  <tr>
                    <td>Payment Status</td>
                    <td> : <?php echo e($order->payment->status); ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-6 col-lx-4">
              <div class="city-info">
                <h4 class="text-center pb-4">SHIPPING INFORMATION</h4>
                <table class="table">               
                  <tr class="">
                      <td>Full Name</td>
                      <td> : 
                        <?php if($order->fname): ?>
                          <?php echo e($order->fname); ?> <?php echo e($order->lname); ?> 
                        <?php else: ?> 
                          <?php echo e($order->cname); ?> <?php echo e($order->trn_no); ?>

                        <?php endif; ?>
                      </td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td> : <?php echo e($order->email); ?></td>
                  </tr>
                    <tr>
                      <td>Phone No.</td>
                      <td> : <?php echo e($order->shipping->phone); ?></td>
                    </tr>
                    <tr>
                      <td>Address</td>
                      <td> : <?php echo e($order->shipping->address); ?></td>
                    </tr>
                    <?php if($order->shipping->landmark): ?>
                      <tr>
                        <td>Landmark</td>
                        <td> : <?php echo e($order->shipping->landmark); ?></td>
                      </tr>
                    <?php endif; ?>
                    <tr>
                      <td>City</td>
                      <td> : <?php echo e($order->city->name); ?></td>
                    </tr>
                    <tr>
                      <td>State</td>
                      <td> : <?php echo e($order->city->state->name); ?></td>
                    </tr>
                    <tr>
                      <td>Country</td>
                      <td> : <?php echo e($order->city->state->country->name); ?></td>
                    </tr>                                      
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif; ?>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .order-info,.city-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.city-info h4{
        text-decoration: underline;
    }

</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin_panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views/admin_panel/order/show.blade.php ENDPATH**/ ?>