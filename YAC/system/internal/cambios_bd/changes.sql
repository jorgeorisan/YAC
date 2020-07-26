-- 26 JULIO jorge
--agregar campo descripcion a producto para ponerlo en el website
--

ALTER TABLE `xqwmrfeeug`.`producto` 
ADD COLUMN `descripcion` text NULL AFTER `status_categoria`;