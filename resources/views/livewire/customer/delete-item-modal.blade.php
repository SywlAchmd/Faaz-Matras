<section
    x-data="{ openDeleteItem: false }"
    x-show="openDeleteItem"
    x-on:open-delete-item.window="openDeleteItem = true"
    x-on:close-delete-item.window="openDeleteItem = false"
    class="h-full w-full bg-gray-400 bg-opacity-50"
>
    <div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 350px">
        <section class="w-full rounded-lg bg-white px-8 py-6 sm:px-2 md:px-4">
            <section class="flex h-full w-full flex-col items-center gap-2 text-center">
                <i class="fa-solid fa-circle-exclamation fa-2xl my-4 text-red-500"></i>
                <p class="text-lg font-bold">Hapus menu ini?</p>
                <p class="text-wrap text-sm">Apakah anda yakin ingin menghapus menu ini dari keranjang?</p>
            </section>
            <section class="mt-4 flex flex-row gap-2 py-2">
                <button
                    x-on:click="openDeleteItem = false"
                    id="closeDelete"
                    class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold"
                    style="width: 50%"
                >
                    Batal
                </button>
                <button
                    wire:click="confirmDelete"
                    id="deleteThisItem"
                    class="rounded-lg bg-red-500 px-4 py-2 text-sm font-semibold text-white"
                    style="width: 50%"
                >
                    Ya, hapus
                </button>
            </section>
        </section>
    </div>
</section>
