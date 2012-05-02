/*
 * Translated default messages for the jQuery validation plugin.
 * Language: ES
 * Author: David Esperalta - http://www.dec.gesbit.com/
 */
jQuery.extend(jQuery.validator.messages, {
  required: "*Se reqiuere este campo.",
  remote: "**Por favor, rellena esta campo.",
  email: "**Por favor, escribe una direccion de correo valida",
  url: "*Por favor, escribe una URL valida.",
  date: "*Por favor, escribe una fecha valida.",
  dateISO: "*Por favor, escribe una fecha (ISO) valida.",
  number: "*Por favor, escribe un numero entero valido.",
  digits: "*Por favor, escribe solo digitos.",
  creditcard: "*Por favor, escribe un numero de tarjeta valido.",
  equalTo: "*Por favor, escribe el mismo valor de nuevo.",
  accept: "*Por favor, escribe una valor con una extension aceptada.",
  maxlength: jQuery.validator.format("*Por favor, no escribas mas de {0} caracteres."),
  minlength: jQuery.validator.format("*Por favor, no escribas menos de {0} caracteres."),
  rangelength: jQuery.validator.format("*Por favor, escribe un valor entre {0} y {1} caracteres."),
  range: jQuery.validator.format("*Por favor, escribe un valor entre {0} y {1}."),
  max: jQuery.validator.format("*Por favor, escribe un valor igual o menor que {0}."),
  min: jQuery.validator.format("*Por favor, escribe un valor igual o mayor que {0}.")
});