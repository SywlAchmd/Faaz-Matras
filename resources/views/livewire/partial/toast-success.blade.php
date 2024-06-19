<div
    x-data="{ showToast: false }"
    x-show="showToast"
    x-on:show-toast.window="
        showToast = true
        setTimeout(() => (showToast = false), 3000)
    "
    x-on:close-toast.window="showToast = false"
    x-transition:enter="transition duration-300 ease-out"
    x-transition:enter-start="scale-90 transform opacity-0"
    x-transition:enter-end="scale-100 transform opacity-100"
    x-transition:leave="transition duration-300 ease-in"
    x-transition:leave-start="scale-100 transform opacity-100"
    x-transition:leave-end="scale-90 transform opacity-0"
    class="absolute right-0 top-10 z-50 flex w-fit gap-8 rounded-lg border-2 border-moon-gray bg-white p-4 shadow-2xl"
>
    <section class="flex gap-2">
        <i class="fa-regular fa-circle-check text-[#4ECB71]"></i>
        <div class="-mt-1">
            <p class="text-sm font-medium">Berhasil</p>
            <p class="text-sm">Berhasil Menambahkan Menu</p>
        </div>
    </section>
    <button x-on:click="showToast = false">
        <i class="fa-solid fa-xmark text-[#454343]"></i>
    </button>
</div>
