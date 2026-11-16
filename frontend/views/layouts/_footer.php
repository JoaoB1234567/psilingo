<?php use yii\helpers\Url; ?>
<footer id="footer" class="ps-footer mt-auto">
    <div class="container">
        <div class="row g-4 py-5">
            <div class="col-12 col-lg-5">
                <a class="ps-footer-brand" href="<?= Url::to(['site/index']) ?>">Psilingo</a>
                <p class="ps-footer-slogan mb-0">A tua plataforma interativa para dominar novas línguas.</p>
            </div>
            <div class="col-6 col-lg-3">
                <h2 class="ps-footer-title">Navegação</h2>
                <ul class="ps-footer-links">
                    <li><a href="<?= Url::to(['site/index']) ?>">Início</a></li>
                    <li><a href="<?= Url::to(['site/index', '#' => 'idiomas']) ?>">Idiomas</a></li>
                    <li><a href="<?= Url::to(['site/about']) ?>">Sobre Nós</a></li>
                    <li><a href="<?= Url::to(['site/contact']) ?>">Contacto</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-4">
                <h2 class="ps-footer-title">Idiomas</h2>
                <ul class="ps-footer-links">
                    <li><a href="#">Inglês</a></li>
                    <li><a href="#">Francês</a></li>
                    <li><a href="#">Espanhol</a></li>
                </ul>
            </div>
        </div>
        <div class="ps-footer-bottom">
            © <?= date('Y') ?> Psilingo. Todos os direitos reservados.
        </div>
    </div>
</footer>