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
  <li class="nav-item @if(Request::is('cell_phone')) active  @endif">
    <a class="nav-link" href="{{route('cell_phone')}}">
      <i class="fas fa-fw fa-mobile-alt"></i>
      <span>Cell Phone</span></a>
  </li>
  <li class="nav-item @if(Request::is('inventory')) active  @endif">
    <a class="nav-link" href="{{route('inventory')}}">
      <i class="fas fa-fw fa-truck-moving"></i>
      <span>Inventory</span></a>
  </li>
</ul>