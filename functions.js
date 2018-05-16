function follow() {
  $('#followform').on('submit', function (e) {
    e.preventDefault();
  });
  $.ajax({
    type: 'POST',
    url: 'index.php',
    data: $('#followform').serialize(),
    success: function (data) {
      if (data == '1')
        $('#followbutton').text('Siguiendo');
      else if (data == '0')
        $('#followbutton').text('+ Seguir');
      }
    });
}

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
