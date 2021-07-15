# Listas de las API para el manejo de operaciones y consultas para el sistema version 1.0.0

## Loggen.

metodo: POST

http://appmaps.neoaplicaciones.com/src/login.php

parametros para el ingreso de un usuario.

    	- usuario.
    	- password.

## Consultar un movilizador o elector por cedula.

metodo: GET

parametros para consultar al usuario.

http://appmaps.neoaplicaciones.com/src/query.data.php?cedula={value}

## Dirección para guardar al movilizador dentro del sistema 

metodo: POST

http://appmaps.neoaplicaciones.com/src/save.manager.php

parametros para registrar a un movilizador

	- usuario
	- password
	- cedula
	- nombre
	- telefono

## Listar todos los movilizadores registrado por un jefe de ubch.

metodo: GET

http://appmaps.neoaplicaciones.com/src/list.manager.php

no recibe ningún parametro.

## Guardar un elector.

http://appmaps.neoaplicaciones.com/src/save.php

metodo: POST

parametros a recibir.

	- cedula
	- nombres
	- apellidos
	- email
	- celular

## Listar electores por movilizador y centro de votación.

http://appmaps.neoaplicaciones.com/src/list.php

metodo: GET

no recibe ningún parametro.

## Mostrar todos los centros de votación disponibles en el sistema

http://appmaps.neoaplicaciones.com/src/ubchcenter.php

metodo: GET

no recibe ningún parametro.