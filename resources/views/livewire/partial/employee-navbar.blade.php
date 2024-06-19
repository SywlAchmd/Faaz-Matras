<nav class="flex w-full items-center justify-between bg-sunset-orange px-5 py-2">
    <a href="{{ route("employee") }}" class="flex items-center gap-4" wire:navigate>
        <section class="h-12 w-12 overflow-hidden rounded-full">
            <img src="https://placehold.co/400" alt="logo" />
        </section>

        <section>
            <h1 class="font-semibold text-white sm:text-sm">Rumah Makan</h1>
            <p class="text-sm text-white">Pare-Pare</p>
        </section>
    </a>

    <section
        class="flex h-8 w-[150px] items-center justify-between rounded-lg bg-white px-4 py-6 sm:w-[120px] md:w-[300px] lg:w-[600px] xl:w-[800px]"
    >
        <div class="flex items-center gap-4">
            <div>
                <i class="fa fa-search fa-sm"></i>
            </div>

            <input type="search" placeholder="Cari menu..." class="text-sm outline-none" wire:model.live="search" />
        </div>
    </section>

    <section class="flex flex-row items-center justify-center gap-3">
        <button id="showOrderList" class="flex flex-col items-center gap-0.5">
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
