SELECT * FROM xqwmrfeeug.producto_tienda where id_producto=1614

select count(id_productotienda) total, id_producto,tienda_id_tienda
from producto_tienda 
group by id_producto,tienda_id_tienda
having  count(id_productotienda)>1

select * from producto where id_producto=1119