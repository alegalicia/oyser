$(document).ready(function () {
  $("#btn-submit").click(function (e) {
    e.preventDefault();
    let nombre = $("#name").val();
    let email = $("#email").val();
    let telefono = $("#telefono").val();
    let message = $("#message").val();
    let opcion = "enviar";
    $.post(
      "js/correo.php",
      { nombre, email, telefono, message, opcion },
      function (data, textStatus, jqXHR) {
        alert(
          "Consulta realizada exitoxmente en la brevedad nos contactaremos...!!!"
        );
        location.reload();
      }
    );
  });
});