function follow() {
    $('#followform').submit(function (e) {

              $.ajax({
                type: 'POST',
                url: 'index.php',
                data: $('#followform').serialize(),
                success: function (data) {
                  $('#followbutton').text('Siguiendo');
                }
              });
          e.preventDefault();
        });
}
/*
    function llamada(letra) {
      $.ajax({
          url: "index.php?accion=buscar&letra=" + letra,
          cache: false,
          success: function(html){
            $("#listado").html(html);
          }
        });
    }

    $(document).ready(function(){
      $('#letra').keyup(function() {
          if ($(this).val().length == 0) {
            document.getElementById('listado').innerHTML="";
            document.getElementById('listado').style.border="0px";
          }
          var textValue = $(this).val();
        $.ajax({
            url: "index.php?accion=buscar&letra=" + textValue,
            cache: false,
            success: function(html){
              //$('#listado').html(html);
              document.getElementById('listado').innerHTML=html;
              document.getElementById('listado').style.border="1px solid #A5ACB2";
            }
          });
      });
    });*/

function buscar(letra) {
  if (letra.length == 0) {
    document.getElementById('listado').innerHTML="";
    document.getElementById('listado').style.border="0px";
    return;
  }
  $.ajax({
    url: "index.php?accion=buscar&letra=" + letra,
    cache: false,
    success: function(html){
      document.getElementById('listado').innerHTML=html;
      document.getElementById('listado').style.border="1px solid #A5ACB2";
    }
  });
}

function cambiar_filtro(nuevo_filtro){
  alert(nuevo_filtro);
  $.ajax({
                type: 'POST',
                url: 'index.php',
                data: {filtro : nuevo_filtro}
              });
}
