<!-- Hết Mã Nhúng -->

<?php include 'support.php';?>
<script src="<?=$domain;?>assets/js/main.js"></script>
<script type="text/javascript">
		jQuery(document).ready(function() {

			var $el = $('input[type="file"]');
			$el.fileinput({
			    theme: 'explorer-fas',
			    uploadUrl:  "../upload.php",
			    maxFileSize: 1024,
			    browseClass: "btn btn-block btn-info",
			    allowedFileExtensions: ["srt", "vtt"],
			    layoutTemplates: {progress: ''},
			    browseLabel: '',
			    browseIcon: '<i class="fas fa-upload"></i>',
			    initialPreviewAsData: true,
			    showCaption: false,
			    showCancel: false, 
				showDrag: false,
				showUpload: false,
				showRemove: false,
			}).on("filebatchselected", function(event, files) {
			    $el.fileinput("upload");
			}).on('fileuploaded', function(event, data, previewId, index) {
				jQuery('input#sub').val(data.response.initialPreview[index]);
				new PNotify({
				  title: 'Success!',
				  text: 'File uploaded successfully.',
				  type: 'success',
				  icon: ''
				});
    		}).on('fileuploaderror', function(event, data, msg) {
				if(data.response) {
					new PNotify({
					  title: 'Error!',
					  text: msg,
					  type: 'error',
					  icon: ''
					});
				}

    		});

		});
 $(document).ready(function() {
	$('#imdbInfoForm').on('submit', function(e) {
		e.preventDefault();
		$('#click_submit').prop('disabled', !3);
		$('#fa_load').html('<i class="fa fa-spinner fa-spin"></i>');
		var tmdbType = document.getElementById("tmdbData").value;
		switch(tmdbType) {
			case "Movie":
				var geturl = 'https://api.themoviedb.org/3/movie/';
				break;
			case "Series":
				var geturl = 'https://api.themoviedb.org/3/tv/';
				break;
		}
		var key = '?api_key=d9c9539e8c38404fe52f9485c55268a4&language=vi';
		var img = 'https://image.tmdb.org/t/p/w185';
		var imdbId = $('#imdbUrl').val();
		$.ajax({
			url: geturl + imdbId + key,
			success: function(data) {
				switch(tmdbType) {
					case "Movie":
						$('#tenphim').val(data.title);
						$('#imdb').val(data.imdb_id);
						$('#tmdb').val(data.id);
						break;
					case "Series":
						$('#tenphim').val(data.name);
						$('#tmdb').val(data.id);
						$('#sophan').val(data.number_of_seasons);
						break;
				}
				let theloai = `${data.genres[0].name}`;
				$('#theloai').val(theloai);
				$('#anh').val(img + data.poster_path);
				$('#anhnen').val(img + data.backdrop_path);
				$('#fa_load').html('<i class="fa fa-cog"></i> GENERATE');
				$('#click_submit').removeAttr('disabled');
			}
		}).done(function(data) {
		});
	})
});
</script>
  </div>
  <div id="overlay" style="display:none;">
    <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;"></div>
    <br />
    Đang Xử Lý...
  </div>
      </div>
</body>
</html>