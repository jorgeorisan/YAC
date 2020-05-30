<?php 
   			
    $lineId   = rand(1000, 100000);
    $detalles = ( isset($_GET["title"]) ) ? htmlentities( $_GET["title"] ) : '';
   
  
?>   
        <tr class='tratamiento' lineidtratamiento='<?php echo $lineId ?>'>
            <td>
                <input type='number' class="form-control" name='cantidad[]' value="1">
            </td>
            <td> 
                <select style="width:100%" class="select2 id_tratamiento" name="id_tratamiento[]">
                    <option value="">--Selecciona--</option>
                    <?php 
                        $obj = new Tratamiento();
                        $list=$obj->getAllArr();
                        if (is_array($list) || is_object($list)){
                            foreach($list as $val)
                                echo "<option value='".$val['id']."'>".$val['nombre']."</option>";
                        }
                    ?>
                </select>
            </td>
            <td>
                <textarea type='text' style='width: 100%;height: 100px;' placeholder="Detalles"  name='detalles_tratamiento[]' ><?php echo $detalles; ?> </textarea>
            </td>
            <td>
                <select style="width:100%" class="select2" name="prioridad[]" id='prioridad<?php echo $lineId ?>'>
                    <option value="Normal" title="Normal">N</option>
                    <option value="Alta"   title="Alta">A</option>
                    <option value="Baja"   title="Baja">B</option>
                </select>
            </td>
            <td><input type="text" class="form-control form_datetime" data-dateformat='yy-mm-dd' autocomplete="off" placeholder="Fecha Recomendada[]" name="fecha_recomendada" id="fecha_recomendada<?php echo $lineId ?>" ></td>
            <td><input type='text'  class='form-control costotratamiento' name='precio_tratamiento[]' id="precio_tratamiento<?php echo $lineId ?>" value='<?php echo 0 ?>' placeholder='00.00'></td>
            <td><input type='text'  class='form-control totaltratamiento' name='total_tratamiento[]' id="total_tratamiento<?php echo $lineId ?>" value='<?php echo 0 ?>' placeholder='00.00'></td>
            
            <td class='borrar-td'>
                <a href='javascript:void(0);' class='btn btn-danger borrar-tratamiento' lineidtratamiento='<?php echo $lineId ?>'> 
                    <i class='glyphicon glyphicon-trash'></i> </a>
            </td>
        </tr>
             

<script>
   function getpreciotratamiento(id){
        if ( ! id ) return;

        $.get(config.base+"/Vehiculos/ajax/?action=get&object=getsubmarcapopup&id=" + id, null, function (response) {
                if ( response ){
                    $("#contsubmarca_tratamiento").html(response);
                    $('#id_marca_tratamiento').select2();
                   
                }else{
                    notify('error', 'Error al obtener los datos del paciente');
                    return false;
                }     
        });
    }
    $(document).ready(function() { 
         $('body').on('change', '.id_tratamiento', function(){
            if( $(this).val() ){
                var id = $(this).val();
                //getpreciotratamiento(id);
            }
        });
        $('.form_datetime').datetimepicker({
            format: "yyyy-mm-dd hh:ii",
            language:  'es',
            weekStart: 0,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 0,
            minuteStep :30
        });
        $(".select2").select2({
            multiple: false,
            header: "Selecciona una opcion",
            noneSelectedText: "Seleccionar",
            selectedList: 1
        });
    });
</script>