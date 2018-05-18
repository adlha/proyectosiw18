Dropzone.options.myAwesomeDropzone = {
  paramName: "file", // The name that will be used to transfer the file
  url: "index.php?accion=subirimagenes",
  parallelUploads: 5,
  maxFiles: 5,
  maxFilesize: 2, // MB
  autoProcessQueue: false,
  acceptedFiles: "image/*",
  init: function () {
  	var myDropzone = this;

  	document.getElementById("submit-all").addEventListener("click", function (e) {
  		e.preventDefault();
    	$.ajax({
		    type: 'POST',
		    url: 'index.php',
		    cache: false,
		    data: $('#altagrupoform').serialize(),
		    success: function (data) {
		    	if (data == "-1") {
		    		window.location.href = "index.php?accion=alta&id=11&resultado=" + data;
		    	} else {
		    		if (myDropzone.getQueuedFiles().length > 0) {
		    			myDropzone.on("sending", function(file, xhr, formData) {
	  						// Will send the filesize along with the file as POST data.
							formData.append("id_grupo", data);
						});
						myDropzone.on("queuecomplete", function(file) {
							window.location.href = "index.php?accion=alta&id=11&resultado=" + data;
						});
			    		myDropzone.processQueue();
		    		} else {
		    			window.location.href = "index.php?accion=alta&id=11&resultado=" + data;
		    		}
		    	}
		    }
    	});
  	});

  	myDropzone.on("addedfile", function(file) {
	  	file.previewElement.addEventListener("click", function() {
	    	myDropzone.removeFile(file);
  		});
	});
  },
};
