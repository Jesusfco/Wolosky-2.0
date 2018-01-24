<div id="panel">
    <br>
    <div id="panelMargen">
        <br>
        <div id="userKey"><h2>{{ substr(Auth::user()->name,0,1)}}</h2> </div>
        <h3>{{ substr(Auth::user()->name,0,9) }}.</h3>

        <!--<h4 id="adminLevel">
            Administrador
            <span class="glyphicon glyphicon-user" aria-hidden="true" id="chess"></span>
        </h4>-->
        <hr>


        <h4>
            <span class="glyphicon glyphicon-text-background" aria-hidden="true" id="chess"></span>
            Noticias
        </h4>
        <ul>
            <a href="{{ url('admin/noticias/create')}}">
                <li>Crear Nota</li>
            </a>
            <a href="{{ url('admin/noticias/list')}}">
                <li>Lista de Noticias</li>
            </a>
        </ul>

        <hr>

        <h4>
            <span class="glyphicon glyphicon-eur" id="chess"></span>
            Clientes
        </h4>
        <ul>
            <a href="{{ url('/clientes/create')}}">
                <li>Crear cliente</li>
            </a>
            <a href="{{ url('/clientes')}}">
                <li>Lista de clientes</li>
            </a>
            <a href="{{ url('/nacimiento')}}">
                <li>Establecer Nacimiento</li>
            </a>
            <a href="{{ url('/edad')}}">
                <li>Verificar Edad</li>
            </a>
        </ul>
        <hr>

        <h4><span class="glyphicon glyphicon-cog" aria-hidden="true" id="chess"></span>
            Ajustes
        </h4>

        <ul>
            <li>Contraseñas</li>


        </ul>

    </div>
</div>
