<div class="relative mx-auto min-h-dvh w-[400px]">
    <header class="sticky top-0 flex h-16 w-full items-center justify-between bg-orange-500 px-4">
        <a href="{{ route("customer_order", ["table" => $table, "orderType" => $orderType]) }}">
            <i class="fa-solid fa-arrow-left fa-lg text-white"></i>
        </a>
        <h1 class="mx-auto text-xl font-bold text-white">Keranjang</h1>
        @if (count($list_pesanan) === 0)
            <i class="fa-solid fa-arrow-rotate-left fa-lg hidden text-white"></i>
        @else
            <button wire:click="openDeleteAll" type="button">
                <i class="fa-solid fa-arrow-rotate-left fa-lg text-white"></i>
            </button>
        @endif
    </header>

    <main class="max-h-full min-h-dvh w-full bg-gray-100 pb-8">
        @if (count($list_pesanan) === 0)
            <section class="flex h-[90vh] w-full flex-col items-center justify-center gap-2 bg-[#F6FFF2]">
                <i class="fa-solid fa-cart-plus mb-4" style="font-size: 100px"></i>
                <h1 class="text-xl font-semibold">Keranjang kamu masih kosong</h1>
                <p class="">Yuk, pilih dan pesan menu favoritmu!</p>
            </section>
        @else
            <section class="overflow-y-auto px-2 pb-4 pt-1">
                @foreach ($list_pesanan as $index => $pesanan)
                    <section wire:key="{{ $index }}" class="mx-4 my-7 rounded-xl bg-slate-50 p-3 shadow-lg">
                        <section class="flex gap-3 p-2">
                            <section class="h-fit w-fit shadow-md">
                                @php
                                    $menu = App\Models\Menu::with("media")
                                        ->where("id", $pesanan["menu_id"])
                                        ->first();
                                    $menuImage = $menu->media->first() ? $menu->media->first()->getUrl() : "https://th.bing.com/th/id/OIP.R-2OxDXmafvmLXU57LFELQHaHa?w=167&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7";
                                @endphp

                                <img src="{{ $menuImage }}" alt="" width="80" height="80" />
                            </section>
                            <section class="w-full">
                                <section class="mb-2">
                                    <h3 class="text-sm">{{ $pesanan["name"] ?? "Nama menu" }}</h3>
                                    <p class="font-medium">Rp{{ number_format($pesanan["price"]) ?? "20.000" }}</p>
                                </section>
                                <section class="flex items-center justify-between">
                                    <section class="flex items-center gap-2 text-center">
                                        <i
                                            class="fa-regular fa-square-minus fa-lg cursor-pointer text-gray-400"
                                            wire:click="decreaseQty({{ $index }})"
                                        ></i>
                                        <div class="rounded-full bg-[#F1F2F2] px-2">
                                            <input
                                                type="number"
                                                class="w-5 border-none bg-transparent outline-none [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                                value="{{ $pesanan["qty"] }}"
                                                readonly
                                            />
                                        </div>
                                        <i
                                            class="fa-regular fa-square-plus fa-lg cursor-pointer text-gray-400"
                                            wire:click="increaseQty({{ $index }})"
                                        ></i>
                                    </section>
                                    <button wire:click.prevent="openDeleteItem({{ $index }})" class="pe-1">
                                        <i class="fa-solid fa-trash-can fa-lg text-red-500"></i>
                                    </button>
                                </section>
                            </section>
                        </section>
                        <section class="mt-1 px-2 py-2">
                            {{-- <p class="text-xs font-light">{{ $pesanan["note"] ?? "Ini note pesanan" }}</p> --}}
                            <input
                                type="text"
                                class="w-full rounded-lg border border-gray-300 p-2 text-xs font-light"
                                wire:model.live="list_pesanan.{{ $index }}.note"
                                placeholder="Tambahkan catatan"
                            />
                        </section>
                    </section>
                @endforeach
            </section>
        @endif
    </main>
    @if (count($list_pesanan) !== 0)
        <footer class="fixed bottom-0 w-[400px] bg-white p-4" height="60">
            <section class="flex flex-row items-center justify-between">
                <section class="flex flex-col">
                    <p class="text-sm">Jumlah bayar</p>
                    <p class="text-sm font-bold">Rp{{ number_format($sumprice ?? 0, 2, ",", ".") }}</p>
                </section>
                <section class="">
                    <button
                        wire:click="$dispatch('openOrderModal')"
                        class="text-md w-40 rounded-lg bg-[#70B44E] px-4 py-2 font-semibold text-white"
                    >
                        Pesan
                    </button>
                </section>
            </section>
            <div
                wire:loading.flex
                wire:target="$dispatch('openOrderModal')"
                class="fixed left-0 top-0 z-50 h-full w-full bg-gray-500 bg-opacity-50"
            >
                <div class="spinner"></div>
            </div>
        </footer>
    @endif

    @livewire("customer.make-order-modal")
    @if (! is_null($deleteIndex))
        @livewire("customer.delete-item-modal", ["name" => "delete-item-modal", "index" => $deleteIndex], key($deleteIndex))
    @endif

    @livewire("customer.delete-all-modal")
</div>
