<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-header-footer">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home.index') }}">
        {{-- @include('layouts.blocks.logo') --}}
        HOME
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto" id="header_menu_main">
          <li class="nav-item active">
            <a class="nav-link link-menu" href="">Triky</a>
          </li>
          <li class="nav-item">
            <a class="nav-link link-menu" href="">Video Lekce</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" href="#">Projekty</a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link link-menu" href="">Kontakt</a>
          </li>
        </ul>
        <script>
            document.querySelectorAll('#header_menu_main a[href="'+location.href+'"]').forEach(link => link.classList.add('active'));
        </script>
      </div>
    </div>
</nav>
