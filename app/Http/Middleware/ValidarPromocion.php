<?php

namespace App\Http\Middleware;

use Closure;

class ValidarPromocion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $correos = [
            'baster07mi@hotmail.com',
            'jimenaoropeza.map@gmail.com',
            'esg_dickinson@hotmail.com',
            'boredinirak@gmail.com',
            'gab.zarate15@gmail.com',
            'maa_nnu@hotmail.com',
            'martimvite@gmail.com',
            'jesus_bautistav@outlook.com',
            'marioferro043@gmail.com',
            'crodaalejandro@gmail.com',
            'jumadi.oficial.7@gmail.com',
            'cesar142550@outlook.com',
            'moydoublebasshorn.2002@gmail.com',
            'hoofeneltec@gmail.com',
            'dectorjei@gmail.com',
            'angelgael186@gmail.com',
            'gabrielgonzalez4303@gmail.com',
            'ferrang.fgc.7@gmail.com',
            'dtscdtsc03@gmail.com',
            'chiva.fm@hotmail.com',
            'Morabali21@gmail.com', 
            'quantikq@gmail.com',
            'adriandiosdado77@gmail.com',
            'cesarjohanan@gmail.com',
            'brandquez8@gmail.com',
            'mano.salinas10@gmail.com', 
            'alexadarko0@gmail.com',
            'carlosducoflores@gmail.com',
            'subzeroraiden26@gmail.com',
            'Fernandokurezynh@gmail.com',
            'lgiovanylh@hotmail.com',
            'edsongar9976@gmail.com',
            'boyhood.mx@gmail.com',
            'spucca24@gmail.com',
            'yahiralvarez2209@gmail.com',
            'aldair.ramirez2182@gmail.com',
            'diego_654om@outlook.com',
            'paz64091@gmail.com',
            'agustinedh1111@gmail.com', 
            'dilonmanpug@gmail.com',
            'ricardocastroquesada@outlook.com',
            'amagalaxi.2000@hotmail.com',
            'evelynjimenez3312@gmail.com',
            'javier.trueba.jimenez@gmail.com',
            'andresmtzz96@gmail.com',
            'fabipas0406@gmail.com',
            'emmanueldc7@hotmail.com',
            'iker12santin@gmail.com',
            'emirenn1331@gmail.com',
            'anaelinoemi@gmail.com',
            'charlyfrang@gmail.com', 
            'luisernestorojas.ro@gmail.com',
            'rossetedgar@gmail.com',
            'vaporlose@gmail.com',
            'emiliogomez51@gmail.com',
            'manolocc@outlook.com',
            'marcosdanielza@gmail.com', 
            'gaelscrew@hotmail.com',
            'josuenorberto@live.com.mx',
            'isaac.garita08@outlook.com',
            'Carlosalfpr@gmail.com',
            'alanjaretcr@gmail.com',
            'Brunosava10@gmail.com',
            'alfonsogarciamelchor@gmail.com',
            'gaboencinas31@gmail.com',
            'richiezp1997@gmail.com',
            'gaelcitojus56@gmail.com',
            'Skrl_3@hotmail.com',
            'Jesus876@live.com.mx',
            'Asantiagoaltamirano@gmail.com', 
            'Mchuck.contacto@gmail.com',
            'royandrik.cruz@gmail.com',
            'blckbiteofficial@gmail.com',
            'israelfernandezosorio@gmail.com',
            'daniuri79@gmail.com',
            'esaufrancisco192@gmail.com',
            'rodrirome1234@gmail.com',
            'victorconde2009@gmail.com',
            'napm10399@gmail.com',
            'rodrigovazlie@outlook.com',
            'israelyosue@hotmail.com',
            'Luisgutierrez.lcvg@gmail.com',
            'lozadabrian7@gmail.com',
            'vivar1411@gmail.com',
            'lucegomez98@gmail.com',
            'djanthonyhard@gmail.com',
            'memo2639@hotmail.com',
            'jazgrgg@hotmail.com',
            'Jorgeanthoniohuerta.map@gmail.com',
            'efren.dap@gmail.com',
            'uziel.tobon@hotmail.com',
            'kikexhs15@gmail.com',
            'osvaldodgarcia94@gmail.com',
            'uri.hr12@gmail.com',
            'castaneyramiguel@gmail.com',
            'EduardoBR1502@Gmail.com',
            'Domo-p2@hotmail.com',
            'rojasberre@gmail.com',
            '22.vf.david@gmail.com',
            'mikamusicmx@hotmail.com',
            'drodriguezguia@gmail.com',
            'luuis13@outlook.com',
            'ah4845145@gmail.com',
            'aaronrl@live.com.mx',
            'a-sanchez-n@hotmail.com', 
            'curro_edwin@outlook.com',
            'luisedag2906@gmail.com',
            'rayqb.04@gmail.com',
            'ulipinsol@gmail.com',
            'robertomtzb12@gmail.com',
            'Yml12.ya@hotmail.com',
            'brehmeruiz97@gmail.com',
            'jon4dez@gmail.com',
            'yalexosan@gmail.com',
            'angelespinosam2000@gmail.com',
            'diann160600@gmail.com',
            'itsarilara@gmail.com',
            'legp.enrique.gamez@gmail.com',
        ];


        $busqueda = array_search(auth()->user()->email,$correos,false);

        if (!$busqueda) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
