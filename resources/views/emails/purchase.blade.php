<h1>Thank you for your purchase!</h1>
<p>Order ID: {{ $payment->razorpay_order_id }}</p>
<p>Credits Added: {{ $payment->credits }}</p>
<p>Amount Paid: ${{ $payment->amount }}</p>
<p>Your new credit balance is: {{ $payment->user->credits }}</p>
