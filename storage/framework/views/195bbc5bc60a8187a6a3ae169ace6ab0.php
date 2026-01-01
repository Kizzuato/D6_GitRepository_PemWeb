<?php $__env->startSection('title', 'Mini Map'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mt-4">
    <div class="col-12">
        <div class="card bg-dark text-white p-3">
            <h6 class="mb-3">Mini Map</h6>
            <div id="map" style="height:400px;border-radius:12px;"></div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link
  rel="stylesheet"
  href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    console.log('Leaflet:', typeof L)

    const map = L.map('map').setView([-6.9175, 107.6191], 13)

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map)

    setTimeout(() => {
        map.invalidateSize()
    }, 300)
})
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kizzuato/Projects/i-will/rover/pemdas/forte-frontend/resources/views/map.blade.php ENDPATH**/ ?>