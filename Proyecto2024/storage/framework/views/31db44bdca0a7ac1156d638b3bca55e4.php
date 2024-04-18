<?php $__env->startSection('title', 'Inicio'); ?>

<?php $__env->startSection('content'); ?>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-interval="1">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="dark-overlay d-flex align-items-start justify-content-center">
          <div class="carousel-caption text-light">
            <h5 class="mb-4">¡Bienvenido a RenovaMarket!</h5>
            <p>En la actualidad, es común que las personas descarten en la basura aquellos objetos que consideran innecesarios o que ya no utilizan. Sin embargo, al reflexionar sobre ello, es posible que esos mismos objetos puedan ser valorados por otras personas y brindarles una segunda oportunidad. Es por ello que crear una aplicación para facilitar a aquellas personas la interacción con otras para poner a la venta aquellos productos que ya no deseen y, de igual manera, encontrar productos que necesites, resulta fundamental.</p>
          </div>
        </div>
        <img src="<?php echo e(asset('img/Carousel/carousel1.jpg')); ?>" class="d-block w-100 carousel-image" alt="Carousel1">
      </div>
      <div class="carousel-item">
        <div class="dark-overlay d-flex align-items-start justify-content-center">
          <div class="carousel-caption text-light">
            <h5 class="mb-4">¡Descubre nuestra variedad de productos de segunda mano y nuevos!</h5>
            <p>La funcionalidad principal de la aplicación es la compra y venta de productos de segunda mano, sin embargo, no se limitará únicamente a esta función. También contará con un apartado que funcionará como una tienda en línea, ofreciendo productos nuevos de excelente calidad. Este agregado proporcionará a los usuarios una amplia gama de opciones, permitiéndoles explorar tanto artículos de segunda mano como productos nuevos y de alto nivel.</p>
          </div>
        </div>
        <img src="<?php echo e(asset('img/Carousel/carousel2.jpg')); ?>" class="d-block w-100 carousel-image" alt="...">
      </div>
      <div class="carousel-item">
        <div class="dark-overlay d-flex align-items-start justify-content-center">
          <div class="carousel-caption text-light">
            <h5 class="mb-4">¡Únete a nuestra comunidad y encuentra lo que necesitas!</h5>
            <p>El objetivo de este proyecto radica en proporcionar a los usuarios de la aplicación la oportunidad de adquirir los productos de otros usuarios, así como también interactuar con ellos a través de mensajes para agilizar y optimizar el proceso de venta. Además, se busca ofrecer la posibilidad de vender productos propios, creando así un entorno dinámico de intercambio comercial.</p>
          </div>
        </div>
        <img src="<?php echo e(asset('img/Carousel/carousel3.jpg')); ?>" class="d-block w-100 carousel-image" alt="...">
      </div>
    </div>
</div>

<style>
  .dark-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
  }

  .text-light {
    color: #fff;
    text-align: center;
  }

  .carousel-image {
    height: 600px;
    object-fit: cover;
  }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Usuario\Desktop\RenovaMarket\Proyecto2024\resources\views/index.blade.php ENDPATH**/ ?>