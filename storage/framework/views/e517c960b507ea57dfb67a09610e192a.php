

<?php $__env->startSection('title', 'Kontak Kami'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5 text-center">
    <h1 class="text-primary fw-bold">Hubungi Kami</h1>
    <p class="text-muted mb-4">Silakan kirim pesan atau pertanyaan Anda melalui form di bawah ini.</p>

    <form class="mx-auto" style="max-width: 500px;">
        <div class="mb-3 text-start">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" placeholder="Masukkan nama Anda">
        </div>
        <div class="mb-3 text-start">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="Masukkan email Anda">
        </div>
        <div class="mb-3 text-start">
            <label class="form-label">Pesan</label>
            <textarea class="form-control" rows="4" placeholder="Tulis pesan Anda..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary px-4">Kirim Pesan</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Nisa-2SIC\laragon-6.0-minimal\www\PembangunanGuest\resources\views/pages/contact.blade.php ENDPATH**/ ?>