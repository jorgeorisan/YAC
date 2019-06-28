
<section id="widget-grid" class="">
    <form id="main-form" class="form-pagos" role="form" method=post action="#" onsubmit="return checkSubmit();" >
        <input type="hidden" name="id_venta" value="<?php echo $datah['id_venta']?>" >
        <input type="hidden" name="total" value="<?php echo $total?>" >
        <div class="col-sm-12 col-md-12 col-lg-12" >
            <div class="text-center"><h4><strong>Datos Pago</strong></h4></div>
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th>Tipo Pago</th>
                    <td> 
                        <select style="width:100%" class="select2 " name="tipo_pago"  id="tipo_pago">
                            <?php 
                            $listref= getTipoPago();
                            if (is_array($listref)){
                                foreach($listref as $key => $valref){
                                    echo "<option value='".$key."'>".htmlentities($valref)."</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <th>Pago/Abono</th>
                    <td><input type="number" id="montoabono" class="form-control" name="montoabono" placeholder="Monto"/></td>
                </tr>
                <tr>
                    <th>Comentarios</th>
                    <td><input type="text" class="form-control" id="comentarios" name="comentarios"  placeholder="Comentarios"/></td>
                </tr>
                <tr>
                    <th>Fecha Pago</th>
                    <td ><input type="text" class="form-control datepicker" data-dateformat='yy-mm-dd' autocomplete="off" name="fecha_abono" id="" value='<?php echo date('Y-m-d')?>'/></td>
                </tr>
            </table>
        </div>
        <div class="form-actions" style="text-align: center;width: 100%;margin-left: 0px;">
            <div class="row">
               <div class="col-md-12">
                    <button class="btn btn-default btn-md" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        Cancelar
                    </button>
                    <button class="btn btn-primary btn-md" type="button" id="savenewpago">
                        <i class="fa fa-save"></i>
                        Guardar
                    </button>
                </div>
            </div>
        </div>                              
    </form>        
</section>
<script>
    $(".select2").select2({
        multiple: false,
        header: "Selecciona una opcion",
        noneSelectedText: "Seleccionar",
        selectedList: 1
    });
</script>
