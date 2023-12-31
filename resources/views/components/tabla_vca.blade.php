<!-- Los datos de la tabla se cargarán aquí -->
@foreach ($datos as $dato)
<tr >
    <td colspan="1" class="border" style="text-align:center;">{{$loop->iteration}}</td>
    <td colspan="1" class="border" style="text-align:center;">{{$dato->tipologia}}</td>
    <td colspan="1" class="border" style="text-align:center;">{{$dato->superficie}}</td>
    <td colspan="1" class="border" style="text-align:center;">{{$dato->niveles}}</td>
    <td colspan="1" class="border" style="text-align:center;">{{$dato->edad}}</td>
    <td colspan="1" class="border" style="text-align:center;">{{$dato->gc}}</td>
    <td colspan="1" class="border" style="text-align:center;">{{number_format($dato->factorA,5)}}</td>
    <td colspan="1" class="border" style="text-align:center;">{{$dato->Ocupacion}}</td>
    <td colspan="1" class="border" style="text-align:center;">${{number_format($dato->valorc,2)}}</td>
    <td colspan="1" class="border" style="text-align:center; background-color: {{$dato->color}} !important"></td>
    <td colspan="1" class=" border" style="text-align:center;">
        <button type="button" id="btn_edit_vca" class="btn btn-info" style="width: max-content;" 
        data-bs-toggle="modal"
        data-id="{{ $dato->id }}"
        data-tipologia="{{ $dato->tipologia }}"
        data-superficie="{{ $dato->superficie }}"
        data-nivel="{{ $dato->niveles }}"
        data-edad="{{ $dato->edad }}"
        data-gc="{{ $dato->gc }}"
        data-color="{{ $dato->color }}"
        data-clave="{{ $dato->clave }}"
        data-bs-target="#modal_edit_vca"> <i class="fa-regular fa-pen-to-square"></i> Editar</button>
    </td>
    <td colspan="1" class=" border" style="text-align:center;">
        <button type="button" id="delete_id_vca" class="btn btn-danger" style="width: max-content;" data-id="{{ $dato->id }}" data-clave="{{ $dato->clave }}"> <i class="fas fa-trash"></i> Eliminar</button>
    </td>
</tr>
@endforeach
<tr>
    <td colspan="6" class="table-light border" style="text-align:center;">Construcción Total (m2)</td>
    <td colspan="6" class="table-light border" style="text-align:center;">{{number_format($construccion_t,2)}}</td>
</tr>
<tr>
    <td colspan="4" class="table-light border" style="text-align:center;">Valor de Terreno</td>
    <td colspan="4" class="table-light border" style="text-align:center;">Valor de Construcción Actualizado</td>
    <td colspan="4" class="table-light border" style="text-align:center;">Valor Catastral Actualizado</td>
</tr>
<tr>
    <td colspan="4" class="table-light border" style="text-align:center;">${{number_format($valor_terreno,2)}}</td>
    <td colspan="4" class="table-light border" style="text-align:center;">${{number_format($construccion_a,2)}}</td>
    <td colspan="4" class="table-light border" style="text-align:center;">${{number_format(($valor_terreno + $construccion_a),2)}}</td>
</tr>

