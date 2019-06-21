<section id="widget-grid" class="">
    <?php if($statuscita!='active'){ ?>
        <h6 class="alert alert-warning semi-bold">
            <i class="fa fa-times"></i> Esta cita no se puede editar por que ya esta  <strong><?php echo $statuscita; ?></strong>.
        </h6>
    <?php } ?>
    <form id="main-form" class="form-citas" role="form" method='post' action="#" onsubmit="return checkSubmit();">    
        <input type="hidden" value="<?php echo $id_cita?>" name="id_cita">
        <input type="hidden" name="fecha_inicial"  required id="fecha_inicial" value="<?php echo $fecha_inicial;?>" />
        <input type="hidden" name="fecha_final"    required id="fecha_final"   value="<?php echo date('Y-m-d H:i',$fecha_final);?>" />
        
        <fieldset>    
        <section id="widget-grid" class="">
            <article class="col-sm-12 col-md-12 col-lg-12"  id="article-1">
                <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-recepcion" 
                data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                    <header onclick="$('.showrecepcion').toggle()"> <span class="widget-icon"> 
                        <i class="far fa-calendar"></i> </span><h2><?php echo $title?></h2>
                    </header>
                    <div class="showrecepcion" style="display: ;">
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox" style=""></div>
                        <div class="widget-body">
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label for="name">Fecha Cita </label>
                                        <input class="form-control datepicker" size="16"  id="fecha" type="text" data-dateformat='yy-mm-dd' value="<?php echo date('Y-m-d',strtotime ( $fecha_inicial ) ) ;?>" readonly>
                                    </div> 
                                    <div class="form-group row">
                                        <div class="col-sm-10 col-xs-10 row">
                                            <select style="width:100%" class="select2"  required name="id_persona" id="id_persona">
                                                <option value="" selected disabled>Selecciona </option>
                                                <?php 
                                                $obj = new Persona();
                                                $arrayfilters['tipo'] = '11';
                                                $list = $obj->getAllArr($arrayfilters);
                                                $persona=$obj->getTable($id_persona);
                                                if (is_array($list) || is_object($list)){
                                                    foreach($list as $val){
                                                        $selected = ($id_persona == $val['id_persona']) ? "selected" : "";
                                                        echo "<option $selected value='".$val['id_persona']."'>".htmlentities($val['nombre'].' '.$val['ap_paterno']." ".$val['ap_materno'])."</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2 col-xs-2 ">
                                            <a data-toggle="modal" class="btn btn-success" href="#myModalSecond" onclick="showpopupclientes()" > <i class="fa fa-plus"></i></a>                                          
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <select style="width:100%" class="select2"  required name="id_usuario" id="id_usuario">
                                            <option value="" selected disabled>Selecciona Usuario</option>
                                            <?php 
                                            $obj = new Usuario();
                                            $arrayfiltersUser['id_tienda'] = false;
                                            $arrayfiltersUser['tipo'] = "5,6,9";
                                            $list=$obj->getAllArr($arrayfiltersUser); // medicos
                                            if (is_array($list) || is_object($list)){
                                                foreach($list as $val){
                                                    $selected = ($id_user == $val['id']) ? "selected" : "";
                                                    echo "<option $selected value='".$val['id']."'>".htmlentities($val['nombre'])."</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group ">
                                        <label for="name"><i class="fal fa-info-circle" title="Selecciona las horas para la cita"></i>&nbsp; Hora </label>
                                        <div class="input-group row ">
                                            <div class="col-md-4 ">
                                                <div class="allowed-time">
                                                    <input class="form-control hora" style="width: 130px;"  type="time"  name="hora_inicial" id="hora_inicial" value="<?php echo $hora_inicial?>">
                                                
                                                </div>
                                            </div>
                                            <label class="col-md-2 col-sm-1" style="texl-align:center">a</label>
                                            <div class="col-md-4">
                                                <div class="allowed-time">
                                                    <input class="form-control hora" style="width: 130px;" type="time"  name="hora_fin" id="hora_fin" value="<?php echo $hora_final?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group ">
                                        <input type="text" class="form-control" required  placeholder="Motivo" name="motivo" id="motivo" value="<?php echo $motivo;?>" >
                                    </div>
                                    
                                </div>
                                <div class="col-sm-4" id="contcliente">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article> 
        </section>        
        </fieldset> 
        <div class="form-actions" style="text-align: center;width: 100%;margin-left: 0px;">
        <?php echo ($persona['status']=='BAJA') ? 'Cliente eliminado' : ''; ?>
        <?php if($statuscita=='active'){ ?>
            <div class="row">
               <div class="col-md-12">
                    <?php if($id_cita && $persona['status']!='BAJA'){ ?>
                        <button class="btn btn-danger btn-md" type="button" id="deletecita">
                            <i class="fa fa-trash"></i>
                            Eliminar Cita
                        </button>
                        <button class="btn btn-success btn-md" type="button" id="generarconsulta">
                            <i class="fa fa-file"></i>
                            Generar Consulta
                        </button>
                    <?php } ?>
                    <button class="btn btn-default btn-md" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        Cancelar
                    </button>
                    <button class="btn btn-primary btn-md" type="button" id="savenewcita">
                        <i class="fa fa-save"></i>
                        Guardar
                    </button>
                </div>
            </div>
            <?php }else{ ?>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-md" type="button" id="deletecita">
                            <i class="fa fa-save"></i>
                            Eliminar Cita
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>                       
    </form>               
</section>

<!-- /.modal -->

<script>
   $(document).ready(function() {
        //datetime
        $('.datepicker').datepicker({
            dateFormat: "yy-mm-dd",
        });
        $('.select2').select2();
       
        /*GENERALES*/
       

    })
    

</script>