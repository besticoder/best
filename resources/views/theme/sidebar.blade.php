<ul class="sidebar navbar-nav">
  <li class="nav-item @if(Request::is('home')) active  @endif">
    <a class="nav-link" href="{{route('home')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li class="nav-item @if(Request::is('cars')) active  @endif">
    <a class="nav-link" href="{{route('cars')}}">
      <i class="fas fa-fw fa-car"></i>
      <span>Cars</span></a>
  </li>
</ul>