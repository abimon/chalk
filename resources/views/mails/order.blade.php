<p>Hello {{Auth()->user()->name}},</p>
<p>Thank you for placing an order of the following items with us.</p>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Item</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $total =0;?>
        @foreach($orders as $key=>$order)
        <tr>
            <td>{{$key+1}}</td>
            <th style="text-align: left;">{{$order->product->product_name}}</th>
            <th>{{$order->quantity}}</th>
            <th>{{$order->product->price}}</th>
            <th>{{($order->product->price)*($order->quantity)}}</th>
        </tr>
        <?php $total +=(($order->product->price)*($order->quantity));?>
        @endforeach
        <tr>
            <th></th>
            <th colspan="3">Total</th>
            <th>{{$total}}</th>
        </tr>
    </tbody>
</table>
<p>Your order will be processed and you will be notified upon completion.</p>
<p>Thank you.</p>
<p>Regards,</p>
<p>Health and Life Center</p>
