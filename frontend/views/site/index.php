<?php

/** @var yii\web\View $this */

$this->title = 'Psilingo';
?>
<div class="site-index">

    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center text-sm-start" style="background: linear-gradient(135deg, #22c55e 0%, #3b82f6 100%); border-radius: 1rem; padding: 3rem; color: white;">
            <h1 class="display-4 fw-bold">Bem-vindo ao Psilingo!</h1>
            <p class="fs-4 col-md-8">A plataforma interativa de aprendizagem de línguas feita a pensar no teu futuro académico e profissional. Rápida, intuitiva e moderna.</p>
            <p>
                <a class="btn btn-lg btn-light fw-bold text-dark px-4 me-2" href="<?= \yii\helpers\Url::to(['/site/about']) ?>">Sobre Nós</a>
                <a class="btn btn-lg btn-outline-light px-4" href="<?= \yii\helpers\Url::to(['/site/signup']) ?>">Criar Conta</a>
            </p>
        </div>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 mb-3">
                <h2>Módulos de Idiomas</h2>
                <p>Explora os vários cursos de línguas disponíveis, desenhados com conteúdos dinâmicos para acelerar o teu desenvolvimento e prática diária.</p>
                <p><a class="btn btn-outline-secondary" href="#">Ver Cursos &raquo;</a></p>
            </div>
            <div class="col-lg-4 mb-3">
                <h2>Gestão de Perfil</h2>
                <p>Acompanha o teu progresso, gere as tuas preferências de aprendizagem e personaliza a tua experiência de forma simples e segura na plataforma.</p>
                <p><a class="btn btn-outline-secondary" href="<?= \yii\helpers\Url::to(['/site/login']) ?>">Área de Utilizador &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Suporte e Ajuda</h2>
                <p>Tens alguma dúvida sobre o funcionamento do Psilingo ou precisas de entrar em contacto com a nossa equipa de suporte? Estamos aqui para ajudar.</p>
                <p><a class="btn btn-outline-secondary" href="<?= \yii\helpers\Url::to(['/site/contact']) ?>">Contactar &raquo;</a></p>
            </div>
        </div>

    </div>
</div>