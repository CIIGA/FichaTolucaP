<?php

namespace App\Http\Controllers;

use App\Models\accessDoctos;
use App\Models\callesSeccionadas;
use App\Models\colorVCActuales;
use App\Models\FichaFactores;
use App\Models\FichaTipologias;
use App\Models\fichaToluca;
use App\Models\GC203T04;
use App\Models\GC203T05;
use App\Models\GC203T06;
use App\Models\imgFicha;
use App\Models\Ubicacion;
use App\Models\ValCatastralesActualizados;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use PDF;

class FichaController extends Controller
{
    public function index(Request $request)
    {


        $datos = GC203T05::join('GC203T04', 'GC203T05.CLAVE_CATA', '=', 'GC203T04.CLAVE_CATA')
            ->join('cat_regimen', 'GC203T04.REGPROP', '=', 'cat_regimen.regimen')
            ->join('cat_uso', 'GC203T05.DESTINO', '=', 'cat_uso.uso')
            ->select([
                'GC203T05.CLAVE_CATA', 'GC203T04.DOMICILIO', 'GC203T04.NUMEXT', 'GC203T05.NUMINTP', 
                DB::raw("convert(varchar,GC203T04.CODPOST) as CODPOST"),
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
        $ubicacion=Ubicacion::select(['DESCRIPCION'])->where('UBICACION',floor($tabla[0]->UBICACION))->first();
      
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
        cat_ocupaciones.CATEGCONST = GC203T06.CATEGCONST and GC203T06.CLAVE_CATA=? order by ANIODECONS asc', [$request->clave]);

       


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
            'ubicacion' => $ubicacion->DESCRIPCION
        ]);
    }
    public function store(Request $request)
    {
        $count = fichaToluca::where('clavec', $request->clavec)
            ->count();
        //si existe
        if ($count != 0) {
            //eliminamos el registro
            $deleted = fichaToluca::where('clavec', $request->clavec)->delete();
        }
        //declaramos un nuevo registro
        $registrar = new fichaToluca();
        $registrar->folio = $request->folio;
        $registrar->fecha = $request->fecha;
        $registrar->motivo = $request->motivo;
        $registrar->clavec = $request->clavec;
        $registrar->calle1 = $request->calle;
        $registrar->numext1 = $request->numext;
        $registrar->numint1 = $request->numint;
        $registrar->cp1 = $request->cp;
        $registrar->colonia1 = $request->colonia;
        $registrar->localidad = $request->localidad;
        $registrar->regimen = $request->regimen;
        $registrar->uso = $request->uso;
        $registrar->propietario = $request->propietario;
        $registrar->rfc = $request->rfc;
        $registrar->curp = $request->curp;
        $registrar->calle2 = $request->calle2;
        $registrar->numext2 = $request->numext2;
        $registrar->numint2 = $request->numint2;
        $registrar->telefono = $request->telefono;
        $registrar->municipio2 = $request->municipio2;
        $registrar->localidad2 = $request->localidad2;
        $registrar->cp2 = $request->cp2;
        $registrar->colonia2 = $request->colonia2;
        $registrar->bh = $request->bh;
        $registrar->ah = $request->ah;
        $registrar->color1 = $request->color1;
        $registrar->color2 = $request->color2;
        $registrar->color3 = $request->color3;
        $registrar->color4 = $request->color4;
        $registrar->color5 = $request->color5;
        $registrar->color6 = $request->color6;
        $registrar->color7 = $request->color7;
        $registrar->color8 = $request->color8;
        $registrar->color9 = $request->color9;
        $registrar->color10 = $request->color10;
        $registrar->color11 = $request->color11;
        $registrar->color12 = $request->color12;
        $registrar->color13 = $request->color13;
        $registrar->color14 = $request->color14;

        $registrar->save();

        //validamos si la tabla valores catastrales actuales ya tiene color
        $coun_vca = colorVCActuales::where('clavec', $request->clavec)
            ->count();
        if ($coun_vca != 0) {
            //eliminamos el registro
            $deleted_vca = colorVCActuales::where('clavec', $request->clavec)->delete();
        }
        for ($i = 1; $i <= $request->i; $i++) {
            $registrar_vca = new colorVCActuales();
            $dato = 'actualestr' . $i;
            $registrar_vca->numero = $i;
            $registrar_vca->clavec = $request->clavec;
            $registrar_vca->color = $request->$dato;
            $registrar_vca->save();
        }
        


            return '<script type="text/javascript">window.open("ficha/' . $request->clavec . '/' . $request->id_documento . '/' . $request->id_usuario . '")</script>' .
                redirect()->route('index', ['id_documento' => $request->id_documento]);
        
    }
    public function ficha($clavec, $id_documento, $id_usuario)
    {

        require public_path("php/cnx.php");
        //gatos nenerales
        $datos = fichaToluca::select([
            'folio',
            'fecha',
            'motivo',
            'clavec',
            'calle1',
            'numext1',
            'numint1',
            'cp1',
            'colonia1',
            'localidad',
            'regimen',
            'uso',
            'propietario',
            'rfc',
            'curp',
            'calle2',
            'numext2',
            'numint2',
            'telefono',
            'municipio2',
            'localidad2',
            'cp2',
            'bh',
            'ah',
            'color1',
            'color2',
            'color3',
            'color4',
            'color5',
            'color6',
            'color7',
            'color8',
            'color9',
            'color10',
            'color11',
            'color12',
            'color13',
            'color14',

        ])
            ->where('clavec', $clavec)->first();


            $valoresca = DB::select('select concat(GC203T06.USO,GC203T06.CLASECONST,GC203T06.CATEGCONST) AS TIPOLOGIA,
            GC203T06.SUPCONS,
            GC203T06.NIVCONS,
            GC203T06.ANIODECONS,
            GC203T06.ESTADOCONS,
            GC203T06.FACTORNIV,
            GC203T06.VALORCONS,
            cat_ocupaciones.DESCRCLCAT
            from cat_ocupaciones,GC203T06 where cat_ocupaciones.USO = GC203T06.USO and cat_ocupaciones.CLASECONST = GC203T06.CLASECONST and 
            cat_ocupaciones.CATEGCONST = GC203T06.CATEGCONST and GC203T06.CLAVE_CATA=? order by ANIODECONS asc', [$clavec]);
        $vcactuales_color = colorVCActuales::select([
            'numero',
            'color'
        ])
            ->where('clavec', $clavec)->orderby('numero')->get();
        //datos del terreno actuales
        $tabla1 = GC203T04::select([
            'SUPTERRTOT', 'FRENTE', 'NFRENTE', 'FONDO', 'NFFONDO', 'UBICACION',
            'NFUBIC', 'NFTOPOGR', 'NFIRREG', 'NFAREA', 'NFSUPAPR'
        ])
            ->where('GC203T04.CLAVE_CATA', $clavec)->first();
            $ubicacion=Ubicacion::select(['DESCRIPCION'])->where('UBICACION',floor($tabla1->UBICACION))->first();
        //factor aplicable
        $FA = $tabla1->NFRENTE * $tabla1->NFFONDO * $tabla1->NFUBIC * $tabla1->NFTOPOGR * $tabla1->NFIRREG * $tabla1->NFAREA * $tabla1->NFSUPAPR;
        //CONSTRUCCION TOTAL
        $construccion_t = GC203T06::select([
            DB::raw("sum(SUPCONS) AS CT"),
            DB::raw("sum(VALORCONS) AS VCT")
        ])
            ->where('CLAVE_CATA', $clavec)->first();
        //VALOR TERRENO ACTUAL
        $valor_ta = GC203T05::select([
            'VTERRPROP'
        ])
            ->where('CLAVE_CATA', $clavec)->first();
        //VALOR CATASTRAL ACTUAL
        $valor_ca = $valor_ta->VTERRPROP + $construccion_t->VCT;
        $i = 0;


        //consultar fotos
        $fotos = imgFicha::select([
            'urlFoto_1',
            'urlFoto_2',
            'urlFoto_3',
            'urlFoto_4',
            'urlFoto_5',
            'urlFoto_6',
            'urlFoto_7'
        ])
            ->where('cuentaPredial', $clavec)->first();
        //valores actualizados
        $actualizados = ValCatastralesActualizados::where('clave', $clavec)->orderby('id', 'ASC')->get();
        $actalizado_construccion_t = ValCatastralesActualizados::where('clave', $clavec)
            ->sum(DB::raw('CAST(superficie AS float)'));
       
        $construccion_a = ValCatastralesActualizados::where('clave', $clavec)
            ->sum(DB::raw('CAST(valorc AS float)'));

        $plantilla = 'C:/wamp64/www/cartomaps/erdmcarto/fichaCataTolucaP/FichaTolucaP/public/img/plantilla.png';
        $pdf = PDF::loadView('pdf.fichaToluca', [
            'vcactuales' => $valoresca, 'vcactuales_color' => $vcactuales_color, 'i' => $i, 'datos' => $datos, 'tabla1' => $tabla1, 'FA' => $FA,
            'construccion_t' => $construccion_t, 'valor_ta' => $valor_ta, 'valor_ca' => $valor_ca, 'fotos' => $fotos, 'clavec' => $clavec, 'plantilla' => $plantilla,
            'actualizados' => $actualizados,'actalizado_construccion_t' => $actalizado_construccion_t,'construccion_a' => $construccion_a,
            'ubicacion' => $ubicacion->DESCRIPCION
        ]);

        $sql_id_accessDoctos = "SELECT id_accessDoctos FROM accessDoctos     
        WHERE id_documento = '$id_documento' and id_usuarioNuevo='$id_usuario'";
        $cnx_sql = sqlsrv_query($cnx, $sql_id_accessDoctos);
        $id_accessDoctos = sqlsrv_fetch_array($cnx_sql);
        // dd($id_accessDoctos['id_accessDoctos'],date('d-m-Y'),date('h:i:s'),date('d'));
        $id_accessDoctos = $id_accessDoctos['id_accessDoctos'];
        $fecha = date('d-m-Y');
        $hora = date('h:i:s');
        $dia = date('d');
        $nombreFile = $clavec . ".pdf";
        $urlFile = "urlFile";
        //Donde guardar el documento
        $rutaGuardado = public_path("fichas\\" . $nombreFile);
        //validamos si ya tiene un pdf creado con esa cuenta
        $sql_count_nombreFile = "SELECT count(id_doctoCreado) as count FROM doctoCreado     
        WHERE nombreFile = '$nombreFile'";
        $cnx_count_nombreFile = sqlsrv_query($cnx, $sql_count_nombreFile);
        $count_nombreFile = sqlsrv_fetch_array($cnx_count_nombreFile);

        $pdf->render();
        //Guardalo en una variable
        $output = $pdf->output();

        try {


            // $signedUrl = 'https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/fichaCataTolucaP/FichaTolucaP/public/fichas/' . $nombreFile;
            $signedUrl = $rutaGuardado;


            if ($count_nombreFile['count'] != 0) {
                if (file_exists($rutaGuardado)) {
                    unlink($rutaGuardado);
                }
                file_put_contents($rutaGuardado, $output);
                $ficha = "update doctoCreado set fecha='$fecha',hora='$hora',dia=' $dia',urlFile='$signedUrl' where nombreFile = '$nombreFile'";
                //eliminar el documento en public

            } else {
                file_put_contents($rutaGuardado, $output);
                $ficha = "insert into doctoCreado (id_accessDoctos,fecha,hora,dia,nombreFile,urlFile) values ('$id_accessDoctos','$fecha',' $hora',' $dia','$nombreFile','$signedUrl')";
            }
            sqlsrv_query($cnx, $ficha);
            return $pdf->stream();
        } catch (Exception $e) {
            dd($e);
        }
    }



    public function viewFichasNow(Request $request)
    {
        require public_path("php/cnx.php");
        $fecha = date('d-m-Y');
        //consultamos las fichas creadas al dia de hoy poe el usuario 
        $sql_ficha = "SELECT count(id_doctoCreado) as count FROM doctoCreado, accessDoctos     
               WHERE doctoCreado.id_accessDoctos = accessDoctos.id_accessDoctos and doctoCreado.fecha='$fecha' and  accessDoctos.id_usuarioNuevo='$request->id_usuario'";
        $cnx_sql_ficha = sqlsrv_query($cnx, $sql_ficha);
        $ficha = sqlsrv_fetch_array($cnx_sql_ficha);
        // dd($ficha);
        if ($ficha['count'] == 0) {
            return back()->with('errorviewfichasnow', 'Para realizar un mandamiento de ejecucion predial se necesita realizar un requerimiento');
        } else {
            return view('components.viewFichas', ['id_usuario' => $request->id_usuario, 'contador' => 0]);
        }
    }
    public function viewFichasall($id_usuario)
    {

        $count_fichas = accessDoctos::on('sqlsrv2')->join('doctoCreado as dc', 'accessDoctos.id_accessDoctos', '=', 'dc.id_accessDoctos')

            ->where('accessDoctos.id_usuarioNuevo', $id_usuario)
            ->count();


        if ($count_fichas == 0) {
            return back()->with('errorviewfichasnow', 'Para realizar un mandamiento de ejecucion predial se necesita realizar un requerimiento');
        } else {
            $fichas = accessDoctos::on('sqlsrv2')->join('doctoCreado as dc', 'accessDoctos.id_accessDoctos', '=', 'dc.id_accessDoctos')
                ->select(['id_doctoCreado', 'nombreFile', 'urlFile', 'hora', 'fecha'])
                ->where('accessDoctos.id_usuarioNuevo', $id_usuario)
                ->paginate(18);
            // $this->resetPage();
            return view('components.viewFichasall', ['contador' => 0, 'fichas' => $fichas]);
        }
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
        $ocupacion = FichaTipologias::select(['DESCRCLCAT'])->where('TIPOL', $tipologia)->first();
        //consultamos el unitarioValor
        $UnitarioValor = FichaTipologias::select(['Valor2023'])->where('TIPOL', $tipologia)->first();
        $valorC = $superficie * $factorA * $UnitarioValor->Valor2023;

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
    public function edit_vca(Request $request)
    {
        $id = $request->get('id');
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
        $ocupacion = FichaTipologias::select(['DESCRCLCAT'])->where('TIPOL', $tipologia)->first();
        //consultamos el unitarioValor
        $UnitarioValor = FichaTipologias::select(['Valor2023'])->where('TIPOL', $tipologia)->first();
        $valorC = $superficie * $factorA * $UnitarioValor->Valor2023;

        $insert = ValCatastralesActualizados::findOrFail($id);
      
        $insert->tipologia = $tipologia;
        $insert->superficie = $superficie;
        $insert->niveles = $nivel;
        $insert->edad = $edad;
        $insert->gc = $gc;
        $insert->factorA = $factorA;
        $insert->Ocupacion = $ocupacion->DESCRCLCAT;
        $insert->valorc = $valorC;
        if($color !='0'){
            $insert->color = $color;
        }

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
        $datos = ValCatastralesActualizados::where('clave', $clave)->orderby('id', 'ASC')->get();
        $construccion_t = ValCatastralesActualizados::where('clave', $clave)
            ->sum(DB::raw('CAST(superficie AS float)'));
        $valor_terreno = GC203T05::select(['VTERRPROP as valor'])->where('CLAVE_CATA', $clave)->first();
        $construccion_a = ValCatastralesActualizados::where('clave', $clave)
            ->sum(DB::raw('CAST(valorc AS float)'));
        // // Renderiza la vista parcial de la tabla Blade con los datos
        $tablaHtml = View::make('components.tabla_vca', [
            'datos' => $datos, 'construccion_t' => $construccion_t, 'valor_terreno' => $valor_terreno->valor,
            'construccion_a' => $construccion_a
        ])->render();
        //retornamos la respuesta json
        return response()->json(['tabla' => $tablaHtml]);
    }
    public function modal_edit_vca($id){
        $item = ValCatastralesActualizados::findOrFail($id);
       
        $modal= View::make('components.modal_edit_vca', ['datos' => $item])->render();
        return response()->json(['modal' => $modal]);
    }
}
