

<?php $__env->startSection('content'); ?>
<section id="dashboard" class="py-5">
  <div class="container text-center" data-aos="fade-up">
    <h2 class="fw-bold mb-4 text-primary">Selamat Datang di Dashboard</h2>
    <?php if(isset($user)): ?>
<p class="text-secondary">
    Anda sudah masuk sebagai <strong><?php echo e($user->name); ?></strong>
</p>
<?php else: ?>
    <p class="text-secondary">
        Anda belum login.</p>
<?php endif; ?>

    
    <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
      <?php echo csrf_field(); ?>
      <button type="submit" class="btn btn-danger mt-3">
        <i class="bi bi-box-arrow-right"></i> Logout
      </button>
    </form>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Nisa-2SIC\laragon-6.0-minimal\www\PembangunanGuest\resources\views/pages/dashboard.blade.php ENDPATH**/ ?>