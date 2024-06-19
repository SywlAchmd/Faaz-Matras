<div
    x-data="{
        showModal: false,
        items: {},
        paymentAmount: 0,
        get change() {
            return this.paymentAmount > 0
                ? this.paymentAmount - (this.items.subtotal || 0)
                : 0
        },
    }"
    x-show="showModal"
    x-on:open-modal.window="
        items = $event.detail.items;
        showModal = true;
    "
    x-on:close-modal.window="showModal = false"
    x-on:keydown.escape.window="showModal = false"
    style="display: none"
    class="pointer-events-none fixed inset-0 z-50 flex items-end justify-center"
>
    <div x-on:click="showModal = false" class="fixed inset-0 bg-gray-300 opacity-40"></div>
    <div class="pointer-events-auto w-full rounded-t-xl bg-white p-4 shadow-lg">
        {{-- header modal --}}
        <section class="mb-4 mt-1 flex flex-row items-center justify-between">
            <p class="text-xl font-bold">Transaction Detail</p>
            <button wire:click="closeModal"><i class="fa-solid fa-circle-xmark fa-xl"></i></button>
        </section>

        <form class="flex gap-5">
            {{-- order type --}}
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

                {{-- customer detail --}}
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

                {{-- detail order --}}
                <section class="py-1">
                    <template x-if="items.length === 0">
                        <p class="text-lg">No menu selected</p>
                    </template>

                    <label class="text-lg" x-text="'Menu selected (' + (items.totalItems || 0) + ' item)'"></label>
                    <template x-for="(item, index) in items.details" :key="index">
                        <section class="flex justify-between pe-1">
                            <section class="flex gap-2">
                                <p x-text="item.qty"></p>
                                <p x-text="item.name"></p>
                            </section>
                            <section>
                                <p x-text="'Rp' + new Intl.NumberFormat().format(item.price)"></p>
                            </section>
                        </section>
                    </template>
                </section>
            </div>

            <div class="w-1/2 font-medium">
                {{-- payment type --}}
                <p>Payment Detail</p>
                <section class="flex gap-3 py-1">
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
                </section>

                {{-- payment detail --}}
                @if ($selectedPaymentType == "cash")
                    <section class="flex flex-col py-1 pe-1">
                        <label class="my-1">Pay Amount</label>
                        <input
                            type="number"
                            placeholder="Type pay amount"
                            class="rounded-lg bg-slate-100 px-2 py-1 focus:border-blue-300 focus:outline-none focus:ring"
                            x-model.number="paymentAmount"
                        />
                    </section>
                @endif

                {{-- total --}}
                <section class="flex flex-col gap-1 py-2">
                    <section class="flex justify-between">
                        <p class="text-sm">Sub Total</p>
                        <p class="text-sm" x-text="new Intl.NumberFormat().format(items.subtotal)"></p>
                    </section>

                    <section class="flex justify-between">
                        <p>Total</p>
                        <p x-text="'Rp' + new Intl.NumberFormat().format(items.subtotal)"></p>
                    </section>

                    <section class="flex justify-between">
                        <p>Change</p>
                        <p x-text="'Rp' + new Intl.NumberFormat().format(change)"></p>
                    </section>

                    <button
                        type="submit"
                        class="text-md mt-4 w-full rounded-lg bg-green-600 px-1 py-2 font-semibold text-white hover:bg-green-700"
                        wire:click="saveOrder(items, status = 'in progress')"
                    >
                        Pay
                    </button>

                    <button
                        class="text-md mt-2 w-full rounded-lg bg-gray-200 px-1 py-2 font-semibold text-black"
                        wire:click="saveOrder(items)"
                    >
                        Save Order
                    </button>
                </section>
            </div>
        </form>
    </div>
</div>
