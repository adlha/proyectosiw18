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
      if (data == '1')
        $('#followbutton').text('Siguiendo');
      else if (data == '0')
        $('#followbutton').text('+ Seguir');
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
  $.ajax({
    type: 'POST',
    url: 'index.php',
    data: {filtro : nuevo_filtro},
    cache: false,
    success: function(html){
      var lineaoriginal='<input onchange="cambiar_filtro('+nuevo_filtro+');"';
      var nuevalinea='<input onchange="cambiar_filtro('+nuevo_filtro+');" checked="checked"';
      html=html.replace(lineaoriginal,nuevalinea);
      document.documentElement.innerHTML=html;
    }
  });
}

var slideIndex = 1;
var zoomIndex = 1;

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
} 

function zoom(n) {
  var modal = document.getElementById('myModal');
  var slides = document.getElementsByClassName("mySlides");
  if (n > slides.length) {zoomIndex = 1}
  if (n < 1) {zoomIndex = slides.length}
  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img = document.getElementById('img'+ zoomIndex);
  var modalImg = document.getElementById("imgmodal");
  modal.style.display = "block";
  modalImg.src = img.src;

  var span = document.getElementsByClassName("close")[0];

  span.onclick = function() {
    modal.style.display = "none";
  }
}

function plusZoom(n) {
  zoom(zoomIndex += n);
}

function currentZoom(n) {
  zoom(zoomIndex = n);
}

function mostrarGaleria() {
  document.getElementById("mostrargaleria").className += " hidden";
  document.getElementById("cerrargaleria").className = document.getElementById("cerrargaleria").className.replace(" hidden", "");
  if ($("#galeria").is(":hidden")) {
    $("#galeria").show();
    return;
  }
  var param = {
    "accion": "grupo",
    "id" : "5"
  };
  $.ajax({
    type: 'POST',
    url: 'index.php',
    cache: false,
    data: param,
    success: function (data) {
      document.getElementById("galeria").innerHTML=data;
      showSlides(slideIndex);
    }
  });
}

function cerrarGaleria() {
  document.getElementById("cerrargaleria").className += " hidden";
  document.getElementById("mostrargaleria").className = document.getElementById("mostrargaleria").className.replace(" hidden", "");
  $("#galeria").hide();
}

