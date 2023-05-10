//Ultima-Actualizacion:-02/02/2021

//Disparador-de-Menu-Desplegable
document.addEventListener("DOMContentLoaded", function () {
  var elems = document.querySelectorAll(".dropdown-trigger");
  var instances = M.Dropdown.init(elems, {
    coverTrigger: false,
    constrainWidth: false,
  });
});
//Fin-Disparador-de-Menu-Desplegable

//Disparador-de-Barra-Mobile
document.addEventListener("DOMContentLoaded", function () {
  var elems = document.querySelectorAll(".sidenav");
  var instances = M.Sidenav.init(elems);
});
//Fin-Disparador-de-Barra-Mobile

//Disparador-de-Menu-Desplegable
document.addEventListener("DOMContentLoaded", function () {
  var elems = document.querySelectorAll(".collapsible");
  var instances = M.Collapsible.init(elems);
});
//Fin-Disparador-de-Menu-Desplegable

//Fin-Disparador-de-forms-Desplegable
$(document).ready(function () {
  M.updateTextFields();
});

$("#borrar").on("click", function () {
  $("label").removeClass("active");
});
$(document).ready(function () {
  $("input#input_text, textarea#textarea2");
});

//Fin-Disparador-de-forms-Desplegable

//Disparador-de-modal-dialog
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.modal');
  var instances = M.Modal.init(elems);
});
//fin-Disparador-de-modal-dialog

//Funcion-para-formulario
document.addEventListener("DOMContentLoaded", function () {
  var elems = document.querySelectorAll(".autocomplete");
  var instances = M.Autocomplete.init(elems);
});
//Fin-Funcion-para-formulario

//fin-funcion-para-formulario-Fecha-de-nacimiento

document.addEventListener("DOMContentLoaded", function () {
  var elems = document.querySelectorAll("select");
  var instances = M.FormSelect.init(elems);
});

//fin-funcion-para-formulario-Fecha-de-nacimiento
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('select');
  var instances = M.FormSelect.init(elems);
});
