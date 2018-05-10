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

