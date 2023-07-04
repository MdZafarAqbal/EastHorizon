<!DOCTYPE html>
<html>
  <head>
    <title>Order <?php if($order): ?>- <?php echo e($order->order_no); ?> <?php endif; ?></title>

    <link rel="stylesheet" href="<?php echo e(public_path('frontend/css/pdf.css')); ?>">
  </head>

  <body>
    <div class="invoice-header">
      <img src="<?php echo e(public_path('images/sale_invoice_header.png')); ?>"/>
    </div>

    <div class="watermark">East Horizon.ae</div>

    <div class="invoice-details">
      <h4>Invoice No: <?php echo e($order->id); ?></h4><br/>
      <h5>Invoice Date: </h5><span class="value"><?php echo e($order->created_at->format('D d m Y')); ?></span><br/>
      <h5>Order No: </h5><span class="value"><?php echo e($order->order_no); ?></span><br/>
    </div>

    <div class="address">
      <div class="billing">
        <?php 
          $city = App\Models\City::with('state', 'country')->where('id', $order->city_id)->first();
        ?>
        <h3>Billing Address</h3>
        <?php if($order->cname == null): ?>
          <h5>Name: </h5><span class="value">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($order->fname); ?> <?php echo e($order->lname); ?></span><br/>
        <?php else: ?>
          <h5>Company: </h5><span class="value">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($order->cname); ?></span><br/>
          <h5>TRN No: </h5><span class="value">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($order->trn_no); ?></span><br/>
        <?php endif; ?>
          <h5>Phone: </h5><span class="value">&nbsp;&nbsp;&nbsp;&nbsp;+ <?php echo e($city->country->calling_code); ?> <?php echo e($order->phone); ?></span><br/>
          <h5>Email: </h5><span class="value">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($order->email); ?></span><br/>
          <h5>Address: </h5><span class="value">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($order->address); ?>, <?php echo e($city->name); ?>,<br><?php echo e($city->state->name); ?>, <?php echo e($city->country->name); ?></span><br/>
      </div>
      <div class="shipping">
        <?php 
          $shipping_city = App\Models\City::with('state', 'country')->where('id', $order->shipping->city_id)->get()[0];
        ?>
        <h3>Shipping Address</h3>
        <?php if($order->cname == null): ?>
          <h5>Name: </h5><span class="value">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($order->shipping->fname); ?> <?php echo e($order->shipping->lname); ?></span><br/>
        <?php else: ?>
          <h5>Company: </h5><span class="value">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($order->shipping->cname); ?></span><br/>
          <h5>TRN No: </h5><span class="value">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($order->shipping->trn_no); ?></span><br/>
        <?php endif; ?>
          <h5>Phone: </h5><span class="value">&nbsp;&nbsp;&nbsp;&nbsp;+ <?php echo e($shipping_city->country->calling_code); ?> <?php echo e($order->shipping->phone); ?></span><br/>
          <h5>Address: </h5><span class="value">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($order->shipping->address); ?>, <?php echo e($shipping_city->name); ?>,<br/> <?php echo e($shipping_city->state->name); ?>, <?php echo e($shipping_city->country->name); ?></span><br/>
      </div>
    </div>

    <?php 
      $i = 0;
      $sum = $order->order_items->sum('total');
    ?>

    <section class="order-details">
      <div class="table-title">
        <h3>Order Details</h3>
      </div>
      <table class="table details-table">
        <thead>
          <tr>
            <th scope="col" class="col-6">S.NO</th>
            <th scope="col" class="col-6">PRODUCT</th>
            <th scope="col" class="col-3">FORM</th>
            <th scope="col" class="col-3">SIZE</th>
            <th scope="col" class="col-3">QTY.</th>
            <th scope="col" class="col-3">PRICE</th>
            <th scope="col" class="col-3">AMOUNT<br/><span>(EXCLUDING VAT)</span></th>
            <th scope="col" class="col-3">VAT %</th>
            <th scope="col" class="col-3">VAT AMOUNT</th>
            <th scope="col" class="col-3">Discount</th>
            <th scope="col" class="col-3">AMOUNT<br/><span>(INCLUDING VAT)</span></th>
          </tr>
        </thead>
        <tbody>
       
        <?php $__currentLoopData = $order->order_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php 
          $product=DB::table('products')->select('name')->where('id',$order_item->product_id)->get()[0];
          $i++;
        ?>
          <tr>
            <td><?php echo e($i); ?></td>
            <td>
              <?php echo e($product->name); ?>

            </td>
            <td><?php echo e($order_item->form); ?></td>
            <td><?php echo e($order_item->size); ?></td>
            <td><?php echo e($order_item->quantity); ?></td>
            <td>AED <?php echo e(number_format($order_item->price,2)); ?></td>
            <td>AED <?php echo e(number_format($order_item->subtotal,2)); ?></td>
            <td>5%</td>
            <td>AED <?php echo e(number_format($order_item->tax, 2)); ?></td>
            <td>AED <?php echo e(number_format($order_item->discount, 2)); ?></td>
            <td>AED <?php echo e(number_format($order_item->total, 2)); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tfoot>
          <tr>          
            <th scope="col" colspan="6">Total</th>
            <th scope="col">AED <?php echo e(number_format($order->payment->subtotal, 2)); ?></th>
            <th scope="col"></th>
            <th scope="col">AED <?php echo e(number_format($order->payment->tax, 2)); ?></th>        
            <th scope="col">AED <?php echo e(number_format($order->payment->discount, 2)); ?></th>        
            <th scope="col">AED <?php echo e(number_format($sum, 2)); ?></th>        
          </tr>
        </tfoot>
      </table>
      <div class="summary clearfix">
        <h5>Subtotal: </h5><span class="value">AED <?php echo e(number_format($order->payment->subtotal, 2)); ?></span><br/>
        <h5>VAT Amount: </h5><span class="value">AED <?php echo e(number_format($order->payment->tax, 2)); ?></span><br/>
        <h5>Discount: </h5><span class="value">AED <?php echo e(number_format($order->payment->discount, 2)); ?></span><br/>
        <h5>Shipping: </h5><span class="value">AED <?php echo e(number_format($order->payment->shipping, 2)); ?></span><br/>
        <hr/>
        <h4>Grand Total: </h4><span class="value">AED <?php echo e(number_format($order->payment->total, 2)); ?></span><br/>
      </div>
      <div class="footer">
        This is an e-generated invoice.
      </div>
    </section>
  </body>
</html><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views\frontend\order\sale-invoice.blade.php ENDPATH**/ ?>