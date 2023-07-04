<?php if($message = Session::get('success')): ?>
  <div class="flash-success flash-message">
    <p><?php echo e($message); ?></p>
  </div>
<?php endif; ?>
<?php if($message = Session::get('error')): ?>
  <div class="flash-error flash-message">
    <p><?php echo e($message); ?></p>
  </div>
<?php endif; ?>
<?php if($message = Session::get('warning')): ?>
  <div class="flash-warning flash-message">
    <p><?php echo e($message); ?></p>
  </div>
<?php endif; ?>
<?php if($message = Session::get('info')): ?>
  <div class="flash-info flash-message">
    <p><?php echo e($message); ?></p>
  </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Herb_room1\resources\views/frontend/layouts/flash-message.blade.php ENDPATH**/ ?>