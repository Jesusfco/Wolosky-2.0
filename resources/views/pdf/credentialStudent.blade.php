<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css"> --}}
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    {{-- <link rel="stylesheet" href="{{ url('assets/css/w3.css')}}"> --}}

    <style>
            .border {
                border: 1px black solid;
            }
            .monthlyContainer {
                display: inline-flex;
            }
            .monthlyContainer > div {
                height: 80px;
                width: 25%;
                font-size: 10px;
                display: block;
                /* display:  */
            }
    
            .relative {
                position: relative;
            }
    
            .matriculaContainer {
                position: absolute;
                top: 0;
                right: 0;
                padding: 4px;
            }
    
            .matriculaContainer div{
                padding: 4px;
                border-radius: 2px;
                margin-bottom: 4px;                                
            }
            
            .matricula1 { width: 120px;}            
            .matricula2 { width: 100px;}
    
            .logoTop {
                margin: 0 50px 0 50px;
                display: block;
                height: 80px;
                /* margin-bottom: 200px; */
                /* transform: translateX(-50%); */
            }
    
            .squarePerfilNull {
    
            }
            
            .fullName {
                font-size: 15px;
            }
    
            p {
                margin-top: 0%;
                margin-bottom: 2px;
                font-size: 10px;
            }
    
            .squarePerfilNull {
                height: 100px;
            }

            .spaceInformation {
                height: 150px;
                /* width: %; */
                background: rebeccapurple;
            }

            .photoUserContainer {
                width: 80px;
            }

            .informationUserDiv {
                font-size: 10px !important;
                position: absolute;
                height: 100px;
                width: 100%;
                padding-left: 120px;
            }

            .inscripcionDiv {
                width: 120px;
                height: 80px;
                text-align: center;
                border: 1px black solid;                                
                color: white;
                position: absolute;
                right: 0;
                top: 70px;

                
                /* bottom: 0; */
            }

            .inscripcionDiv div:nth-child(2) {
                background: black;
            }

            .directoraRebeName {
                position: absolute;
                left: 0;
                text-align: center;
            }
        </style>
</head>
<body>        
            
    <div class="w3-row w3-border">

        <div class="w3-col s6 w3-padding relative w3-border" >            
            
            <img class="logoTop" src="{{ url('images/logo1.jpg')}}" style="height:80px">                        
                        
            <div class="matriculaContainer">
                <div class="border matricula1"> Matricula: </div>
                <div class="border matricula2"> GIMNASTA  </div>
            </div>
            
            <p class="fullName"><strong>Nombre:</strong> 
                {{ $user->name }}</p>            

            <div class="spaceInformation relative">
                    
                        <div class="photoUserContainer">
                            {{-- <div class=" img-container"> --}}
                                @if($user->img != NULL)
        
                                {{-- <div class="squarePerfilNull border"></div> --}}
                                <img width="100px" src="{{ url("images/app/users/$user->img")}}">
                                @else
                                <div class="squarePerfilNull border"></div>
                                @endif
                            {{-- </div> --}}
                        </div>
                        <div class="informationUserDiv ">
                            <p><strong>Fecha de Nacimiento:</strong> {{ $user->birthday }}</p>
                            <p><strong>Seguro Médico:</strong> {{ $user->insurance }} 
                                    <strong>CURP:</strong> {{ $user->curp }}</p>
                            <p><strong>Dirección:</strong>
                                    {{ $user->fullAddress() }}</p>
                            <p><strong>Modalidad:</strong> GAF GAV GT GPT TELAS</p>
                            <p><strong>HORARIO:</strong> </p>
                            <p><strong>Fecha de Ingreso:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
                        </div>

                        <div class="inscripcionDiv">
                            <div>INSCRIPCIÓN</div>
                            <div></div>
                        </div>

                        <p class="directoraRebeName">E.D Rebeca Wolosky <br>Directora</p>
                        
                    
            </div>
            
        </div>

        <div class="w3-col s6">

            
            {{-- <div class="w3-cell-row monthlyContainer"></div> --}}
            {{-- <div class="w3-cell-row monthlyContainer">
                <div class="w3-col l3 w3-center w3-border">AGOSTO</div>
                <div class="w3-col l3 w3-center w3-border">SEPTIEMBRE</div>
                <div class="w3-col l3 w3-center w3-border">OCTUBRE</div>
                <div class="w3-col l3 w3-center w3-border">NOVIEMBRE</div>
            </div> --}}
            <div class="w3-row monthlyContainer">
                <div class="w3-col s3 w3-center w3-border">AGOSTO</div>
                <div class="w3-col s3 w3-center w3-border">SEPTIEMBRE</div>
                <div class="w3-col s3 w3-center w3-border">OCTUBRE</div>
                <div class="w3-col s3 w3-center w3-border">NOVIEMBRE</div>
            </div>
            {{-- <br><br><br><br><br><br> --}}
            {{-- <div class="w3-cell-row monthlyContainer">
                <div class=" w3-center w3-border">DICIEMBRE</div>
                <div class=" w3-center w3-border">ENERO</div>
                <div class=" w3-center w3-border">FEBRERO</div>
                <div class=" w3-center w3-border">MARZO</div>
            </div>

            <div class="w3-cell-row monthlyContainer">
                <div class=" w3-center w3-border">ABRIL</div>
                <div class=" w3-center w3-border">MAYO</div>
                <div class=" w3-center w3-border">JUNIO</div>
                <div class=" w3-center w3-border">JULIO</div>
            </div> --}}

            <div>
                <p>- TU CREDENCIAL ES OBLIGATORIA PARA ENTRAR A CLASES</p>
                <p>- TIENES 10 MINUTOS DE TOLERANCIA PARA ENTRAR A LA CLASE</p>
                <p>- UNIFORME OBLIGATORIO TODOS LOS DIAS</p>
                <p>- LA REPOSICIÓN DE TU CREDENCIAL TIENE UN COSTO DE $100</p>
                <p>- TODO PAGO QUEDARÁ REGISTRADO EN LA CREDENCIAL</p>
            </div>

        </div>

    </div>    
    
    
</body>
</html>