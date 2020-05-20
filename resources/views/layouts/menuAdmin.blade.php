
<div class="menuIconContainer" onclick="toogleMenu()" >
  <span class="material-icons">menu</span>
</div>

<div class="panelNav " id="panelNav" style="background-image: url( {{ url('images/navBackground.jpg') }} )">

  <div class="container2">
    <br><br>
    
    <a href="{{ url('/') }}">
      <img width="90%" src="{{ url('images/logo-mail.png')}}"> 
    </a>
    
    <br><br>

  <ul class="navLinks">                    
    
    <li class="@if(Request::is('admin/noticias*')) active @endif">
      <a href="{{ url('admin/noticias') }}">
      <span class="material-icons">people</span>
      Noticias</a></li>
    
    
    {{-- <li><a href="{{ url('app/perfil') }}">Mi Perfil</a></li> --}}
    <li><a href="{{ url('logout') }}">
      <span class="material-icons">power_off</span>
      Cerrar Sesión</a></li>
  </ul>
  </div>

    <div class="authData container">
      <p><i class="material-icons">face</i> 
        {{ Auth::user()->name }}</p>            
      <p><i class="material-icons">perm_contact_calendar</i>
        {{ Auth::user()->user_type() }}</p>
    </div>
</div>