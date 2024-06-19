<div class="relative mx-auto min-h-dvh w-[400px] bg-sunset-orange">
    <header class="flex flex-col gap-4 px-8 py-6">
        <section class="flex items-center gap-4">
            {{--
                <img
                src="https://p1.hiclipart.com/preview/249/454/412/frost-pro-for-os-x-icon-set-now-free-blank-white-circle-png-clipart.jpg"
                alt="logo"
                width="24"
                height="24"
                />
            --}}
            <i class="fa-solid fa-house text-white"></i>
            <p class="font-semibold text-white">Faaz Matras</p>
        </section>

        <section class="flex h-10 w-auto items-center gap-2 rounded-xl bg-moon-gray p-2">
            <div class="flex h-full w-full items-center justify-between rounded-xl bg-white p-2">
                <div class="flex w-full items-center gap-4">
                    <div>
                        <i class="fa fa-search fa-sm" style="color: #f88c05"></i>
                    </div>
                    <input
                        type="text"
                        placeholder="Cari menu..."
                        class="w-full text-xs outline-none"
                        name="search"
                        wire:model.live="search"
                    />
                </div>
            </div>

            {{-- <a href="{{ route("checkout") }}" wire:navigate> --}}
            <a href="{{ route("checkout", ["table" => $table, "orderType" => $orderType]) }}" wire:navigate>
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
        </section>
    </header>

    <main class="min-h-[83vh] w-full rounded-t-3xl bg-white p-2">
        <section class="flex flex-col gap-3 p-2">
            {{-- category filter --}}
            <p class="text-sm font-bold">Kategori Menu</p>

            <div class="flex justify-between px-6">
                <section class="flex flex-col items-center gap-1">
                    <div
                        class="{{ $category === "semua" ? "bg-[#F4E27E]" : "" }} flex h-6 w-6 cursor-pointer items-center justify-center rounded-full p-4"
                        wire:click="setCategory('semua')"
                    >
                        <i class="fa-solid fa-utensils"></i>
                    </div>

                    <p class="text-xs font-semibold">Semua</p>
                </section>

                <section class="flex flex-col items-center gap-1">
                    <div
                        class="{{ $category === "makanan" ? "bg-[#F4E27E]" : "" }} flex h-6 w-6 cursor-pointer items-center justify-center rounded-full p-4"
                        wire:click="setCategory('makanan')"
                    >
                        <i class="fa-solid fa-bowl-food"></i>
                    </div>

                    <p class="text-xs font-semibold">Makanan</p>
                </section>

                <section class="flex flex-col items-center gap-1">
                    <div
                        class="{{ $category === "minuman" ? "bg-[#F4E27E]" : "" }} flex h-6 w-6 cursor-pointer items-center justify-center rounded-full p-4"
                        wire:click="setCategory('minuman')"
                    >
                        <i class="fa-solid fa-mug-saucer"></i>
                    </div>

                    <p class="text-xs font-semibold">Minuman</p>
                </section>

                <section class="flex flex-col items-center gap-1">
                    <div
                        class="{{ $category === "snack" ? "bg-[#F4E27E]" : "" }} flex h-6 w-6 cursor-pointer items-center justify-center rounded-full p-4"
                        wire:click="setCategory('snack')"
                    >
                        <i class="fa-solid fa-burger"></i>
                    </div>

                    <p class="text-xs font-semibold">Snack</p>
                </section>
            </div>
        </section>

        @if ($menus->isNotEmpty())
            <section class="flex max-h-[68vh] flex-wrap justify-between overflow-y-auto scrollbar-hide">
                @foreach ($menus as $menu)
                    <div wire:key="{{ $menu->id }}">
                        <?php $menuImage = $menu->media->isNotEmpty()
                            ? $menu->media->first()->getUrl()
                            : "https://www.bifolcomatty.co.uk/wp-content/uploads/2019/08/placeholder-square.jpg"; ?>

                        <button
                            class="mx-4 my-2 flex w-fit cursor-pointer flex-col gap-3 rounded-lg bg-[#F3F3F3] px-2 py-4 text-start"
                            wire:click="menuDetail({{ $menu }})"
                        >
                            <img src="{{ $menuImage }}" alt="" class="h-20 w-32 rounded-xl object-cover" />

                            <div class="max-w-32">
                                <h5 class="text-sm">{{ $menu->name ?? "Nama Menu" }}</h5>
                                <p class="line-clamp-2 text-[10px]">
                                    {{ $menu->description ?? "Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel consectetur quas saepe ullam non facilis adipisci nesciunt ex officiis nihil." }}
                                </p>
                            </div>

                            <p class="text-sm font-semibold">Rp {{ number_format($menu->price) ?? "Rp 20,000" }}</p>
                        </button>
                    </div>
                @endforeach
            </section>
        @else
            <!--Set Menu kosong bagaimana-->
            <section class="flex h-[62.5vh] w-full flex-col items-center justify-center gap-2">
                <h1 class="text-sm font-semibold">Mohon maaf, menu untuk kategori ini sedang kosong</h1>
                <p class="text-sm">Silakan melihat menu lain.</p>
            </section>
        @endif
    </main>

    @if ($selectedMenu)
        @livewire("customer.menu-detail", ["name" => "menu-detail", "menu" => $selectedMenu], key($selectedMenu->id))
        {{--
            <x-menu-detail name="menu-detail" title="View Menu">
            <x-slot:body>
            Name: {{ $selectedMenu->name }}
            <br />
            price: {{ $selectedMenu->price }}
            </x-slot>
            </x-menu-detail>
        --}}
    @endif

    @livewire("partial.toast-success")
</div>
