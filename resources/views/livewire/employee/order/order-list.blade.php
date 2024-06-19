<div
    x-data="{ showOrderList: false }"
    x-show="showOrderList"
    x-on:show-order-list.window="showOrderList = true"
    x-on:close-order-list.window="showOrderList = false"
    x-on:keydown.escape.window="showOrderList = false"
    x-transition:enter="transition duration-300 ease-out"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition duration-300 ease-in"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-20 flex items-center justify-center"
    style="display: none"
>
    <div x-on:click="showOrderList = false" class="fixed inset-0 bg-gray-400 opacity-50"></div>
    <section
        class="fixed right-0 top-[60px] mb-4 me-6 mt-4 h-[84vh] w-[55vh] overflow-y-auto rounded-xl bg-[#F6FFF2] pt-4"
    >
        <section class="px-6">
            <section class="flex items-center justify-between">
                <h1 class="text-lg font-semibold">Order List</h1>
                <button x-on:click="showOrderList = false">
                    <i class="fa-solid fa-xmark text-xl font-semibold"></i>
                </button>
            </section>
            <p>Displaying today list order</p>
            <section class="flex gap-3 py-1">
                <!-- Kategori pesanan -->
                <section class="flex items-start gap-1">
                    <button
                        class="@if($selectedStatus === 'pending') bg-[#F4E27E] @else bg-[#D9D9D9] @endif rounded-lg px-3 py-2"
                        wire:click="filterOrders('pending')"
                    >
                        Pending
                    </button>
                </section>
                <section class="flex items-start gap-1">
                    <button
                        class="@if($selectedStatus === 'in progress') bg-[#F4E27E] @else bg-[#D9D9D9] @endif rounded-lg px-3 py-2"
                        wire:click="filterOrders('in progress')"
                    >
                        In Progress
                    </button>
                </section>
                <section class="flex items-start gap-1">
                    <button
                        class="@if($selectedStatus === 'completed') bg-[#F4E27E] @else bg-[#D9D9D9] @endif rounded-lg px-3 py-2"
                        wire:click="filterOrders('completed')"
                    >
                        Completed
                    </button>
                </section>
            </section>
            <!-- Daftar pesanan -->
            @foreach ($orderList as $orderId => $order)
                <section
                    class="my-2 cursor-pointer rounded-lg bg-gray-100 p-1 shadow-lg"
                    wire:click="openOrderDetail({{ $order->id }})"
                >
                    <section class="flex items-center justify-center gap-3 p-2">
                        <section class="h-full w-fit">
                            <i class="fa-solid fa-clipboard-list text-4xl text-green-500"></i>
                        </section>

                        <section class="w-full">
                            <section class="mb-2">
                                <h3 class="text-sm font-medium">A.N. {{ $order["customer_name"] }}</h3>
                                <p class="text-sm font-normal">Table : {{ $order["table_number"] }}</p>
                            </section>
                        </section>

                        <section>
                            <button wire:click="deleteOrder({{ $order->id }})">
                                <i class="fa-solid fa-trash text-red-600"></i>
                            </button>
                        </section>
                    </section>
                </section>
            @endforeach
        </section>
    </section>
</div>
