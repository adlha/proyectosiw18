function follow() {
  $('#followform').on('submit', function (e) {
    e.preventDefault();
  });
  $.ajax({
    type: 'POST',
    url: 'index.php',
    cache: false,
    data: $('#followform').serialize(),
    success: function (data) {
      alert(data);
      if (data == '0')
        $('#followbutton').text('+ Seguir');
      else
        $('#followbutton').text('Siguiendo');
      }
    });
}

function buscar() {
  var letra = $('#letra').val();
  if (letra.length == 0) {
    limpiarbuscador();
    return;
  }
  var filtro = $('#filtrobuscador').val();
  $.ajax({
    url: "index.php?accion=buscar&id="+ filtro + "&letra=" + letra,
    cache: false,
    success: function(html){
      var json_parsed = $.parseJSON(html);
      document.getElementById('listado').innerHTML=json_parsed;
      document.getElementById('listado').style.border="1px solid #A5ACB2";
    }
  });
}

function limpiarbuscador() {
  document.getElementById('listado').innerHTML="";
  document.getElementById('listado').style.border="0px";
}

function valorargrupo() {
  var valoracion = $('#valoracion').val();
  var idgrupo = $('#idgrupovalorar').val();
  $.ajax({
    url: 'index.php?accion=grupo&id=4&idgrupo='+ 
      idgrupo +'&valoracion=' + valoracion,
    cache: false,
    success: function (data) {
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
