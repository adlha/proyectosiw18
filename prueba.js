// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
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
  // Get the modal
  var modal = document.getElementById('myModal');
  var slides = document.getElementsByClassName("mySlides");
  if (n > slides.length) {zoomIndex = 1}
  if (n < 1) {zoomIndex = slides.length}
  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img = document.getElementById('img'+ zoomIndex);
  var modalImg = document.getElementById("imgmodal");
  modal.style.display = "block";
  modalImg.src = img.src;

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
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
    "accion": "mostrargaleria"
  };
  $.ajax({
    type: 'POST',
    url: 'galeriaprueba.php',
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

var slideIndex = 1;
var zoomIndex = 1;