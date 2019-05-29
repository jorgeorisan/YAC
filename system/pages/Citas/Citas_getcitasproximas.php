<h4><strong>Citas del dia <?php echo $fecha_inicial?></strong></h4>
<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
        <tr>
            <th class = "col-md-1" data-hide="phone,tablet"> No. Cita </th>
            <th class = "col-md-1" data-hide="phone,tablet"> Status</th>
            <th class = "col-md-1" data-hide="">Paciente</th>
            <th class = "col-md-1" data-class="expand"> Motivo</th>
            <th class = "col-md-1" data-hide=""> Medico</th>
            <th class = "col-md-1" data-hide="">Fecha Cita</th>
            <th class = "col-md-1" data-hide=""> Hora</th>
            <th class = "col-md-1" data-hide="phone,tablet">Usuario Alta</th>
            <th class = "col-md-1" data-hide="phone,tablet">Action</th>
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
            <td><?php echo htmlentities($row['id'])?></td>
            <td class='<?php echo $class; ?>'><?php echo $status; ?></td>
            <td><?php echo $nombrepaciente; ?></td>
            <td><?php echo htmlentities($row['motivo']).$seguimiento?></td>
            <td><?php echo $nombrepersonal; ?></td>
            <td><?php echo date('Y-m-d',strtotime($row['fecha_inicial']))?></td>
            <td><?php echo date('H:m',strtotime($row['fecha_inicial']))." / ". date('H:m',strtotime($row['fecha_final']))?></td>
            <td><?php echo $nombreuser; ?></td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        Accion <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="" href="<?php echo make_url("Historial","consulta",array('id'=>$row['id_paciente'],'id_cita'=>$row['id'])); ?>"><?php echo ($row['id_historialtratamiento']) ? 'Dar seguimiento':'Generar Consulta'; ?></a>
                        </li>
                        <li>
                            <a class="" href="<?php echo make_url("Citas","edit",array('id'=>$row['id'])); ?>">Editar</a>
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
    $(document).ready(function () {
       
        $('#dt_basic').dataTable({
            "aaSorting": [[ 6,"asc" ]]
        });
    });
   
</script>