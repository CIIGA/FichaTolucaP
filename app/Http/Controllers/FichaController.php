<?php

namespace App\Http\Controllers;

use App\Models\callesSeccionadas;
use App\Models\FichaFactores;
use App\Models\FichaTipologias;
use App\Models\GC203T04;
use App\Models\GC203T05;
use App\Models\GC203T06;
use App\Models\ValCatastralesActualizados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class FichaController extends Controller
{
    public function index(Request $request)
    {


        $datos = GC203T05::join('GC203T04', 'GC203T05.CLAVE_CATA', '=', 'GC203T04.CLAVE_CATA')
            ->join('cat_regimen', 'GC203T04.REGPROP', '=', 'cat_regimen.regimen')
            ->join('cat_uso', 'GC203T05.DESTINO', '=', 'cat_uso.uso')
            ->select([
                'GC203T05.CLAVE_CATA', 'GC203T04.DOMICILIO', 'GC203T04.NUMEXT', 'GC203T05.NUMINTP', 'GC203T04.CODPOST',
                'GC203T04.COLONIA', 'cat_regimen.descripcion as REGPROP', 'cat_uso.descripcion as USO',
                'GC203T05.PMNPROP', 'GC203T05.RFC', 'GC203T05.CURP', 'GC203T05.CLAVE_CATA'
            ])
            ->where('GC203T05.CLAVE_CATA', $request->clave)->first();
        //obtenemos los datos de la tabla callesseccionadas$
        $seccionadas = callesSeccionadas::select([
            'Calle', 'direccion3'
        ])
            ->where('ClaveCatastral', $request->clave)
            ->first();
        $tabla = GC203T04::select([
            'SUPTERRTOT', 'FRENTE', 'NFRENTE', 'FONDO', 'NFFONDO', 'UBICACION',
            'NFUBIC', 'NFTOPOGR', 'NFIRREG', 'NFAREA', 'NFSUPAPR'
        ])
            ->where('GC203T04.CLAVE_CATA', $request->clave)->get();
        //guardaremos 
        $valoresca = DB::select('select concat(GC203T06.USO,GC203T06.CLASECONST,GC203T06.CATEGCONST) AS TIPOLOGIA,
        GC203T06.SUPCONS,
        GC203T06.NIVCONS,
        GC203T06.ANIODECONS,
        GC203T06.ESTADOCONS,
        GC203T06.FACTORNIV,
        GC203T06.VALORCONS,
        cat_ocupaciones.DESCRCLCAT
        from cat_ocupaciones,GC203T06 where cat_ocupaciones.USO = GC203T06.USO and cat_ocupaciones.CLASECONST = GC203T06.CLASECONST and 
        cat_ocupaciones.CATEGCONST = GC203T06.CATEGCONST and GC203T06.CLAVE_CATA=?', [$request->clave]);


        //CONSTRUCCION TOTAL
        $construccion_t = GC203T06::select([
            DB::raw("sum(SUPCONS) AS CT"),
            DB::raw("sum(VALORCONS) AS VCT")
        ])
            ->where('CLAVE_CATA', $request->clave)->first();
        //VALOR TERRENO ACTUAL
        $valor_ta = GC203T05::select([
            'VTERRPROP'
        ])
            ->where('CLAVE_CATA', $request->clave)->first();
        //VALOR CATASTRAL ACTUAL
        $valor_ca = $valor_ta->VTERRPROP + $construccion_t->VCT;
        $i = 0;
        $FA = $tabla[0]->NFRENTE * $tabla[0]->NFFONDO * $tabla[0]->NFUBIC * $tabla[0]->NFTOPOGR * $tabla[0]->NFIRREG * $tabla[0]->NFAREA * $tabla[0]->NFSUPAPR;
        $tipologias = FichaTipologias::select(['TIPOL'])->get();
        $niveles = FichaFactores::select(['NIVEL'])->get();
        $GC = DB::select("select GC as gc from [FichaFactores] where GC not in ('')");



        return view('components.formCataToluca', [
            'seccionadas' => $seccionadas, 'item' => $datos, 'tabla' => $tabla, 'FA' => $FA,
            'valoresca' => $valoresca, 'i' => $i, 'construccion_t' => $construccion_t, 'valor_ta' => $valor_ta, 'valor_ca' => $valor_ca,
            'id_documento' => $request->id_documento, 'id_usuario' => $request->id_usuario,
            'tipologias' => $tipologias, 'niveles' => $niveles, 'GC' => $GC,
        ]);
    }
    public function store(Request $request)
    {
        dd($request);
    }
    public function add_vca(Request $request)
    {
        $clave = $request->get('clave');
        $tipologia = $request->get('tipologia');
        $superficie = $request->get('superficie');
        $nivel = $request->get('nivel');
        $edad = $request->get('edad');
        $gc = $request->get('gc');
        $color = $request->get('color');
        //obtenemos el factor aplicable
        // obtenemos el factor1
        $factor1 = FichaFactores::select(['FACTOR1'])->where('NIVEL', $nivel)->first();
        //obtener el factor 2
        // año actual
        $anioActual = now()->year;
        $anio = $anioActual - $edad;
        //buscamos el coeficiente dependiendo la tipologia
        $coeficiente = FichaTipologias::select(['CoeficienteDemeritoAnual as coeficiente'])->where('TIPOL', $tipologia)->first();
        $factor2 = 1 - ($anio * $coeficiente->coeficiente);
        //factor 3 buscar factor dependiendo el gc
        $factor3 = FichaFactores::select(['FACTOR2'])->where('GC', $gc)->first();
        $factorA = $factor1->FACTOR1 * $factor2 * $factor3->FACTOR2;
        //obtenemos ela ocupacion

        //obtenemos el valor de construccion
        $ocupacion=FichaTipologias::select(['DESCRCLCAT'])->where('TIPOL', $tipologia)->first();
        //consultamos el unitarioValor
        $UnitarioValor=FichaTipologias::select(['Valor2023'])->where('TIPOL', $tipologia)->first();
        $valorC=$superficie * $factorA * $UnitarioValor->Valor2023;

        $insert = new ValCatastralesActualizados();
        $insert->clave = $clave;
        $insert->tipologia = $tipologia;
        $insert->superficie = $superficie;
        $insert->niveles = $nivel;
        $insert->edad = $edad;
        $insert->gc = $gc;
        $insert->factorA = $factorA;
        $insert->Ocupacion = $ocupacion->DESCRCLCAT;
        $insert->valorc = $valorC;
        $insert->color = $color;

        if ($insert->save()) {
            return $this->tabla_vca($clave);
        } else {
            return response()->json(['success' => false]);
        }
    }


    public function delete_id_vca(Request $request)
    {
        $registro = ValCatastralesActualizados::findOrFail($request->get('id')); // Buscar el registro por ID

        // Realizar las operaciones necesarias antes de eliminar, si las hay

        $registro->delete(); // Eliminar el registro

        return $this->tabla_vca($request->get('clave'));
    }

    public function tabla_vca($clave)
    {
        $datos = ValCatastralesActualizados::where('clave', $clave)->orderby('id', 'DESC')->get();
        // // Renderiza la vista parcial de la tabla Blade con los datos
        $tablaHtml = View::make('components.tabla_vca', compact('datos'))->render();
        //retornamos la respuesta json
        return response()->json(['tabla' => $tablaHtml]);
    }
}
