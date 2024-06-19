<div class="relative mx-auto h-[100vh] w-[400px] bg-orange-500">
    <main class="h-full w-full">
        <section class="sticky top-0 flex h-16 w-full items-center justify-between px-6">
            <a
                href="{{ route("customer_order", ["table" => request()->query("table"), "orderType" => request()->query("orderType")]) }}"
            >
                <i class="fa-solid fa-xmark fa-xl text-white"></i>
            </a>
        </section>
        <section class="flex h-[70vh] flex-col items-center justify-center gap-1">
            <i class="fa-solid fa-circle-check mb-4 text-white" style="font-size: 100px"></i>
            <h1 class="text-xl font-semibold text-white">Terima kasih!</h1>
            <p class="font-medium text-white">Pesanan anda sedang diproses</p>
        </section>
    </main>
</div>
