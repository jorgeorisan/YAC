
SET SQL_SAFE_UPDATES =  0;

ALTER TABLE `xqwmrfeeug`.`tienda` 
ADD COLUMN `color` VARCHAR(45) NULL AFTER `abreviacion`;
UPDATE `xqwmrfeeug`.`tienda` SET `color` = 'pink' WHERE (`id_tienda` = '18');
UPDATE `xqwmrfeeug`.`tienda` SET `color` = 'blue' WHERE (`id_tienda` = '17');
