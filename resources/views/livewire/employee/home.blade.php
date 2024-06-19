<div class="h-screen">
    {{-- navbar --}}
    <nav class="flex w-full items-center justify-between bg-sunset-orange px-5 py-2">
        <a href="{{ route("employee") }}" class="flex items-center gap-4" wire:navigate>
            <i class="fa-solid fa-house text-2xl text-white"></i>
            {{--
                <section class="h-12 w-12 overflow-hidden rounded-full">
                <img src="https://placehold.co/400" alt="logo" />
                </section>
            --}}

            <section>
                <h1 class="font-semibold text-white sm:text-sm">Rumah Makan</h1>
                <p class="text-sm text-white">Faaz Matras</p>
            </section>
        </a>

        <section
            class="flex h-8 w-[150px] items-center justify-between rounded-lg bg-white px-4 py-6 sm:w-[120px] md:w-[300px] lg:w-[600px] xl:w-[800px]"
        >
            <div class="flex w-full items-center gap-4">
                <div>
                    <i class="fa fa-search fa-sm"></i>
                </div>

                <input
                    type="search"
                    placeholder="Cari menu..."
                    class="w-full text-sm outline-none"
                    wire:model.live="search"
                />
            </div>
        </section>

        <section class="flex flex-row items-center justify-center gap-3">
            <button class="flex flex-col items-center gap-0.5" x-on:click="$dispatch('show-order-list')">
                <i class="fa fa-clipboard-list fa-md text-white"></i>
                <p class="text-sm text-white">Orders</p>
            </button>

            <a href="{{ route("employee_profile") }}" class="flex flex-col items-center gap-0.5" wire:navigate>
                <i class="fa-solid fa-user fa-md text-white"></i>
                <p class="text-sm text-white">Profile</p>
            </a>

            <button class="flex flex-col items-center gap-0.5" wire:click="logout">
                <i class="fa fa-right-from-bracket fa-md text-white"></i>
                <p class="text-sm text-white">Logout</p>
            </button>
        </section>
    </nav>

    <main class="page-wrapper flex h-5/6 justify-between">
        {{-- category filter --}}
        <section>
            <section class="flex items-start gap-1">
                <section
                    class="{{ $category === "semua" ? "bg-[#F4E27E]" : "" }} flex cursor-pointer items-center justify-between gap-2 rounded-lg px-3 py-2"
                    wire:click="setCategory('semua')"
                >
                    <i class="fa-solid fa-utensils"></i>
                    <p class="text-xs font-semibold">Semua</p>
                </section>

                <section
                    class="{{ $category === "makanan" ? "bg-[#F4E27E]" : "" }} flex cursor-pointer items-center justify-between gap-2 rounded-lg px-3 py-2"
                    wire:click="setCategory('makanan')"
                >
                    <i class="fa-solid fa-bowl-food"></i>
                    <p class="text-xs font-semibold">Makanan</p>
                </section>

                <section
                    class="{{ $category === "minuman" ? "bg-[#F4E27E]" : "" }} flex cursor-pointer items-center justify-between gap-2 rounded-lg px-3 py-2"
                    wire:click="setCategory('minuman')"
                >
                    <i class="fa-solid fa-mug-saucer"></i>
                    <p class="text-xs font-semibold">Minuman</p>
                </section>

                <section
                    class="{{ $category === "snack" ? "bg-[#F4E27E]" : "" }} flex cursor-pointer items-center justify-between gap-2 rounded-lg px-3 py-2"
                    wire:click="setCategory('snack')"
                >
                    <i class="fa-solid fa-burger"></i>
                    <p class="text-xs font-semibold">Snack</p>
                </section>
            </section>

            {{-- looping menu --}}
            <section class="mt-4 grid grid-cols-4 gap-4">
                {{-- <section class="flex"> --}}
                @foreach ($menus as $menu)
                    <section
                        class="mx-4 my-2 flex w-fit cursor-pointer flex-col gap-3 rounded-lg bg-[#F3F3F3] px-3 py-5 text-start"
                    >
                        @php
                            $menuMedia = $menu->media->first();
                            $menuImage = $menuMedia ? $menuMedia->getUrl() : "https://www.bifolcomatty.co.uk/wp-content/uploads/2019/08/placeholder-square.jpg";
                        @endphp

                        <div class="h-20 w-32 object-cover">
                            <img src="{{ $menuImage }}" alt="" class="size-full rounded-xl shadow-xl" />
                        </div>

                        <div class="max-w-32">
                            <h5 class="text-sm">{{ $menu->name }}</h5>
                        </div>

                        <p class="text-sm font-semibold">Rp{{ number_format($menu->price) }}</p>

                        <button
                            class="rounded-lg bg-green-600 px-2 py-1 text-sm text-white hover:bg-green-700"
                            wire:click="addItem({{ $menu->id }})"
                        >
                            Add to cart
                        </button>
                    </section>
                @endforeach
            </section>
        </section>

        {{-- create order --}}
        <aside class="relative w-1/3 rounded-xl bg-[#F6FFF2]">
            <section class="flex items-center justify-between border-b-2 border-gray-200 p-6">
                <h1 class="text-lg font-semibold">Create Order</h1>
                @if ($hasItems)
                    <i class="fa-solid fa-xmark cursor-pointer text-xl font-semibold" wire:click="clearItems"></i>
                @endif
            </section>

            <section class="mt-4 flex flex-col gap-3 px-6">
                @foreach ($items as $id => $item)
                    <section class="rounded-xl bg-slate-50 p-3 shadow-lg">
                        <section class="flex gap-3 p-2">
                            <section class="h-fit w-fit">
                                @php
                                    $menuItem = App\Models\Menu::with("media")
                                        ->where("id", $item["id"])
                                        ->first();
                                    $menuImage = $menuItem->media->first() ? $menuItem->media->first()->getUrl() : "https://th.bing.com/th/id/OIP.R-2OxDXmafvmLXU57LFELQHaHa?w=167&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7";
                                    // dd($menuItem, $item, $menuImage);
                                @endphp

                                <img src="{{ $menuImage }}" alt="" width="80" height="80" />
                            </section>

                            <section class="w-full">
                                <section class="mb-2">
                                    <h3 class="text-sm">{{ $item["name"] }}</h3>
                                    <p class="font-medium">Rp{{ number_format($item["price"]) }}</p>
                                </section>

                                <section class="flex items-center justify-between">
                                    <section class="flex items-center gap-2 text-center">
                                        <i
                                            class="fa-regular fa-square-minus fa-lg cursor-pointer text-gray-400"
                                            wire:click="decreaseQuantity('{{ $id }}')"
                                        ></i>

                                        <div class="rounded-full bg-[#F1F2F2] px-2">
                                            <input
                                                type="number"
                                                class="w-5 border-none bg-transparent outline-none [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                                value="{{ $item["qty"] }}"
                                                readonly
                                            />
                                        </div>

                                        <i
                                            class="fa-regular fa-square-plus fa-lg cursor-pointer text-gray-400"
                                            wire:click="increaseQuantity('{{ $id }}')"
                                        ></i>
                                    </section>

                                    <button class="pe-1" wire:click="removeItem('{{ $id }}')">
                                        <i class="fa-solid fa-trash-can fa-lg text-red-500"></i>
                                    </button>
                                </section>
                            </section>
                        </section>

                        <section class="mt-1 px-2 py-2">
                            <textarea
                                class="w-full rounded-lg border border-gray-300 p-2 text-xs font-light"
                                placeholder="Add a note..."
                                wire:input.debounce.100ms="updateNote('{{ $id }}', $event.target.value)"
                            >
{{ $item["note"] }}</textarea
                            >
                        </section>
                    </section>
                @endforeach
            </section>

            <section
                class="absolute bottom-0 flex w-full flex-col rounded-xl bg-white px-6 py-2 shadow-sm shadow-gray-500"
            >
                <section class="flex items-center justify-between">
                    <p class="text-md font-semibold">Sub Total ({{ $totalItems }} item):</p>
                    <p class="text-md font-semibold">Rp{{ number_format($subtotal) }}</p>
                </section>

                <button
                    x-data
                    {{-- x-on:click="$dispatch('open-modal', { items: {{ json_encode($items) }} })" --}}
                    {{-- x-on:click="$dispatch('open-modal')" --}}
                    x-on:click="
                        let updatedItems = {{ json_encode($items) }}
                        updatedItems['totalItems'] = {{ $totalItems }}
                        updatedItems['subtotal'] = {{ $subtotal }}
                        $dispatch('open-modal', { items: updatedItems })
                    "
                    {{-- disable if not have items --}}
                    @disabled($hasItems ? "" : "disabled")
                    class="{{ $hasItems ? "bg-green-500" : "bg-gray-300" }} mb-2 mt-4 rounded-xl px-4 py-1.5 text-white"
                >
                    <p class="font-semibold">Continue</p>
                </button>
            </section>
        </aside>
    </main>

    @livewire("order.order-modal")

    @livewire("employee.order.order-list")

    @livewire("employee.order.order-modal-detail")
</div>
