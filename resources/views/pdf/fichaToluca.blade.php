<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ficha Toluca</title>
    <!-- <link type="text/css" href="C:/wamp64/www/ficha_toluca/css/pdf.css" rel="stylesheet"> -->
    <style type="text/css" media="screen">
        @page {
            margin-top: 70px;
            margin-left: 25px;
            margin-right: 25px;
            margin-bottom: 50px;
        }

        body {
            font-family: sans-serif;
        }

        table,
        th,
        td {
            border: 2px solid #030303;
            border-collapse: collapse;
        }

        table {
            width: 100%;
        }

        th {
            font-weight: normal;
            font-size: 12px;
        }

        td {
            text-align: center;
            min-width: 10px !important;
            font-size: 10px;
        }

        .bold {
            font-size: 10px;
            font-weight: bold !important;
        }

        .td_title_color {
            background-color: #999797;
        }

        .td_color {
            background-color: #DAD7D7;
        }

        .td_color2 {
            background-color: #CCCCCC;
        }

        .td_lp {
            font-size: 9px !important;
        }

        .border_s {
            border-collapse: separate !important;
            border-spacing: 50px 20px !important;
            border: none;
        }

        .td_h {
            height: 200px;
            width: 100px;
            max-width: 100px;
            max-height: 200px;
        }

        .firma {
            border: none;
        }

        .td_croquis {
            height: 750px;
        }

        .span_borde {
            border: 2px solid #030303;
            text-align: center;
            min-width: 100%;

        }

        .span_whith {
            min-width: 49.73%;
            display: block;
            float: left;
            border: 2px solid #030303;
        }

        .p_height {
            min-height: 600px;

        }

        .saltopagina {
            page-break-after: always;
        }

        .td_img {
            width: 280px;
            height: 200px;
        }

        .td_imagenes12 {
            height: 250px;
            width: 180px;
            max-width: 180px;
            max-height: 250px;
        }

        .imagenes12 {
            width: 360px;
            height: 260px;
        }

        .text_red {
            color: red;
        }

        .underline {
            text-decoration: underline;
        }
    </style>
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
                        <th colspan="19" class="bold td_title_color">DATOS DEL PROPIETARIO O POSEEDOR</th>
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
                        <td colspan="1"style="background-color: {{ $datos->color14 }}">{{ $datos->bh }}</td>
                        <td colspan="1" class="bold td_color">A.H.</td>
                        <td colspan="2"style="background-color: {{ $datos->color13 }}">{{ $datos->ah }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="background-color: {{ $datos->color1 }}">
                            {{ number_format($tabla1->SUPTERRTOT, 2) }}</td>
                        <td colspan="1"style="background-color: {{ $datos->color2 }}">
                            {{ number_format($tabla1->FRENTE, 2) }}</td>
                        <td colspan="1"style="background-color: {{ $datos->color3 }}">
                            {{ number_format($tabla1->NFRENTE, 5) }}</td>
                        <td colspan="1"style="background-color: {{ $datos->color4 }}">
                            {{ number_format($tabla1->FONDO, 2) }}</td>
                        <td colspan="1"style="background-color: {{ $datos->color5 }}">
                            {{ number_format($tabla1->NFFONDO, 5) }}</td>
                        <td colspan="1"style="background-color: {{ $datos->color6 }}">
                            {{ number_format($tabla1->UBICACION, 0) }}</td>
                        <td colspan="2"style="background-color: {{ $datos->color7 }}">
                            {{ number_format($tabla1->NFUBIC, 5) }}</td>
                        <td colspan="1"style="background-color: {{ $datos->color8 }}">
                            {{ number_format($tabla1->NFTOPOGR, 5) }}</td>
                        <td colspan="1"style="background-color: {{ $datos->color9 }}">
                            {{ number_format($tabla1->NFIRREG, 5) }}</td>




                    </tr>
                    <tr>
                        <th colspan="19" class="bold td_title_color">DATOS DEL TERRENO ACTUALIZADO</th>
                    </tr>
                    <tr>
                        <td colspan="2" class="bold td_color">Sup. Terreno (m2)</td>
                        <td colspan="2" class="bold td_color">Frente</td>
                        <td colspan="2" class="bold td_color">Fondo</td>
                        <td colspan="3" class="bold td_color">Posicion</td>
                        <td colspan="1" class="bold td_color">Topografía</td>
                        <td colspan="1" class="bold td_color">Irreg.</td>
                        <td colspan="1" class="bold td_color td_lp">Área Insc.</td>
                        <td colspan="2" class="bold td_color">Sup. Aprov.</td>
                        <td colspan="3" class="bold td_color ">Factor Aplicable</td>
                        <td colspan="1" class="bold td_color">B.V.</td>
                        <td colspan="1" class="bold td_color">A.H.</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="background-color: {{ $datos->mcolor1 }}">
                            {{ number_format($datos->supterreno, 2) }}</td>
                        <td colspan="1" style="background-color: {{ $datos->mcolor2 }}">
                            {{ number_format($datos->frente1, 2) }}</td>
                        <td colspan="1" style="background-color: {{ $datos->mcolor3 }}">
                            {{ number_format($datos->frente2, 5) }}</td>
                        <td colspan="1" style="background-color: {{ $datos->mcolor4 }}">
                            {{ number_format($datos->fondo1, 2) }}</td>
                        <td colspan="1" style="background-color: {{ $datos->mcolor5 }}">
                            {{ number_format($datos->fondo2, 5) }}</td>
                        <td colspan="1" style="background-color: {{ $datos->mcolor6 }}">
                            {{ number_format($datos->posicion1, 0) }}</td>
                        <td colspan="2" style="background-color: {{ $datos->mcolor7 }}">
                            {{ number_format($datos->posicion2, 5) }}</td>
                        <td colspan="1" style="background-color: {{ $datos->mcolor8 }}">
                            {{ number_format($datos->topografia, 5) }}</td>
                        <td colspan="1" style="background-color: {{ $datos->mcolor9 }}">
                            {{ number_format($datos->irreg, 5) }}</td>
                        <td colspan="1" style="background-color: {{ $datos->mcolor10 }}">
                            {{ number_format($datos->area, 5) }}</td>
                        <td colspan="2" style="background-color: {{ $datos->mcolor11 }}">
                            {{ number_format($datos->supaprov, 5) }}</td>
                        <td colspan="3" style="background-color: {{ $datos->mcolor12 }}">
                            {{ number_format($datos->factoraplicable, 5) }}</td>
                        <td colspan="1" style="background-color: {{ $datos->mcolor13 }}">{{ $datos->bh2 }}</td>
                        <td colspan="1" style="background-color: {{ $datos->mcolor14 }}">{{ $datos->ah2 }}</td>
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
                    <td class="bold td_title_color">CROQUIS POSICIÓN MANZANA</td>
                    <td class="bold td_title_color">UBICACIÓN ESPECIFICA</td>
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
                    <th class="bold td_title_color">FOTOS FRENTE DEL PREDIO</th>
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
            <table class="firma">
                <tr>
                    <td class="firma bold">Realizó</td>
                    <td class="firma bold">Válido</td>
                </tr>
                <br><br>
                <tr>
                    <td class="firma bold">________________________________________</td>
                    <td class="firma bold">________________________________________</td>
                </tr>
            </table>
        </div>
        <!--salto de pagina-->
        <!--tercera pagina-->
        <div class="saltopagina"></div>
        <div>
            <table>
                <tr>
                    <th colspan="2" class="bold td_title_color">CROQUIS DE CONSTRUCCIÓN</th>
                </tr>
                <tr>
                    <td colspan="1">CLAVE CATASTRAL</td>

                    <td colspan="1">{{ $clavec }}</td>


                </tr>
                <tr>
                    <td colspan="2"><img style="width: 730px; height: 800px;"
                            src="{{ isset($fotos->urlFoto_7) ? $fotos->urlFoto_7 : $plantilla }}" alt="">
                    </td>

                </tr>
            </table>
        </div>
    </main>
</body>

</html>
