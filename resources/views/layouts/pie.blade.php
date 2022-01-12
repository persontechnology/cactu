<div class="navbar navbar-expand-lg navbar-light">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            Footer
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-footer">
        <span class="navbar-text mx-auto">
            &copy; 2019 - {{ date('Y') }}. <a href="#">CACTU</a> by <a href="https://persontechnology.com/" target="_blank">Person Technology</a>
        </span>

        @auth
        <ul class="navbar-nav ml-lg-auto">
            <li class="nav-item">
                <a href="{{ route('versiones') }}" class="navbar-nav-link"> Versión 1.0</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('soporte') }}" class="navbar-nav-link"><i class="fas fa-question-circle"></i> Soporte</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('manuales') }}" class="navbar-nav-link font-weight-semibold">
                    <span class="text-pink-400"><i class="fas fa-play-circle"></i> Manual</span>
                </a>
            </li>
        </ul>
        @endauth
    </div>
</div>