<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLYMPIA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
   
<main class="">
    <div class="py-3 bg-white">
        @auth 
        <div class="flex justify-end mr-5">
            <form method="POST" action="{{ route('logout') }}" class="btn btn-primary">
                @csrf
                <a href="{{route('logout')}}" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    <span class="navText">Deconnexion</span>
                </a>
    
            </form>
        </div>
        @endauth

        @guest()
        <div class="flex gap-4 item-center justify-end mr-5">
            <a href="{{route('login')}}" class="btn btn-primary">
                <span class="text text-1">Connexion</span>
            </a>
            <a href="{{route('register')}}" class="btn btn-primary border-[#393333] text-[#393333]">
                <span class="text text-1">Inscription</span>
            </a>
        </div>
        @endguest
    </div>  
    <!-- BANNIERE PAGE ACCUEIL -->
    
    <!-- HEADER-SLIDER -->
    <section class="hero text-center" aria-label="home" id="home">

        <ul class="hero-slider" data-hero-slider>

            <li class="slider-item active" data-hero-slider-item>

                <div class="slider-bg">
                    <img src="{{asset('images/etudiants.jpg')}}" alt="image banniere 1" class="img-cover">
                </div>

                <div class="cover">
                    <p class="label-2 section-subtitle slider-reveal font-bold">Prends le contrôle de ton avenir</p>
            
                    <h1 class="display-1 hero-title slider-reveal">
                        Une nouvelle aventure commence <br /> aujourd’hui
                    </h1>

                </div>

            </li>

            <li class="slider-item" data-hero-slider-item>

                <div class="slider-bg">
                    <img src="{{asset('images/etudiants2.jpeg')}}" width="1880" height="950" alt="" class="img-cover">
                </div>

                <div class="cover">
                    <p class="label-2 section-subtitle slider-reveal font-bold">Révèle ton potentiel</p>
            
                    <h1 class="display-1 hero-title slider-reveal">
                        Entoure-toi d’opportunités <br /> vise l’excellence
                    </h1>
                </div>

            </li>

            <li class="slider-item" data-hero-slider-item>

                <div class="slider-bg">
                    <img src="{{asset('images/etudiants3.jpg')}}" width="1880" height="950" alt="image banniere 2" class="img-cover">
                </div>

                <div class="cover">
                    <p class="label-2 section-subtitle slider-reveal font-bold">Construis la vie que tu mérites</p>
            
                    <h1 class="display-1 hero-title slider-reveal">
                        Chaque grand parcours débute <br /> par une décision
                    </h1>

                </div>

            </li>

        </ul>

        <button class="slider-btn prev" aria-label="slide to previous" data-prev-btn>
            <svg class="angles" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" fill="#ccc" stroke="currentColor" height="20" width="20"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
        </button>

        <button class="slider-btn next" aria-label="slide to next" data-next-btn>
            <svg class="angles" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" fill="#ccc" height="20" width="20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/></svg>
        </button>

    </section>
    <!-- FIN BANNIERE PAGE ACCUEIL -->
    

    <!-- FIN SECTION FORMULAIRE -->
    
    <!-- AFFICHAGE DES ETUDIANTS -->
     
    <section class="relative">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <livewire:list-etudiants />
                <livewire:etudiant-edit />
                <livewire:etudiant-show />
            </div>
        </div>

            
    <!-- SECTION FORMULAIRE -->

    <div class="section-form">
        <livewire:etudiants-form />
    </div>
    
    </section>
</main>
<script src="header.js"></script>
@livewireScripts
</body>
</html>
