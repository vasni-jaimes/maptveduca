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
                <img style="display: block; width: 100%;" src="img/banner.png">
            </td>
        </tr>
        
        <tr>
            <td colspan="2" style="padding: 30px 20px;">
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;">Recibió este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.</p>
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;">Da click en el siguiente enlace para recuperar tu contraseña</p>
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;">Una vez dentro por seguridad cambia tu contraseña.</p>
                {{-- <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;"><a style="color: #000; text-decoration: underline;" href="#">link</a></p> --}}
               
                {{-- Action Button --}}
                @isset($actionText)
                <?php
                    switch ($level) {
                        case 'success':
                        case 'error':
                            $color = $level;
                            break;
                        default:
                            $color = 'primary';
                    }
                ?>
                @component('mail::button', ['url' => $actionUrl, 'color' => $color])
                {{ $actionText }}
                @endcomponent
                @endisset

               

                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;">Recuerda que este link sólo tiene una vigencia de 60 minutos.</p>
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;">Si no has solicitado tu cambio de contraseña, has caso omiso de este mensaje. </p>
                <p style="margin: 0; padding-bottom: 15px; font-size: 15px; line-height: 130%;"><strong>¡Gracias! Nos vemos pronto.</strong></p>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="padding: 20px; background-color: #000;">
                <ul style="padding-left: 0; list-style: none; text-align: center;">
                    <li style="display: inline-block; vertical-align: middle;"><img src="img/facebook.png"></li>
                    <li style="display: inline-block; vertical-align: middle;"><img src="img/instagram.png"></li>
                    <li style="display: inline-block; vertical-align: middle;"><img src="img/youtube.png"></li>
                    <li style="display: inline-block; vertical-align: middle;"><img src="img/email.png"></li>
                    <li style="display: inline-block; vertical-align: middle;"><img src="img/mundo.png"></li>
                </ul>
            </td>
        </tr>
        
    </table>
    
</body>
</html>
