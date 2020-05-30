<form id="buscar-producto-form">
    <table class="table table-striped table-bordered table-hover" width="50%">
        <tr>
            <th>Buscar por: <th>
            <td>
                <input type="text"  class="form-control" name="texto" id="texto" />
                <input type="hidden" name="id_tiendaselected" id="id_tiendaselected" value="<?php echo $idtienda ?>"/>
            </td>
            <td> 
                <button class="btn btn-primary btn-md buttsub" style="width: 100%" type="submit" class="button" id="buttsub" value="Buscar">
                    <i class="fa fa-search"></i>
                </button>
            </td>
        </tr>   
    </table>
</form>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="table-resultados" style="overflow:auto; padding:30px"></div>
</div>
<script type="text/javascript">

    $(document).ready(function () {

        $("#buscar-producto-form").submit(function (e) {
            e.preventDefault();

            $.get(config.base+"/Productos/ajax/buscarproducto", $(this).serialize()+"&action=get&object=buscarproducto", function (response) {
                $("#table-resultados").html(response);
            });
        });
        $("#texto").on('keypress', function () {
            var texto = $(this).val();
            if(texto.length>1)
                document.getElementById('buttsub').click();
        });
        
        $("[barcode]").click(function (e) {
            $("#barcode").val($(this).attr("barcode")).focus();
            $('#myModal').modal('hide');
        });
    });
</script>