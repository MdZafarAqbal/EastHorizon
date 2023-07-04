<?php $__env->startSection('title','Order Detail'); ?>

<?php $__env->startSection('main-content'); ?>
<form action="<?php echo e(route('order.update',$order->id)); ?>" method="POST">
  <div class="card">
    <h5 class="card-header">Order Status</h5>
    <div class="card-body">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PATCH'); ?>
      <div class="form-group">
        <label for="order_status">Order Status :</label>
        <select name="order_status" id="" class="form-control">
          <option value="new" <?php echo e(($order->status=='completed' || $order->status=="processed" || $order->status=="cancelled") ? 'hidden' : ''); ?>  <?php echo e((($order->status=='new')? 'selected' : '')); ?>>New</option>
          <option value="processed" <?php echo e(($order->status=='completed'|| $order->status=="cancelled") ? 'hidden' : ''); ?>  <?php echo e((($order->status=='processed')? 'selected' : '')); ?>>Processed</option>
          <option value="completed" <?php echo e(($order->status=="cancelled") ? 'hidden' : ''); ?>  <?php echo e((($order->status=='completed')? 'selected' : '')); ?>>Completed</option>
          <option value="cancelled" <?php echo e(($order->status=='completed') ? 'hidden' : ''); ?>  <?php echo e((($order->status=='cancelled')? 'selected' : '')); ?>>Cancelled</option>
        </select>
      </div>
    </div>
  </div>

  <div class="card">
    <h5 class="card-header">Shipping Status</h5>
  <div class="card-body">
    <div class="form-group">
      <label for="shipping_status">Shipping Status :</label>
      <select name="shipping_status" id="" class="form-control">
        <option value="ordered" <?php echo e(($order->shipping->status=="processed" || $order->shipping->status=="shipped" || $order->shipping->status=="delivered") ? 'hidden' : ''); ?>  <?php echo e((($order->shipping->status=='ordered')? 'selected' : '')); ?>>Ordered</option>
        <option value="processed" <?php echo e(($order->shipping->status=="shipped" || $order->shipping->status=="delivered") ? 'hidden' : ''); ?>  <?php echo e((($order->shipping->status=='processed') ? 'selected' : '')); ?>>Processed</option>
        <option value="shipped" <?php echo e(($order->shipping->status=="delivered") ? 'hidden' : ''); ?>  <?php echo e((($order->shipping->status=='shipped') ? 'selected' : '')); ?>>Shipped</option>
        <option value="delivered" <?php echo e(($order->shipping->status=="new") ? 'hidden' : ''); ?>  <?php echo e((($order->shipping->status=='delivered') ? 'selected' : '')); ?>>Delivered</option>
      </select>
    </div>
  </div>
  <div class="card">
    <h5 class="card-header">Payment Status</h5>
    <div class="card-body">
      <div class="form-group">
        <label for="payment_status">Payment Status :</label>
        <select name="payment_status" id="" class="form-control">
          <option value="unpaid" <?php echo e(($order->payment->status=="paid") ? 'hidden' : ''); ?>  <?php echo e((($order->payment->status=='unpaid')? 'selected' : '')); ?>>Unpaid</option>
          <option value="paid" <?php echo e(($order->payment->status=='unpaid') ? 'active' : ''); ?>  <?php echo e((($order->payment->status=='paid')? 'selected' : '')); ?>>Paid</option>
        </select>
      </div>      
    </div>
    <button type="submit" class="btn btn-primary" >Update</button> 
  </div>  
</form>

<?php if($order->payment->refund): ?>

<form id="refund" method="post" action="<?php echo e(route('payment-refund', ['id' => $order->id])); ?>">
  <div class="card">
    <h5 class="card-header">Payment Refund</h5>
    <div class="card-body">
      <div class="form-group">
        <?php echo csrf_field(); ?>
        <label for="refund" class="col-form-label">Refund </label>
        <input id="refund" type="number" name="refund" value="<?php echo e($order->payment->refund); ?>">
        <?php $__errorArgs = ['refund'];
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
    </div>
    <button type="submit" class="btn btn-primary" >Refund</button> 
  </div>
</form>

<?php endif; ?>  
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
    .btn{
      width:6em;
      display: flex;
 
    }

</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin_panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\East-Horizon\resources\views/admin_panel/order/edit.blade.php ENDPATH**/ ?>