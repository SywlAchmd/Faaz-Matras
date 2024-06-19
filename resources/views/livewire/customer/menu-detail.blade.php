@props([
    "name",
    "title",
])
<div
    x-data="{ showModal: true, name: '{{ $name }}' }"
    x-show="showModal"
    x-on:open-modal.window="showModal = true"
    x-on:close-modal.window="showModal = false"
    x-on:keydown.escape.window="showModal = false"
    style="display: none"
    class="pointer-events-none absolute bottom-0 z-50 w-full"
>
    <div x-on:click="showModal = false" class="fixed inset-0 w-full bg-gray-300 opacity-40"></div>
    <div class="pointer-events-auto rounded-t-xl bg-white shadow-lg">
        <section
            class="fixed top-32 flex h-fit max-h-[85vh] w-[400px] flex-col gap-5 overflow-y-auto rounded-t-3xl bg-white px-5 pb-12"
        >
            <header class="sticky top-0 flex items-center justify-between bg-white pb-2 pt-5">
                <p class="text-lg font-semibold">Detail Menu</p>

                <button x-on:click="showModal = false">
                    <i class="fa-solid fa-circle-xmark fa-lg"></i>
                </button>
            </header>

            @if ($menu->media->isNotEmpty())
                <img
                    id="menuImage"
                    src="{{ $menu->media->first()->getUrl() }}"
                    alt=""
                    class="h-40 w-full rounded-xl object-cover"
                />
            @else
                <img
                    id="menuImage"
                    src="https://www.bifolcomatty.co.uk/wp-content/uploads/2019/08/placeholder-square.jpg"
                    alt=""
                    class="h-40 w-full rounded-xl object-cover"
                />
            @endif

            <section class="w-fit rounded-full bg-[#E1FFD4] px-5 py-1 text-xs font-semibold">
                <p>Label</p>
            </section>

            <section class="flex flex-col gap-3">
                <p id="menuName" class="text-lg font-semibold">{{ $menu->name }}</p>
                <p id="menuPrice" class="text-base">Rp{{ number_format($menu->price) }}</p>
            </section>

            <section class="flex flex-col gap-1">
                <p class="text-base font-semibold">Deskripsi</p>
                <p id="menuDescription">
                    {{ $menu->description }}
                </p>
            </section>

            <section class="flex flex-col gap-2">
                <p class="text-base font-semibold">Catatan:</p>
                <div class="rounded-xl bg-[#F3F3F3] p-3">
                    <textarea
                        name="Tulis Catatan"
                        id="menuNote"
                        rows="3"
                        class="w-full border-none bg-[#F3F3F3] text-xs outline-none"
                        placeholder="Tulis Catatan..."
                        wire:model="note"
                    ></textarea>
                </div>
            </section>

            <section class="flex justify-between">
                <p class="text-base font-semibold">Jumlah</p>

                <section class="flex items-center gap-4 text-center">
                    <section class="flex items-center gap-4 text-center">
                        <i
                            class="fa-regular fa-square-minus fa-xl cursor-pointer text-gray-400"
                            wire:click="decreaseQty"
                        ></i>
                        <div class="rounded-full bg-[#F1F2F2] px-2">
                            <input
                                type="number"
                                class="w-5 border-none bg-transparent outline-none [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                wire:model="qty"
                                readonly
                            />
                        </div>
                        <i
                            class="fa-regular fa-square-plus fa-xl cursor-pointer text-gray-400"
                            wire:click="increaseQty"
                        ></i>
                    </section>
                </section>
            </section>

            <button
                class="w-full cursor-pointer rounded-lg bg-[#5A973C] py-3 text-center text-sm font-semibold text-white"
                wire:click="addToCart"
            >
                <p>Tambah ke keranjang</p>
            </button>
        </section>
    </div>
</div>
