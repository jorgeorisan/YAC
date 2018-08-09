drop table detalle_ventascorte;
create view detalle_ventascorte as
 SELECT 
        (`vc`.`id` = 0) AS `id`,
        `vc`.`id_venta` AS `id_venta`,
        `pv`.`cantidad` AS `cantidad`,
        `p`.`codinter` AS `codinter`,
        `p`.`nombre` AS `nombre`,
        `p`.`exento_iva` AS `exento_iva`,
        `p`.`exento_ieps` AS `exento_ieps`,
        `vc`.`fecha` AS `fecha`,
        `pv`.`total` AS `total`,
        `vc`.`tipo` AS `tipo`,
        `vc`.`id_usuario` AS `id_usuario`,
        `vc`.`id_tienda` AS `id_tienda`
    FROM
        ((((`ventascorte` `vc`
        LEFT JOIN `venta` `v` ON ((`vc`.`id_venta` = `v`.`id_venta`)))
        LEFT JOIN `productos_venta` `pv` ON ((`vc`.`id_venta` = `pv`.`id_venta`)))
        LEFT JOIN `producto_tienda` `pt` ON ((`pt`.`id_productotienda` = `pv`.`id_productotienda`)))
        LEFT JOIN `producto` `p` ON ((`pt`.`id_producto` = `p`.`id_producto`)))
    WHERE
        ((`pv`.`cancelado` = 0)
            AND (`vc`.`abono` <> 1));
drop table ventascorte;


create view  ventascorte as
select 0 AS `id`,`v`.`id_venta` as id_venta,`v`.`tipo` AS `tipo`,sum(`v`.`total`) AS `total`,`v`.`id_tienda` AS `id_tienda`
,`t`.`nombre` AS `nombre`,0 AS `abono`,`v`.`id_usuario` AS `id_usuario`
,date_format(str_to_date(`v`.`fecha`,'%Y-%m-%d'),'%Y-%m-%d') AS `fecha`
,`v`.`fecha` AS `fechahora` 
from (`venta` `v` 
join `tienda` `t` on((`v`.`id_tienda` = `t`.`id_tienda`))) 
where (`v`.`cancelado` = 0) 
group by `v`.`tipo`,`v`.`id_venta`,`v`.`id_tienda`,`t`.`nombre`,`v`.`id_usuario`,date_format(str_to_date(`v`.`fecha`,'%Y-%m-%d'),'%Y-%m-%d'),`v`.`fecha` 
union 
select 0 AS `id`,`d`.`id_venta` as id_venta,`v`.`tipo` AS `tipo`,sum(`d`.`montoabono`) AS `total`,`v`.`id_tienda` AS `id_tienda`,`t`.`nombre` AS `nombre`,
1 AS `abono`,`v`.`id_usuario` AS `id_usuario`,
date_format(str_to_date(`d`.`fecha_registro`,'%Y-%m-%d'),'%Y-%m-%d') AS `fecha`,`v`.`fecha` AS `fechahora` 
from ((`deudores` `d` join `venta` `v` on((`v`.`id_venta` = `d`.`id_venta`))) 
join `tienda` `t` on((`v`.`id_tienda` = `t`.`id_tienda`))) 
where ((`d`.`status` = 'ACTIVA') and (`v`.`cancelado` = 0)) 
group by `v`.`tipo`,`d`.`id_venta`,`v`.`id_tienda`,`t`.`nombre`,`v`.`id_usuario`
,date_format(str_to_date(`d`.`fecha_registro`,'%Y-%m-%d'),'%Y-%m-%d'),`v`.`fecha`