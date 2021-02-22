<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>MAPtv Educa</title>
</head>

<body style="margin: 0; padding: 0; font-family: 'Poppins', sans-serif; background-color: #f2f2f2;">
	
	<table align="center" cellpadding="0" cellspacing="0" border="0" style="width: 100%; max-width: 600px; background-color: #fff;">
		
		<tr>	
			<td colspan="2">
				<img style="display: block; width: 100%;" src="{{ Request::root() }}/site/img/layouts/evento/banner.png">
			</td>
		</tr>
		
		<tr>
			<td colspan="2" style="padding: 30px 20px;">
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;"><strong>¡Registro exitoso!</strong></p>
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;">Te has registrado a:</p>
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;"><strong>{{ $evento->nombre }}</strong></p>

                @if (!$evento->isArchivado())
                    <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;"><strong>Fecha(s) y horario:</strong> {{ explode(" ", $evento->fecha_lanzamiento)[0] ." / ". explode(" ", $evento->fecha_lanzamiento)[1]   }}</p>
                @endif
                
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;"><strong>Costo y status:</strong></p>
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;"><strong>Costo:</strong> $ {{ $evento->FormatPrecio($evento->precio) }} MXN</p>
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;"><strong>Status:</strong>  {{ $status }} </p>
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;">Gracias por formar parte de MAPtv Educa y las actividades que creamos para ti.</p>
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;">Te esperamos de vuelta en la fecha y horarios indicados arriba. Da click en el siguiente link para ir directamente a tu evento:</p>
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;"><a style="color: #000; text-decoration: underline;" href="{{ route('evento.show', $evento->slug) }}">link al evento</a></p>
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;"><strong>Información importante:</strong></p>
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;">Los eventos suelen ser transmisiones en vivo o retransmisiones, por lo que es importante que estés listo(a) a tiempo en la sección correspondiente al evento dentro de la plataforma.</p>
            </td>
		</tr>

        <tr>
            <td colspan="2" style="padding: 20px; background-color: #000;">
                <ul style="padding-left: 0; list-style: none; text-align: center;">
                    <li style="display: inline-block; vertical-align: middle;"><img src="{{ Request::root() }}/site/img/layouts/evento/facebook.png"></li>
                    <li style="display: inline-block; vertical-align: middle;"><img src="{{ Request::root() }}/site/img/layouts/evento/instagram.png"></li>
                    <li style="display: inline-block; vertical-align: middle;"><img src="{{ Request::root() }}/site/img/layouts/evento/youtube.png"></li>
                    <li style="display: inline-block; vertical-align: middle;"><img src="{{ Request::root() }}/site/img/layouts/evento/email.png"></li>
                    <li style="display: inline-block; vertical-align: middle;"><img src="{{ Request::root() }}/site/img/layouts/evento/mundo.png"></li>
                </ul>
            </td>
        </tr>
		
	</table>
	
</body>
</html>