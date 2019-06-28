<br>
<div class="widget-body" style=''>

    <h4><strong>Citas del dia <?php echo $fecha_inicial?></strong>
    <?php if($id_paciente) { ?>
            <a class="btn btn-success" style=" float: right;margin-right: 50px;" href="<?php echo make_url("Citas","add",array('id_paciente'=>$id_paciente))?>" >Nueva Cita</a>
    <?php } ?>
    </h4>			
</div>

<br>
<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
        <tr>
            <th class = "col-md-1" data-hide="">Fecha Cita</th>
            <th class = "col-md-1" data-hide="">Hora</th>
            <th class = "col-md-1" data-hide="">Paciente</th>
            <th class = "col-md-1" data-class="">Tratamiento</th>
            <th class = "col-md-1" data-hide="">Medico</th>
            <th class = "col-md-1" data-hide="">Status</th>
            <th class = "col-md-1" data-class="">Dar seguimiento a</th>
            <th class = "col-md-1" data-hide="">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($data as $row) {
        $pacientes = new Paciente();
        $paciente  = $pacientes->getTable($row['id_paciente']);
        $users     = new User();
        $user      = $users->getTable($row['id_user']);
        $personal  = new Personal();
        $persona   = $personal->getTable($row['id_personal']);
        $nombrepaciente  = htmlentities($paciente['nombre']." ".$paciente['apellido_pat']." ".$paciente['apellido_mat']." "); 
        $nombrepersonal  = htmlentities($persona['nombre']." ".$persona['apellido_pat']." ".$persona['apellido_mat']." ");
        $nombreuser      = htmlentities($user['nombre']." ".$user['apellido_pat']." ".$user['apellido_mat']." ");
        switch ($row['status']) {
            case 'active':	   $status = 'Pendiente';  $class = "bg-color-blue"; 	   $icon = "fa-clock-o"; break;
            case 'deleted':    $status = 'Cancelada';  $class = "bg-color-red";	       $icon = "fa-warning"; break;
            case 'Completada': $status = 'Completada'; $class = "bg-color-greenLight"; $icon = "fa-check";   break;
            default: 	       $status = 'N/A';		   $class = "";           	       $icon = "";           break;
        }
        $seguimiento = ($row['id_historialtratamiento']) ? "<br>(Seguimiento)": '';
        ?>
        <tr>
            
            <td><?php echo date('Y-m-d',strtotime($row['fecha_inicial']))?></td>
            <td><?php echo date('H:m',strtotime($row['fecha_inicial']))." / ". date('H:m',strtotime($row['fecha_final']))?></td>
            <td><?php echo $nombrepaciente; ?></td>
            <td><?php echo htmlentities($row['motivo']).$seguimiento?></td>
            <td><?php echo $nombrepersonal; ?></td>
            <td class=''><?php echo $status; ?></td>
            <td><?php
                    $u = new HistorialTratamiento();
                    if($list=$u->getAllArrPaciente($row['id_paciente'])){
                        if (is_array($list) || is_object($list)){
                            $select='
                                <select style="width:100%" class="select2"  required name="id_historialtratamiento" id="id_historialtratamiento'.$row['id'].'">
                                    <option value="">Selecciona Tratamiento a seguir</option>';
                                    foreach($list as $val){
                                        $select.= "<option value='".$val['id']."'>".htmlentities($val['tratamiento'])."</option>";
                                    }
                                $select.= '</select>';
                            echo $select;
                        }
                    }
                ?>
            </td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        Accion <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="" href="#" onclick="generarconsulta(<?php echo $row['id'];?>)"><?php echo ($row['id_historialtratamiento']) ? 'Dar seguimiento':'Generar Consulta'; ?></a>
                        </li>
                        <li>
                            <a class="" href="<?php echo make_url("Citas","add",array('id_cita'=>$row['id'])); ?>">Editar</a>
                        </li>
                        
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="red" onclick="borrar('<?php echo make_url("Citas","citadelete",array('id'=>$row['id'])); ?>',<?php echo $row['id']; ?>);">Eliminar</a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    <?php 
    } ?>
    </tbody>
</table>

<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

<script>
    $('#dt_basiccitas').dataTable({
            "aaSorting": [[ 0,"asc" ]]
        });
        generarconsulta= function(id){
            swal({
                title: "Estas seguro?",
                text: "Deseas generar una nueva consulta?",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: '#555FDD',
                confirmButtonText: 'Si, Generar!',
                closeOnConfirm: true
                },
                function(){
                    var id_histt = $("#id_historialtratamiento"+id).val();
                    var id_cita  = id;
                    var url = config.base+"/Citas/ajax/?action=get&object=geturldate"; // El script a dónde se realizará la petición.
                    var id_historialtratamiento=(id_histt>0) ? '&id_historialtratamiento='+id_histt : '';
                    
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: "id_cita="+id_cita+id_historialtratamiento, 
                        success: function(response){
                            if(response){
                                window.location.replace(response);
                            }else{
                                swal("Oopss error al generar consulta"+response);
                            }
                        }
                    });
                }
            );
        
            return false; // Evitar ejecutar el submit del formulario.
        }
   
</script>