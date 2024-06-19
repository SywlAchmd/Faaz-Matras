<div class="flex h-screen w-full items-center justify-center">
    <form class="card" wire:submit.prevent="login">
        <h1 class="text-center text-2xl font-bold">Login</h1>

        <div>
            <section class="flex flex-col gap-2">
                <label class="text-lg font-bold">
                    Username
                    <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    @class(["input-bordered w-full rounded-xl border border-gray-400 p-3 outline-none", "input-error" => $errors->first("username")])
                    wire:model="username"
                />
                @error("username")
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </section>
        </div>

        <div>
            <section class="flex flex-col gap-2">
                <label class="text-lg font-bold">
                    Password
                    <span class="text-red-500">*</span>
                </label>
                <input
                    type="password"
                    @class(["input-bordered w-full rounded-xl border border-gray-400 p-3 outline-none", "input-error" => $errors->first("password")])
                    wire:model="password"
                />
                @error("password")
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </section>
        </div>

        <div class="flex items-center">
            <input type="checkbox" id="rememberMe" class="mr-2" />
            <label for="rememberMe">Remember me</label>
        </div>

        @if ($errorMessage)
            <div class="text-red-500">{{ $errorMessage }}</div>
        @endif

        <button
            class="btn flex w-full items-center justify-center bg-sunset-orange text-white"
            wire:loading.attr="disabled"
            wire:target="login"
        >
            <span wire:loading.remove wire:target="login">Login</span>
            <span wire:loading wire:target="login">
                <svg
                    class="h-5 w-5 animate-spin text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                    ></path>
                </svg>
            </span>
        </button>
    </form>
</div>
