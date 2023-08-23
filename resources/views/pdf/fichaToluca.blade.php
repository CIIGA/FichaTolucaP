<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ficha Toluca</title>
    <link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/cartomaps/erdmcarto/fichaCataTolucaP/FichaTolucaP/public/css/pdf.css" rel="stylesheet">
    
</head>

<body>
    <header>
    </header>
    <main>
        <div>
            <!--tabla principal-->
            <table>
                <tr>
                    <th colspan="19" class="bold td_title_color">CÉDULA DE INVESTIGACIÓN CATASTRAL</th>
                </tr>
                <tbody>
                    <tr class="">
                        <td colspan="3" class="bold td_color">FOLIO</td>
                        <td colspan="3">{{ isset($datos->folio) ? $datos->folio : '' }}</td>

                        <td colspan="3" class="bold td_color">FECHA</td>
                        <td colspan="3">{{ $datos->fecha }}</td>
                        <td colspan="3" class="bold td_color">MOTIVO</td>
                        <td colspan="4">{{ $datos->motivo }}</td>
                    </tr>
                    <tr class="">
                        <td colspan="19" class=" td_title_color"></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="bold td_color">Clave Catastral</td>
                        <td colspan="16" class="text_red underline">{{ $datos->clavec }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="bold td_color">Calle</td>
                        <td colspan="5">{{ $datos->calle1 }}</td>
                        <td colspan="2" class="bold td_color">N. Ext</td>
                        <td colspan="2">{{ $datos->numext1 }}</td>
                        <td colspan="2" class="bold td_color">Núm. Int</td>
                        <td colspan="2">{{ $datos->numint1 }}</td>
                        <td colspan="2" class="bold td_color">C.P.</td>
                        <td colspan="2">{{ $datos->cp1 }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="bold td_color">Col. Fracc. Barrio</td>
                        <td colspan="5">{{ $datos->colonia1 }}</td>
                        <td colspan="4" class="bold td_color">Localidad</td>
                        <td colspan="6">{{ $datos->localidad }}</td>

                    </tr>
                    <tr>
                        <td colspan="3" class="bold td_color">Régimen de Propiedad </td>
                        <td colspan="6">{{ $datos->regimen }}</td>
                        <td colspan="3" class="bold td_color">Uso de Suelo</td>
                        <td colspan="7">{{ $datos->uso }}</td>
                    </tr>
                    <tr>
                        <th colspan="19" class="bold td_title_color">DATOS DEL POSEEDOR</th>
                    </tr>
                    <tr>
                        <td colspan="6" class="bold td_color">Nombre del propietario o poseedor</td>
                        <td colspan="13">{{ $datos->propietario }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="bold td_color">R.F.C.</td>
                        <td colspan="5">{{ $datos->rfc }}</td>
                        <td colspan="4" class="bold td_color">CURP</td>
                        <td colspan="8">{{ $datos->curp }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="bold td_color">Calle</td>
                        <td colspan="5">{{ $datos->calle2 }}</td>
                        <td colspan="2" class="bold td_color">N. Ext</td>
                        <td colspan="2">{{ $datos->numext2 }}</td>
                        <td colspan="2" class="bold td_color">Núm. Int</td>
                        <td colspan="2">{{ $datos->numint2 }}</td>
                        <td colspan="2" class="bold td_color">C.P</td>
                        <td colspan="2">{{ $datos->cp2 }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="bold td_color">Col, Fracc, Barrio</td>
                        <td colspan="5">{{ $datos->colonia2 }}</td>
                        <td colspan="3" class="bold td_color">Localidad</td>
                        <td colspan="7">{{ $datos->localidad2 }}</td>
                    </tr>

                    <tr>
                        <td colspan="3" class="bold td_color">Municipio</td>
                        <td colspan="6">{{ $datos->municipio2 }}</td>
                        <td colspan="3" class="bold td_color">Telefono</td>
                        <td colspan="7">{{ $datos->telefono }}</td>
                    </tr>

                    <tr>
                        <th colspan="19" class="bold td_title_color">DATOS DEL TERRENO</th>
                    </tr>
                    <tr>
                        <td colspan="2" class="bold td_color">Superficie (m2)</td>
                        <td colspan="2" class="bold td_color">Frente (m)</td>
                        <td colspan="2" class="bold td_color">Factor</td>
                        <td colspan="2" class="bold td_color">Fondo (m)</td>
                        <td colspan="2" class="bold td_color">Factor</td>
                        <td colspan="3" class="bold td_color">Posición</td>
                        <td colspan="2" class="bold td_color">Factor</td>
                        <td colspan="2" class="bold td_color">Topografía</td>
                        <td colspan="2" class="bold td_color">Irregularidad</td>

                    </tr>
                    <tr>
                        <td colspan="2" style="background-color: {{ $datos->color1 }}">
                            {{ number_format($tabla1->SUPTERRTOT, 2) }}</td>
                        <td colspan="2"style="background-color: {{ $datos->color2 }}">
                            {{ number_format($tabla1->FRENTE, 2) }}</td>
                        <td colspan="2"style="background-color: {{ $datos->color3 }}">
                            {{ number_format($tabla1->NFRENTE, 5) }}</td>
                        <td colspan="2"style="background-color: {{ $datos->color4 }}">
                            {{ number_format($tabla1->FONDO, 2) }}</td>
                        <td colspan="2"style="background-color: {{ $datos->color5 }}">
                            {{ number_format($tabla1->NFFONDO, 5) }}</td>
                        <td colspan="3"style="background-color: {{ $datos->color6 }}">
                            {{ number_format($tabla1->UBICACION, 0) }}</td>
                        <td colspan="2"style="background-color: {{ $datos->color7 }}">
                            {{ number_format($tabla1->NFUBIC, 5) }}</td>
                        <td colspan="2"style="background-color: {{ $datos->color8 }}">
                            {{ number_format($tabla1->NFTOPOGR, 5) }}</td>
                        <td colspan="2"style="background-color: {{ $datos->color9 }}">
                            {{ number_format($tabla1->NFIRREG, 5) }}</td>

                    </tr>
                    <tr>
                        <td colspan="2" class="bold td_color td_lp">Área Inscrita</td>
                        <td colspan="2"style="background-color: {{ $datos->color10 }}">
                            {{ number_format($tabla1->NFAREA, 5) }}</td>
                        <td colspan="3" class="bold td_color">Superficie Aprovechamiento</td>
                        <td colspan="2"style="background-color: {{ $datos->color11 }}">
                            {{ number_format($tabla1->NFSUPAPR, 5) }}</td>
                        <td colspan="2" class="bold td_color">Factor Aplicable</td>
                        <td colspan="2"style="background-color: {{ $datos->color12 }}">
                            {{ number_format($FA, 5) }}</td>
                        <td colspan="1" class="bold td_color">B.V.</td>
                        <td colspan="2"style="background-color: {{ $datos->color13 }}">{{ $datos->bh }}</td>
                        <td colspan="1" class="bold td_color">A.H.</td>
                        <td colspan="2"style="background-color: {{ $datos->color14 }}">{{ $datos->ah }}</td>
                    </tr>
                    <tr>
                        <th colspan="19" class="bold td_title_color">VALORES CATASTRALES ACTUALES</th>
                    </tr>
                    <tr>
                        <td colspan="1" class="bold td_color2">No.</td>
                        <td colspan="1" class="bold td_color2">Tipología</td>
                        <td colspan="2" class="bold td_color2" style="width: 20px !important">Superficie
                            <span><br></span>(ml, m2, m3)
                        </td>
                        <td colspan="1" class="bold td_color2">Niveles</td>
                        <td colspan="1" class="bold td_color2">Edad</td>
                        <td colspan="1" class="bold td_color2">G.C.</td>
                        <td colspan="3" class="bold td_color2">Factor Aplicable</td>
                        <td colspan="4" class="bold td_color2">Ocupación Actual</td>
                        <td colspan="5" class="bold td_color2">Valor Construcción</td>
                    </tr>
                    @php
                        $contador = 0; // Inicializar el contador
                    @endphp

                    @foreach ($vcactuales as $item)
                        {{ $color = $vcactuales_color[($i += 1) - 1]->color }}
                        <tr style="background-color: {{ $color }}">
                            <td colspan="1">{{ $vcactuales_color[$i - 1]->numero }}<br></td>
                            <td colspan="1">{{ $item->TIPOLOGIA }}</td>
                            <td colspan="2">{{ number_format($item->SUPCONS, 0) }}</td>
                            <td colspan="1">{{ number_format($item->NIVCONS, 0) }}</td>
                            <td colspan="1">{{ round($item->ANIODECONS) }}</td>
                            <td colspan="1"> {{ number_format($item->ESTADOCONS, 0) }}</td>
                            <td colspan="3">{{ number_format($item->FACTORNIV, 5) }}</td>
                            <td colspan="4" class="td_lp">{{ ucwords(strtolower($item->DESCRCLCAT)) }}</td>
                            <td colspan="5">${{ number_format($item->VALORCONS, 2) }}</td>
                        </tr>
                        @php
                            $contador++; // Incrementar el contador en cada iteración
                        @endphp
                    @endforeach
                    @for ($i = $contador; $i < 10; $i++)
                        <tr>
                            <td colspan="1">{{ $contador += 1 }}</td>
                            <td colspan="1"></td>
                            <td colspan="2"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="3"></td>
                            <td colspan="4"></td>
                            <td colspan="5"></td>
                        </tr>
                    @endfor
                    <tr>
                        <td colspan="9" class="bold td_color2">Construcción Total (m2)</td>
                        <td colspan="10">{{ number_format($construccion_t->CT, 2) }}</td>

                    </tr>
                    <tr>
                        <td colspan="5" class="bold td_color">Valor de Terreno</td>
                        <td colspan="8" class="bold td_color">Valor de Construcción Actual</td>
                        <td colspan="6" class="bold td_color">Valor Catastral Actual</td>
                    </tr>
                    <tr>
                        <td colspan="5">${{ number_format($valor_ta->VTERRPROP, 2) }}</td>
                        <td colspan="8">${{ number_format($construccion_t->VCT, 2) }}</td>
                        <td colspan="6">${{ number_format($valor_ca, 2) }}</td>
                    </tr>
                    <tr>
                        <th colspan="19" class="bold td_title_color">VALORES CATASTRALES ACTUALIZADOS</th>
                    </tr>
                    <tr>
                        <td colspan="1" class="bold td_color2">No.</td>
                        <td colspan="1" class="bold td_color2">Tipología</td>
                        <td colspan="2" class="bold td_color2" style="width: 20px !important">Superficie
                            <span><br></span>(ml, m2, m3)
                        </td>
                        <td colspan="1" class="bold td_color2">Niveles</td>
                        <td colspan="1" class="bold td_color2">Edad</td>
                        <td colspan="1" class="bold td_color2">G.C.</td>
                        <td colspan="3" class="bold td_color2">Factor<span><br></span>Aplicable</td>
                        <td colspan="4" class="bold td_color2">Ocupación Actual</td>
                        <td colspan="5" class="bold td_color2">Valores de Construcción</td>
                    </tr>
                    @php
                        $contador = 0; // Inicializar el contador
                    @endphp
                    @foreach ($actualizados as $dato)
                        <tr style="background-color: {{ $dato->color }}">
                            <td colspan="1">{{ $loop->iteration }}</td>
                            <td colspan="1">{{ $dato->tipologia }}</td>
                            <td colspan="2">{{ $dato->superficie }}</td>
                            <td colspan="1">{{ $dato->niveles }}</td>
                            <td colspan="1">{{ $dato->edad }}</td>
                            <td colspan="1">{{ $dato->gc }}</td>
                            <td colspan="3">{{ number_format($dato->factorA, 5) }}</td>
                            <td colspan="4" class="td_lp">{{ $dato->Ocupacion }}</td>
                            <td colspan="5">${{ number_format($dato->valorc, 2) }}</td>
                        </tr>
                        @php
                            $contador++; // Incrementar el contador en cada iteración
                        @endphp
                    @endforeach
                    @for ($i = $contador; $i < 10; $i++)
                        <tr>
                            <td colspan="1">{{ $contador += 1 }}</td>
                            <td colspan="1"></td>
                            <td colspan="2"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="3"></td>
                            <td colspan="4"></td>
                            <td colspan="5"></td>
                        </tr>
                    @endfor
                    <tr>
                        <td colspan="9" class="bold td_color2">Construcción Total (m2)</td>
                        <td colspan="10">{{ number_format($actalizado_construccion_t, 2) }}</td>

                    </tr>
                    <tr>
                        <td colspan="5" class="bold td_color">Valor de Terreno</td>
                        <td colspan="8" class="bold td_color">Valor de Construcción Actualizado</td>
                        <td colspan="6" class="bold td_color">Valor Catastral Actualizado</td>
                    </tr>
                    <tr>
                        <td colspan="5">${{ number_format($valor_ta->VTERRPROP, 2) }}</td>
                        <td colspan="8">${{ number_format($construccion_a, 2) }}</td>
                        <td colspan="6">${{ number_format($valor_ta->VTERRPROP + $construccion_a, 2) }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
        <!--salto de pagina-->
        <div class="saltopagina"></div>
        <!--segunda pàgina-->
        <div>
            <table>
                <tr>
                    <td class="bold td_color text_right">CLAVE CATASTRAL</td>
                    <td class="bold underline text_red">{{ $datos->clavec }}</td>
                </tr>
                <tr>
                    <td class="bold td_color">CROQUIS POSICIÓN MANZANA</td>
                    <td class="bold td_color">UBICACIÓN ESPECIFICA</td>
                </tr>
                <tr>
                    <td class="td_imagenes12"><img class="imagenes12"
                            src="{{ isset($fotos->urlFoto_1) ? $fotos->urlFoto_1 : $plantilla }}" alt="">
                    </td>

                    <td class="td_imagenes12"><img class="imagenes12"
                            src="{{ isset($fotos->urlFoto_2) ? $fotos->urlFoto_2 : $plantilla }}" alt="">
                    </td>

                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <th class="bold td_color">FOTOGRAFIAS EN SITIO DEL PREDIO</th>
                </tr>
            </table>
            <table class="border_s">
                <tr>
                    <td class="td_h"><img class="td_img"
                            src="{{ isset($fotos->urlFoto_3) ? $fotos->urlFoto_3 : $plantilla }}" alt="">
                    </td>

                    <td class="td_h"><img class="td_img"
                            src="{{ isset($fotos->urlFoto_4) ? $fotos->urlFoto_4 : $plantilla }}" alt="">
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <th class="bold td_color">FOTOGRAFIAS OBLICUAS DEL PREDIO</th>
                </tr>
            </table>
            <table class="border_s">
                <tr>
                    <td class="td_h"><img class="td_img"
                            src="{{ isset($fotos->urlFoto_5) ? $fotos->urlFoto_5 : $plantilla }}" alt="">
                    </td>

                    <td class="td_h"><img class="td_img"
                            src="{{ isset($fotos->urlFoto_6) ? $fotos->urlFoto_6 : $plantilla }}" alt="">
                    </td>

                </tr>
            </table>
            <br>

        </div>
        <!--salto de pagina-->
        <!--tercera pagina-->
        <div class="saltopagina"></div>
        <div>
            <table>
                <tr>
                    <td colspan="1" class="bold td_color">CLAVE CATASTRAL</td>
                    <td colspan="1" class="bold underline text_red">{{ $clavec }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="bold td_color">CROQUIS DE CONSTRUCCIÓN</td>
                </tr>
                <tr>
                    <td colspan="2"><img style="width: 730px; height: 800px;"
                            src="{{ isset($fotos->urlFoto_7) ? $fotos->urlFoto_7 : $plantilla }}" alt="">
                    </td>

                </tr>
            </table>
        </div>
        <br>
        <table class="firma">
            <tr>
                <td class="firma bold">Realizó</td>
                <td class="firma bold">Validó</td>
            </tr>
            <br><br>
            <tr>
                <td class="firma bold">________________________________________</td>
                <td class="firma bold">________________________________________</td>
            </tr>
        </table>
    </main>
</body>

</html>
