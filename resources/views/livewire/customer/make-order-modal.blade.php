<div
    x-data="{ showModal: false }"
    x-on:open-modal.window="showModal = true"
    x-on:close-modal.window="showModal = false"
    x-show="showModal"
    class="fixed inset-0 z-50 flex items-end justify-center bg-gray-500 bg-opacity-50"
    style="display: none;"
>
    <div class="relative mx-auto h-auto w-[400px] rounded-t-xl bg-slate-50 p-4">
        <section class="mb-4 mt-1 flex flex-row items-center justify-between">
            <p class="text-lg font-bold">Identitas Pemesanan</p>
            <button x-on:click="showModal = false"><i class="fa-solid fa-circle-xmark fa-xl"></i></button>
        </section>

        <form wire:submit.prevent="submit">
            <section class="my-1 flex flex-col gap-2 pb-2">
                <label class="my-1 font-semibold">Nama Pemesan</label>
                <input
                    type="text"
                    wire:model="customer_name"
                    placeholder="Masukkan nama Anda"
                    class="rounded-lg bg-slate-100 px-2 py-3 focus:border-blue-300 focus:outline-none focus:ring"
                    required
                />
                <label class="mt-3 font-semibold">Nomor Meja</label>
                <input
                    type="text"
                    wire:model="table"
                    placeholder="Masukkan nomor meja"
                    class="rounded-lg bg-slate-100 px-2 py-3 focus:border-blue-300 focus:outline-none focus:ring"
                    required
                    readonly
                />
                <button
                    type="submit"
                    class="text-md mt-4 w-full rounded-lg bg-[#70B44E] px-4 py-3 font-semibold text-white"
                >
                    Pesan
                </button>
            </section>
        </form>
    </div>
</div>
