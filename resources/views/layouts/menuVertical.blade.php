<div class="vertical-nav bg-dark" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-dark">
        <div class="media d-flex align-items-center"><img src="/storage/imagens/perfilAngelo.jpg" alt="..." width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
        <div class="media-body">
            <h4 class="m-0" style="color: white">{{ Auth::user()->name }}</h4>
            <p class="font-weight-dark text-muted mb-0">{{ Auth::user()->profissao }}</p>
        </div>
        </div>
    </div>

    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Administração</p>

    <ul class="nav flex-column bg-dark mb-0">
        <li class="nav-item">
        <a href="{{ route('home')}}" class="nav-link text-light font-italic bg-dark">
                    <i class="fas fa-home mr-3 text-primary fa-fw"></i>
                    Home
                </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('projeto_admin')}}" class="nav-link text-light font-italic">
                    <i class="fas fa-project-diagram mr-3 text-primary fa-fw"></i>
                    Projetos
                </a>
        </li>
        <a href="{{ route('perfil')}}" class="nav-link text-light font-italic">
                    <i class="fas fa-user mr-3 text-primary fa-fw"></i>
                    Perfil
                </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('habilidade')}}" class="nav-link text-light font-italic">
                    <i class="fas fa-tools mr-3 text-primary fa-fw"></i>
                    Habilidades
                </a>
        </li>
    </ul>

    
</div>