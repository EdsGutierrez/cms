@extends('emails.master')
@section('content')
<p>Hola: <strong>{{ $name }}</strong></p>
<p></p>
<p>Este es un correo Electrónico que ele ayudara a reestablecer la contraseña de su cuenta en nuestra plataforma</p>
<p>Para continuar haga clic en el siguiente boton e ingrese el sifuiente codigo:
<h2>{{ $code }}</h2>
</p>

<p><a href="{{ url('/reset?email='.$email) }}"
        style="display: inline-block;
        background-color: #2caaff;
        color: #fff; padding: 8px;
        border-radius: 12px;
        text-decoration: none;
        a:hover {
             background-color: red;
            }
        "> Resetear mi contraseña</a></p>

<p>Si el boton anterior no le funciono, copie y peque la siguiente url en su navegador</p>
<p>{{ url('/reset?email='.$email) }}</p>
@stop
