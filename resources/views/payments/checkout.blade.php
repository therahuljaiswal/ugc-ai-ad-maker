<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ai-primary leading-tight">
            {{ __('Complete Purchase') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto bg-deep-black/50 border border-dark-green p-8 rounded-2xl shadow-2xl text-center">
            <h3 class="text-2xl font-bold mb-4">Finalizing Order</h3>
            <p class="text-gray-400 mb-8">You are purchasing {{ $payment->credits }} credits for ${{ $payment->amount }}.</p>

            <button id="rzp-button1" class="w-full py-4 bg-ai-primary text-black font-bold text-xl rounded-xl">Pay Now</button>

            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <script>
            var options = {
                "key": "{{ $razorpay_key }}",
                "amount": "{{ $order['amount'] }}",
                "currency": "{{ $order['currency'] }}",
                "name": "UGC AI Ad Maker",
                "description": "Purchase {{ $payment->credits }} Credits",
                "image": "https://via.placeholder.com/128",
                "order_id": "{{ $order['id'] }}",
                "handler": function (response){
                    // Submit to callback
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ route('payments.callback') }}";

                    const csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = "{{ csrf_token() }}";
                    form.appendChild(csrf);

                    const payment_id = document.createElement('input');
                    payment_id.type = 'hidden';
                    payment_id.name = 'razorpay_payment_id';
                    payment_id.value = response.razorpay_payment_id;
                    form.appendChild(payment_id);

                    const order_id = document.createElement('input');
                    order_id.type = 'hidden';
                    order_id.name = 'razorpay_order_id';
                    order_id.value = response.razorpay_order_id;
                    form.appendChild(order_id);

                    const signature = document.createElement('input');
                    signature.type = 'hidden';
                    signature.name = 'razorpay_signature';
                    signature.value = response.razorpay_signature;
                    form.appendChild(signature);

                    document.body.appendChild(form);
                    form.submit();
                },
                "prefill": {
                    "name": "{{ auth()->user()->name }}",
                    "email": "{{ auth()->user()->email }}"
                },
                "theme": {
                    "color": "#10b981"
                }
            };
            var rzp1 = new Razorpay(options);
            document.getElementById('rzp-button1').onclick = function(e){
                rzp1.open();
                e.preventDefault();
            }
            </script>
        </div>
    </div>
</x-app-layout>
