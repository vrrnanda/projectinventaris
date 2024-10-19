<div class="col-lg-12">
    <nav class="navbar navbar-expand-lg navbar">
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <img src="{{asset('assets/img/logos/logobaru.png') }}" alt="" width="60" height="60">
            <ul class="navbar-nav ml-auto">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                    <img class="{{asset('assets/img-profile rounded-circle')}}" src="{{asset('assets/img/undraw_profile.svg')}}" width="45px">
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{route('logout')}}" data-toggle="modal" data-target="#logoutModal" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout</a>
                </div>
            </ul>
        </div>
    </nav>
</div>









