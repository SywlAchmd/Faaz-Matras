<div class="w-2/4">
    {{-- {{ $order }} --}}
    <section class="text-center">
        <h3>{{ config("app.name") }}</h3>
        <p>Jl. Mattiro Tasi No.147, Cappa Galung, Kec. Bacukiki Bar., Kota Parepare, Sulawesi Selatan 91122</p>
    </section>

    <section>
        <table class="w-full">
            <tr>
                <td>Order Number</td>
                <td>:</td>
                <td>{{ $order->id }}</td>
            </tr>
            <tr>
                <td>Order Date</td>
                <td>:</td>
                <td>{{ $order->created_at->format("d F Y H:i") }}</td>
            </tr>
            <tr>
                <td>Customer Name</td>
                <td>:</td>
                <td>{{ $order->customer_name }}</td>
            </tr>
            @if ($order->order_type == "dine_in")
                <tr>
                    <td>Table Number</td>
                    <td>:</td>
                    <td>{{ $order->table_number }}</td>
                </tr>
            @endif

            <tr>
                <td>Order Type</td>
                <td>:</td>
                <td>{{ $order->order_type }}</td>
            </tr>
        </table>
    </section>

    <section>
        @dd($order->items)
    </section>
</div>
