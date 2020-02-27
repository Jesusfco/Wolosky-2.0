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
            @page { margin: 25px; }
        
            body {
                padding: 0px;
            }
            .border {
                border: 1px black solid;
            }
            .monthlyContainer {
                /* display: inline-flex; */
                width: 100%;
            }
            .monthlyContainer > div {
                height: 80px;
                width: 25%;
                font-size: 12px;
                /* display: block; */
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
    
           
            .fullName {
                font-size: 15px;
            }
    
            p {
                margin-top: 0%;
                margin-bottom: 2px;
                font-size: 10px;
            }
    
            .squarePerfilNull {
                height: 135px;
            }

            .spaceInformation {
                height: 150px;
                /* width: %; */
                background: rebeccapurple;
            }

            .photoUserContainer {
                width: 140px;
            }

            .photoUserContainer img{
                width: 100%;
            }

            .informationUserDiv {
                font-size: 10px !important;
                position: absolute;
                height: 100px;
                width: 100%;
                padding-left: 150px;
            }

            .informationUserDiv td {
                padding: 2px
            }

            .inscripcionDiv {
                width: 120px;
                height: 80px;
                text-align: center;
                border: 1px black solid;                                
                color: white;
                position: absolute;
                right: 0;
                top: 140px;

                
                /* bottom: 0; */
            }

            .inscripcionDiv div:nth-child(2) {
                background: black;
            }

            .directoraRebeName {
                position: absolute;
                left: 11px;
                text-align: center;
                font-size: 12px;
                margin-top: 60px;
                line-height: 13px;
                /* top: 0; */
            }

            .principalTable >tr>td {
                width: 50%
            }
            

            .studentData { width: 50% !important;}
            .mesesTable td {
                width: 25%;
                height: 72px;
            }

            .mesesTable {            
                font-size: 12px;
            }

            .quitPadding { padding:  0 !important; }

            .credentialTerms {                
                padding: 10px;                
            }

            .credentialTerms p {
                font-size:  7px !important;
                margin: 0px !important;
                letter-spacing: 1px;
            }

            .modalidades {
                letter-spacing: 1px;
            }
        </style>
</head>
<body>        
            
    @for($i = 0; $i <=1; $i++)
    <div class="w3-row w3-border">

        <table class="w3-table  principalTable">
            <tr>

                {{-- DATOS DEL ESTUDIANTE IZQUIERDA --}}
              <td class="w3-border studentData relative" style="width: 50% !important;">

                <img class="logoTop" src="{{ url('images/logo1.jpg')}}" style="height:80px">                        
                        
                <div class="matriculaContainer">
                    <div class="border matricula1"> Matricula: </div>
                    <div class="border matricula2"> GIMNASTA  </div>
                </div>
                
                <p class="fullName"><strong>Nombre:</strong> 
                    {{ $user->name }}</p>            

                <div class="spaceInformation relative">
                        
                    <div class="photoUserContainer">
                        
                        @if($user->img != NULL)                                
                            <img src="{{ url("images/app/users/$user->img")}}">
                        @else
                            <div class="squarePerfilNull border"></div>
                        @endif

                        
                    </div>
                    <div class="informationUserDiv ">

                        <table class="w3-table quitPadding minPaddingTd">
                            <tr >
                                <td><strong>Fecha de Nacimiento:</strong> {{ $user->birthday }}</td>
                            </tr>
                        </table>
                        <table class="w3-table quitPadding">                        
                            <tr>
                                <td><strong>Seguro Médico:</strong> {{ $user->insurance }} </td>
                                <td><strong>CURP:</strong> {{ $user->curp }} </td>
                            </tr>
                            <tr>
                                <td><strong>Teléfono:</strong> {{ $user->phone }} </td>
                                <td><strong>Celular:</strong>  {{ $user->referencePhone(0) }}</td>
                            </tr>
                        </table>
                        
                        <p><strong>Dirección:</strong>
                                {{ $user->fullAddress() }}</p>
                        <p><strong>Modalidad:</strong> <span class="modalidades">GAF GAV GT GPT TELAS</span></p>
                        <p><strong>HORARIO:</strong> </p>
                        <p><strong>Fecha de Ingreso:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
                    </div>

                    <div class="inscripcionDiv">
                        <div>INSCRIPCIÓN</div>
                        <div></div>
                    </div>

                    <p class="directoraRebeName">E.D Rebeca Wolosky <br>Directora</p>                    
                            
                        
                </div>

            <!--FINDE ROW TABLE-->
            </td>   

              {{-- PAGOS DEL ESTUDIANTE --}}
              <td class="w3-border payments quitPadding" style="width: 45%;"> 

                <table class="w3-table w3-center mesesTable">
                    <tr>
                      <td class="w3-border">AGOSTO</td>
                      <td class="w3-border">SEPTIEMBRE</td>
                      <td class="w3-border">OCTUBRE</td>
                      <td class="w3-border">NOVIEMBRE</td>
                    </tr>
                    <tr>
                      <td class="w3-border">DICIEMBRE</td>
                      <td class="w3-border">ENERO</td>
                      <td class="w3-border">FEBRERO</td>
                      <td class="w3-border">MARZO</td>
                    </tr>
                    <tr>
                      <td class="w3-border">ABRIL</td>
                      <td class="w3-border">MAYO</td>
                      <td class="w3-border">JUNIO</td>
                      <td class="w3-border">JULIO</td>
                    </tr>                
                </table>
                
                
                <div class="credentialTerms">
                    <p>- TU CREDENCIAL ES OBLIGATORIA PARA ENTRAR A CLASES</p>
                    <p>- TIENES 10 MINUTOS DE TOLERANCIA PARA ENTRAR A LA CLASE</p>
                    <p>- UNIFORME OBLIGATORIO TODOS LOS DIAS</p>
                    <p>- LA REPOSICIÓN DE TU CREDENCIAL TIENE UN COSTO DE $100</p>
                    <p>- TODO PAGO QUEDARÁ REGISTRADO EN LA CREDENCIAL</p>
                </div>

                {{-- <img width="500px" height="50px" style="position: ; margin-top: 5px"  --}}
                

              </td>
              <td style="width: 5% !important" class="quitPadding">
                <img width="300px" height="50px" style="position:absolute; transform: rotate(90deg) translate(50%, 125px); margin: 0, padding: 0" 
                src="data:image/png;base64,{{DNS1D::getBarcodePNG($user->getCodeBar(), 'C128B')}}" 
                alt="barcode" />
              </td>
              
            </tr>
        </table>
 

    </div>    
    
    @endfor
    
</body>
</html>