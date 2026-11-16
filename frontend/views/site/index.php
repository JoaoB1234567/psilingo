<?php

/** @var yii\web\View $this */

$this->title = 'Psilingo';
?>
<div class="site-index">

    <!-- HERO SECTION (Título simples sem o retângulo verde/azul) -->
    <div class="p-5 mb-4 bg-transparent rounded-3 text-center">
        <div class="container-fluid py-3">
            <h1 class="display-4 fw-bold text-light">Bem-vindo ao Psilingo!</h1>
            <p class="fs-4 text-secondary">A plataforma interativa de aprendizagem de línguas feita a pensar no teu futuro académico e profissional.</p>
        </div>
    </div>

    <div class="body-content">

        <!-- SEÇÃO 1: AS TRÊS LÍNGUAS DO PROJETO -->
        <div class="row text-light mb-5">
            <h2 class="text-center mb-4">Idiomas Disponíveis</h2>
            
            <div class="col-lg-4 mb-3">
                <div class="card bg-dark border-secondary text-light h-100 p-4 text-center">
                    <h3 class="h4">Inglês</h3>
                    <p class="text-secondary">Explora conteúdos dinâmicos de inglês estruturados por níveis CEFR para acelerar a tua fluência profissional e diária.</p>
                    <p><a class="btn btn-outline-light" href="#">Explorar Inglês &raquo;</a></p>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class="card bg-dark border-secondary text-light h-100 p-4 text-center">
                    <h3 class="h4">Francês</h3>
                    <p class="text-secondary">Desenvolve competências de leitura, vocabulário e gramática em francês com exercícios práticos e intuitivos.</p>
                    <p><a class="btn btn-outline-light" href="#">Explorar Francês &raquo;</a></p>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class="card bg-dark border-secondary text-light h-100 p-4 text-center">
                    <h3 class="h4">Espanhol</h3>
                    <p class="text-secondary">Aprende espanhol de forma autónoma e interativa, focando em cenários reais do dia a dia e académico.</p>
                    <p><a class="btn btn-outline-light" href="#">Explorar Espanhol &raquo;</a></p>
                </div>
            </div>
        </div>

        <hr class="border-secondary my-5">

        <!-- SEÇÃO 2: QUEM FEZ O PROJETO (EQUIPA) -->
        <div class="row text-light mb-5">
            <h2 class="text-center mb-4">Quem Fez o Projeto</h2>
            
            <!-- Autor 1 -->
            <div class="col-lg-4 mb-4">
                <div class="card bg-dark border-secondary text-light h-100">
                    <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Foto do Autor">
                    <div class="card-body text-center">
                        <h5 class="card-title">João</h5>
                        <p class="card-text text-secondary">Estudante de Programação de Sistemas de Informação, responsável pelo desenvolvimento backend, base de dados e integração RBAC.</p>
                    </div>
                </div>
            </div>

            <!-- Autor 2 -->
            <div class="card bg-dark border-secondary text-light h-100"> <!-- Correção de estrutura do card -->
            <div class="col-lg-12 mb-4"> <!-- Ajustado para grid correto -->
                </div>
            </div> -->

            <div class="col-lg-4 mb-4">
                <div class="card bg-dark border-secondary text-light h-100">
                    <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Foto do Colega">
                    <div class="card-body text-center">
                        <h5 class="card-title">Colega 1</h5>
                        <p class="card-text text-secondary">Focado na estruturação de conteúdos pedagógicos, interfaces do front-office e design responsivo da plataforma.</p>
                    </div>
                </div>
            </div>

            <!-- Autor 3 -->
            <div class="col-lg-4 mb-4">
                <div class="card bg-dark border-secondary text-light h-100">
                    <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Foto do Colega">
                    <div class="card-body text-center">
                        <h5 class="card-title">Colega 2</h5>
                        <p class="card-text text-secondary">Encarregue pelos testes, documentação do projeto, fluxos de autenticação e validação de regras de negócio.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>