<div
    x-data="{
        showModalDetail: false,
        items: [],
    }"
    x-show="showModalDetail"
    x-on:open-modal-detail.window="
        items = $event.detail.items
        console.log($event.detail.items)
        showModalDetail = true
    "
    x-on:close-modal-detail.window="showModalDetail = false"
    x-on:keydown.escape.window="showModalDetail = false"
    style="display: none"
    class="pointer-events-none fixed inset-0 z-30 flex items-end justify-center"
>
    <div x-on:click="showModalDetail = false" class="fixed inset-0 bg-gray-300 opacity-40"></div>
    <div class="pointer-events-auto w-full rounded-t-xl bg-white p-4 shadow-lg">
        <section class="mb-4 mt-1 flex flex-row items-center justify-between">
            <p class="text-xl font-bold">Transaction Detail</p>
            <button wire:click="closeModal"><i class="fa-solid fa-circle-xmark fa-xl"></i></button>
        </section>

        <form class="flex gap-5">
            <div class="w-1/2 font-medium">
                <p class="mb-2 text-lg font-medium">Order :</p>
                <section class="flex items-start gap-3">
                    <label
                        class="{{ $selectedOrderType == "dine_in" ? "bg-[#F4E27E]" : "bg-gray-100" }} flex items-center justify-between gap-2 rounded-lg px-3 py-2"
                    >
                        <input type="radio" wire:model.live="selectedOrderType" value="dine_in" />
                        <span>
                            <i class="fas fa-utensils"></i>
                            Dine-In
                        </span>
                    </label>

                    <label
                        class="{{ $selectedOrderType == "take_away" ? "bg-[#F4E27E]" : "bg-gray-100" }} flex items-center justify-between gap-2 rounded-lg px-3 py-2"
                    >
                        <input type="radio" wire:model.live="selectedOrderType" value="take_away" />
                        <span>
                            <i class="fas fa-shopping-bag"></i>
                            Take Away
                        </span>
                    </label>
                </section>

                <section class="flex gap-2">
                    <section class="flex w-full flex-col py-1 pe-1">
                        <label class="my-1">Customer Name</label>
                        <input
                            wire:model="customer_name"
                            type="text"
                            placeholder="Type name"
                            class="rounded-lg bg-slate-100 px-2 py-1 focus:border-blue-300 focus:outline-none focus:ring"
                        />
                        @error("customer_name")
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </section>

                    @if ($selectedOrderType == "dine_in")
                        <section class="flex w-full flex-col py-1 pe-1">
                            <label class="my-1">Table Number</label>
                            <input
                                wire:model="table_number"
                                type="number"
                                placeholder="Type number"
                                class="rounded-lg bg-slate-100 px-2 py-1 focus:border-blue-300 focus:outline-none focus:ring"
                            />
                            @error("table_number")
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </section>
                    @endif
                </section>

                @php
                    $filteredItems = array_filter($items, fn ($key) => is_numeric($key), ARRAY_FILTER_USE_KEY);
                @endphp

                <section class="py-1">
                    @if (count($filteredItems) == 0)
                        <p class="text-lg">No menu selected</p>
                    @else
                        <label class="text-lg">Menu selected ({{ count($filteredItems) }} items)</label>
                        @foreach ($items as $item)
                            @if (! is_numeric($item))
                                <section class="flex justify-between pe-1">
                                    <section class="flex gap-2">
                                        <p>{{ $item["qty"] }}</p>
                                        <p>{{ $item["name"] }}</p>
                                    </section>
                                    <section>
                                        <p>Rp {{ number_format($item["price"]) }}</p>
                                    </section>
                                </section>
                            @endif
                        @endforeach
                    @endif
                </section>
            </div>

            <div class="w-1/2 font-medium">
                <p>Order Status</p>
                <section class="flex gap-3 py-1">
                    <label
                        class="{{ $selectedStatus == "pending" ? "bg-[#F4E27E]" : "bg-gray-100" }} flex items-center justify-between gap-2 rounded-lg px-3 py-2"
                    >
                        <input type="radio" wire:model.live="selectedStatus" value="pending" />
                        <span>Pending</span>
                    </label>

                    <label
                        class="{{ $selectedStatus == "in progress" ? "bg-[#F4E27E]" : "bg-gray-100" }} flex items-center justify-between gap-2 rounded-lg px-3 py-2"
                    >
                        <input type="radio" wire:model.live="selectedStatus" value="in progress" />
                        <span>In Progress</span>
                    </label>

                    <label
                        class="{{ $selectedStatus == "completed" ? "bg-[#F4E27E]" : "bg-gray-100" }} flex items-center justify-between gap-2 rounded-lg px-3 py-2"
                    >
                        <input type="radio" wire:model.live="selectedStatus" value="completed" />
                        <span>Completed</span>
                    </label>
                </section>

                <div class="w-full font-medium">
                    <p>Payment Detail</p>
                    <section class="flex gap-3 py-1">
                        <label
                            class="{{ $selectedPaymentType == "cash" ? "bg-[#F4E27E]" : "bg-gray-100" }} flex items-center justify-between gap-2 rounded-lg px-3 py-2"
                        >
                            <input type="radio" wire:model.live="selectedPaymentType" value="cash" />
                            <span>
                                <i class="fas fa-money-bill-wave"></i>
                                Cash
                            </span>
                        </label>

                        <label
                            class="{{ $selectedPaymentType == "e-wallet" ? "bg-[#F4E27E]" : "bg-gray-100" }} flex items-center justify-between gap-2 rounded-lg px-3 py-2"
                        >
                            <input type="radio" wire:model.live="selectedPaymentType" value="e-wallet" />
                            <span>
                                <i class="fas fa-wallet"></i>
                                E-Wallet
                            </span>
                        </label>
                    </section>

                    @if ($selectedPaymentType == "cash")
                        <section class="flex flex-col py-1 pe-1">
                            <label class="my-1">Pay Amount</label>
                            <input
                                type="number"
                                placeholder="Type pay amount"
                                class="rounded-lg bg-slate-100 px-2 py-1 focus:border-blue-300 focus:outline-none focus:ring"
                                wire:model.live="payment_amount"
                            />
                        </section>
                    @endif

                    <section class="flex flex-col gap-1 py-2">
                        <section class="flex justify-between">
                            <p class="text-sm">Sub Total</p>
                            <p class="text-sm">
                                Rp
                                {{ isset($items["subtotal"]) ? number_format($items["subtotal"]) : number_format( collect($items)->sum(function ($item) { return $item["price"] * $item["qty"];}),) }}
                            </p>
                        </section>

                        <section class="flex justify-between">
                            <p>Total</p>
                            <p>
                                Rp
                                {{ isset($items["subtotal"]) ? number_format($items["subtotal"]) : number_format( collect($items)->sum(function ($item) { return $item["price"] * $item["qty"];}),) }}
                            </p>
                        </section>

                        @if ($payment_amount > 0)
                            <section class="flex justify-between">
                                <p>Change</p>
                                <p>
                                    Rp
                                    {{ number_format($payment_amount -(isset($items["subtotal"]) ? $items["subtotal"] : collect($items)->sum(function ($item) { return $item["price"] * $item["qty"];})),) }}
                                </p>
                            </section>
                        @endif

                        @if ($selectedStatus === "pending")
                            <button
                                type="button"
                                class="text-md mt-4 w-full rounded-lg bg-green-600 px-1 py-2 font-semibold text-white hover:bg-green-700"
                                wire:click="payOrder"
                            >
                                Pay
                            </button>
                        @endif

                        <section class="flex gap-2">
                            {{--
                                <button
                                type="button"
                                class="text-md mt-2 w-full rounded-lg bg-gray-200 px-1 py-2 font-semibold text-black"
                                x-on:click="printBill"
                                >
                                Print Bill
                                </button>
                            --}}

                            <button
                                type="button"
                                class="text-md mt-2 w-full rounded-lg bg-gray-200 px-1 py-2 font-semibold text-black"
                                wire:click="updateOrder"
                            >
                                Update Order
                            </button>
                        </section>
                    </section>
                </div>
            </div>
        </form>
    </div>
</div>
