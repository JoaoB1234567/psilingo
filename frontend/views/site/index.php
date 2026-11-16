<?php

/** @var yii\web\View $this */

$this->title = 'Psilingo';
?>
<div class="site-index psilingo-home">

    <!-- HERO -->
    <section class="ps-hero text-center">
        <div class="container py-5">
            <span class="ps-badge ps-badge-accent mb-4">CEFR A1–C2</span>
            <h1 class="ps-hero-title">Bem-vindo ao <span class="ps-gradient-text">Psilingo</span>!</h1>
            <p class="ps-lead mx-auto">A plataforma interativa de aprendizagem de línguas feita a pensar no teu futuro académico e profissional.</p>
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mt-4">
                <a class="btn ps-btn-primary btn-lg" href="#idiomas">Começar Agora</a>
                <a class="btn ps-btn-outline btn-lg" href="<?= \yii\helpers\Url::to(['site/about']) ?>">Saber Mais</a>
            </div>
        </div>
    </section>

    <div class="body-content">

        <!-- IDIOMAS -->
        <section id="idiomas" class="container pb-5">
            <h2 class="ps-section-title text-center">Idiomas Disponíveis</h2>
            <p class="ps-section-sub text-center mx-auto">Escolhe a língua que queres aprender e avança ao teu ritmo.</p>

            <div class="row g-4">
                
                <div class="col-12 col-md-6 col-lg-4 d-flex">
                    <div class="ps-card ps-lang w-100 d-flex flex-column text-center">
                        <div class="ps-icon ps-flag mx-auto" aria-hidden="true">
                        <svg viewBox="0 0 60 30" preserveAspectRatio="xMidYMid slice">
                            <rect width="60" height="30" fill="#012169"/>
                            <path d="M0 0L60 30M60 0L0 30" stroke="#fff" stroke-width="6"/>
                            <path d="M0 0L60 30M60 0L0 30" stroke="#C8102E" stroke-width="2"/>
                            <path d="M30 0v30M0 15h60" stroke="#fff" stroke-width="10"/>
                            <path d="M30 0v30M0 15h60" stroke="#C8102E" stroke-width="6"/>
                        </svg>
                    </div>
                        <h3 class="h4 mt-3">Inglês</h3>
                        <span class="ps-badge mx-auto mb-3">Níveis A1 - C2</span>
                        <p class="ps-text">Explora conteúdos dinâmicos de inglês estruturados por níveis CEFR para acelerar a tua fluência profissional e diária.</p>
                        <a class="btn ps-btn-outline mt-auto" href="#">Explorar Inglês &raquo;</a>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 d-flex">
                    <div class="ps-card ps-lang w-100 d-flex flex-column text-center">
                        <div class="ps-icon ps-flag mx-auto" aria-hidden="true">
                        <svg viewBox="0 0 3 2" preserveAspectRatio="xMidYMid slice">
                            <rect width="1" height="2" fill="#0055A4"/>
                            <rect x="1" width="1" height="2" fill="#fff"/>
                            <rect x="2" width="1" height="2" fill="#EF4135"/>
                        </svg>
                    </div>
                        <h3 class="h4 mt-3">Francês</h3>
                        <span class="ps-badge mx-auto mb-3">Níveis A1 - C2</span>
                        <p class="ps-text">Desenvolve competências de leitura, vocabulário e gramática em francês com exercícios práticos e intuitivos.</p>
                        <a class="btn ps-btn-outline mt-auto" href="#">Explorar Francês &raquo;</a>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 d-flex">
                    <div class="ps-card ps-lang w-100 d-flex flex-column text-center">
                    <div class="ps-icon ps-flag mx-auto" aria-hidden="true">
                        <svg viewBox="0 0 3 2" preserveAspectRatio="xMidYMid slice">
                            <rect width="3" height="2" fill="#AA151B"/>
                            <rect y="0.5" width="3" height="1" fill="#F1BF00"/>
                        </svg>
                    </div>
                        <h3 class="h4 mt-3">Espanhol</h3>
                        <span class="ps-badge mx-auto mb-3">Níveis A1 - C2</span>
                        <p class="ps-text">Aprende espanhol de forma autónoma e interativa, focando em cenários reais do dia a dia e académico.</p>
                        <a class="btn ps-btn-outline mt-auto" href="#">Explorar Espanhol &raquo;</a>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>