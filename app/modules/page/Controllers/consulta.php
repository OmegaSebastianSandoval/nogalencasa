SELECT user.*, socio_cedula, socio_nombre
FROM `user` LEFT JOIN
socios ON socio_carnet=user_accion
WHERE `user_level` = '5'

NUX

SELECT user.*, socio_cedula, socio_nombre
FROM `user` LEFT JOIN
socios ON socio_carnet = LPAD(user_accion, 8, "0")
WHERE (`user_level` = '5' OR user_level='3') AND user_date>="2020-07-29" AND user_accion!='00000000'