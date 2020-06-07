



function validarRegistroTienda(){

var tienda = document.querySelector("#nombreComercio").value;
var descripcion = document.querySelector("#descripcionComercio").value;
var direccion = document.querySelector("#direccionComercio").value;
var telefono = document.querySelector("#telefonoComercio").value;
var password = document.querySelector("#PasswordComercio").value;

if (tienda != "") {
	var caracteres = tienda.length;
	var expresion = /^[a-zA-Z0-9]*$/;
	var exptelefono = /^[0-9]*$/;
	if(caracteres > 15){
		document.querySelector("label[for='nombreComercio']").innerHTML += "<br>Escribe menos de 15 caracteres";
		return false;
	}

if (!expresion.test(tienda)) {

	document.querySelector("label[for='nombreComercio']").innerHTML += "<br>Sin caracteres especiales >:(";
	return false;
}

if(!expresion.test(password)){
	document.querySelector("label[for='PasswordComercio']").innerHTML += "<br>Sin caracteres especiales >:(";
	return false;
}
if(!expresion.test(descripcion)){
	document.querySelector("label[for='descripcionComercio']").innerHTML += "<br>Sin caracteres especiales >:(";
	return false;
}
if(!exptelefono.test(telefono)){
	document.querySelector("label[for='telefonoComercio']").innerHTML += "<br>Solo numeros>:(";
	return false;
}
}

return true;	

}

function validarEdicionTienda(){

var tienda = document.querySelector("#EditnombreComercio").value;
var descripcion = document.querySelector("#EditdescripcionComercio").value;
var telefono = document.querySelector("#EdittelefonoComercio").value;
var password = document.querySelector("#EditPasswordComercio").value;

if (tienda != "") {
	var caracteres = tienda.length;
	var expresion = /^[a-zA-Z0-9]*$/;
	var exptelefono = /^[0-9]*$/;
	if(caracteres > 15){
		document.querySelector("label[for='EditnombreComercio']").innerHTML += "<br>Escribe menos de 15 caracteres";
		return false;
	}

if (!expresion.test(tienda)) {

	document.querySelector("label[for='nombreComercio']").innerHTML += "<br>Sin caracteres especiales >:(";
	return false;
}

if(!expresion.test(password)){
	document.querySelector("label[for='EditPasswordComercio']").innerHTML += "<br>Sin caracteres especiales >:(";
	return false;
}
if(!expresion.test(descripcion)){
	document.querySelector("label[for='EditdescripcionComercio']").innerHTML += "<br>Sin caracteres especiales >:(";
	return false;
}
if(!exptelefono.test(telefono)){
	document.querySelector("label[for='EdittelefonoComercio']").innerHTML += "<br>Solo numeros>:(";
	return false;
}
}

return true;	

}

function validarRegistroProducto(){

var nombre = document.querySelector("#productoNombre").value;
var video = document.querySelector("#productoVideo").value;
var precio = document.querySelector("#productoPrecio").value;
var descripcion = document.querySelector("#productoDescripcion").value;


if (nombre != "") {
	var caracteres = nombre.length;
	var expresion = /^[a-zA-Z0-9]*$/;
	var expprecio = /^([0-9])*$/;

	if(caracteres > 10){
		document.querySelector("label[for='productoNombre']").innerHTML += "<br>Escribe menos de 10 caracteres";
		return false;
	}

if (!expresion.test(nombre)) {

	document.querySelector("label[for='productoNombre']").innerHTML += "<br>Sin caracteres especiales >:(";
	return false;
}

if(!expresion.test(descripcion)){
	document.querySelector("label[for='productoDescripcion']").innerHTML += "<br>Sin caracteres especiales >:(";
	return false;
}
if(!expprecio.test(precio)){
	document.querySelector("label[for=productoPrecio']").innerHTML += "<br>Solo números>:(";
	return false;
}
}

return true;	

}

function validarEdicionProducto(){

var nombre = document.querySelector("#productoNombre").value;
var precio = document.querySelector("#PrecioP").value;



if (nombre != "") {
	var caracteres = nombre.length;
	var expresion = /^[a-zA-Z0-9]*$/;
	var expprecio = /^([0-9])*$/;

	if(caracteres > 10){
		document.querySelector("label[for='productoNombre']").innerHTML += "<br>Escribe menos de 10 caracteres";
		return false;
	}

if (!expresion.test(nombre)) {

	document.querySelector("label[for='productoNombre']").innerHTML += "<br>Sin caracteres especiales >:(";
	return false;
}


if(!expprecio.test(precio)){
	document.querySelector("label[for=PrecioP']").innerHTML += "<br>Solo números>:(";
	return false;

}
}
return true;	


}
