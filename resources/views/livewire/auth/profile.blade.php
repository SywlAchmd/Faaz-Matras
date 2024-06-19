<div class="flex h-screen w-full flex-col items-center justify-center">
    <nav class="absolute top-0 flex w-full items-center justify-between bg-sunset-orange px-5 py-2">
        <a href="{{ route("employee") }}" class="flex items-center gap-4" wire:navigate>
            {{--
                <section class="h-12 w-12 overflow-hidden rounded-full">
                <img src="https://placehold.co/400" alt="logo" />
                </section>
            --}}
            <i class="fa-solid fa-house text-2xl text-white"></i>

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
            <a class="flex flex-col items-center gap-0.5">
                <i class="fa fa-clipboard-list fa-md text-white"></i>
                <p class="text-sm text-white">Orders</p>
            </a>

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

    <section class="card-profile rounded-xl bg-white p-6 shadow-lg">
        <div class="w-2/5">
            <h1 class="text-left text-2xl font-bold">Account Settings</h1>
            <p class="text-left">Ubah informasi akun kamu di sini</p>
        </div>

        <form class="w-3/5" wire:submit.prevent="update">
            <div class="flex flex-col gap-4">
                <section class="flex flex-col gap-2">
                    <label class="font-semibold">
                        Username
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        @class(["input-bordered w-full rounded-lg bg-gray-200 px-3 py-2 outline-none", "input-error" => $errors->first("username")])
                        wire:model="username"
                    />
                    @error("username")
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </section>

                <section class="flex flex-col gap-2">
                    <label class="font-semibold">Email</label>
                    <input
                        type="email"
                        @class(["input-bordered w-full rounded-lg bg-gray-200 px-3 py-2 outline-none", "input-error" => $errors->first("email")])
                        wire:model="email"
                    />
                    @error("email")
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </section>

                <section class="flex flex-col gap-2">
                    <label class="font-semibold">Password</label>
                    <input
                        type="password"
                        @class(["input-bordered w-full rounded-lg bg-gray-200 px-3 py-2 outline-none", "input-error" => $errors->first("password")])
                        wire:model="password"
                    />
                    @error("password")
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </section>
            </div>

            @if (session()->has("message"))
                <div class="text-green-500">{{ session("message") }}</div>
            @endif

            <div class="mt-4 flex w-full justify-end">
                <button class="btn w-1/4 rounded-lg bg-green-700 py-2 text-white" wire:loading.attr="disabled">
                    <span wire:loading.remove>Simpan</span>
                    <span wire:loading>Loading...</span>
                </button>
            </div>
        </form>
    </section>
</div>
