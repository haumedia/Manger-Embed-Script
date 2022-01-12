document.addEventListener("DOMContentLoaded", function(event) {
const showNavbar = (toggleId, navId, bodyId, headerId) =>{
const toggle = document.getElementById(toggleId),
nav = document.getElementById(navId),
bodypd = document.getElementById(bodyId),
headerpd = document.getElementById(headerId)

// Validate that all variables exist
if(toggle && nav && bodypd && headerpd){
toggle.addEventListener('click', ()=>{
// show navbar
nav.classList.toggle('showa')
// change icon
toggle.classList.toggle('fa-square-x')
// add padding to body
bodypd.classList.toggle('body-pd')
// add padding to header
headerpd.classList.toggle('body-pd')
})
}
}

showNavbar('header-toggle','nav-bar','body-pd','header')

/*===== LINK ACTIVE =====*/
const linkColor = document.querySelectorAll('.nav_link')

function colorLink(){
if(linkColor){
linkColor.forEach(l=> l.classList.remove('active'))
this.classList.add('active')
}
}
linkColor.forEach(l=> l.addEventListener('click', colorLink))

// Your code to run since DOM is loaded and ready
});
jQuery(function ($) {


	//Add Sub
	jQuery(document).on('click', '#add_new_sub', function(e){
	    e.preventDefault();
	    var num = $(this).data('total');
		var ep = num + 1;
		$(this).data('total', ep);
		var new_sub = '<div id="sub-block">';
		new_sub += '<div class="row">';
		new_sub += '<div class="col-md-3"> <div class="form-group m-0"> <label class="font-weight-bold"></label> <select data-placeholder="Choose a Language..." name="caption[]" class="form-control"> <option value="Afrikaans">Afrikaans</option> <option value="Albanian">Albanian</option> <option value="Arabic">Arabic</option> <option value="Armenian">Armenian</option> <option value="Basque">Basque</option> <option value="Bengali">Bengali</option> <option value="Bulgarian">Bulgarian</option> <option value="Catalan">Catalan</option> <option value="Cambodian">Cambodian</option> <option value="Chinese (Mandarin)">Chinese (Mandarin)</option> <option value="Croatian">Croatian</option> <option value="Czech">Czech</option> <option value="Danish">Danish</option> <option value="Dutch">Dutch</option> <option value="English" selected>English</option> <option value="Estonian">Estonian</option> <option value="Fiji">Fiji</option> <option value="Finnish">Finnish</option> <option value="French">French</option> <option value="Georgian">Georgian</option> <option value="German">German</option> <option value="Greek">Greek</option> <option value="Gujarati">Gujarati</option> <option value="Hebrew">Hebrew</option> <option value="Hindi">Hindi</option> <option value="Hungarian">Hungarian</option> <option value="Icelandic">Icelandic</option> <option value="Indonesian">Indonesian</option> <option value="Irish">Irish</option> <option value="Italian">Italian</option> <option value="Japanese">Japanese</option> <option value="Javanese">Javanese</option> <option value="Korean">Korean</option> <option value="Latin">Latin</option> <option value="Latvian">Latvian</option> <option value="Lithuanian">Lithuanian</option> <option value="Macedonian">Macedonian</option> <option value="Malay">Malay</option> <option value="Malayalam">Malayalam</option> <option value="Maltese">Maltese</option> <option value="Maori">Maori</option> <option value="Marathi">Marathi</option> <option value="Mongolian">Mongolian</option> <option value="Nepali">Nepali</option> <option value="Norwegian">Norwegian</option> <option value="Persian">Persian</option> <option value="Polish">Polish</option> <option value="Portuguese">Portuguese</option> <option value="Punjabi">Punjabi</option> <option value="Quechua">Quechua</option> <option value="Romanian">Romanian</option> <option value="Russian">Russian</option> <option value="Samoan">Samoan</option> <option value="Serbian">Serbian</option> <option value="Slovak">Slovak</option> <option value="Slovenian">Slovenian</option> <option value="Spanish">Spanish</option> <option value="Swahili">Swahili</option> <option value="Swedish ">Swedish </option> <option value="Tamil">Tamil</option> <option value="Tatar">Tatar</option> <option value="Telugu">Telugu</option> <option value="Thai">Thai</option> <option value="Tibetan">Tibetan</option> <option value="Tonga">Tonga</option> <option value="Turkish">Turkish</option> <option value="Ukrainian">Ukrainian</option> <option value="Urdu">Urdu</option> <option value="Uzbek">Uzbek</option> <option value="Vietnamese">Vietnamese</option> <option value="Welsh">Welsh</option> <option value="Xhosa">Xhosa</option> </select> </div> </div>';
		new_sub += '<div class="col-md-7"> <div class="form-group m-0"> <label class="font-weight-bold"></label> <input type="text" class="form-control" id="sub'+ep+'" name="sub[]" onclick="this.select()"> </div> </div>';
		new_sub += '<div class="col-md-1"> <div class="form-group m-0"> <label class="font-weight-bold"></label> <input id="subFile'+ep+'" name="subFile[]" type="file" accept=".srt, .vtt" class="btn btn-info btn-block" data-show-preview="false"> </div> </div>';
		new_sub += '<div class="col-md-1" style="margin-top: 24px"> <button type="button" id="remove_sub" class="btn btn-danger btn-block"><i class="far fa-trash-alt"></i></button> </div>';
		new_sub += '</div></div>';		
		$('#sub').append(new_sub);
		jQuery('#subFile' + ep).fileinput({
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
		    jQuery('#subFile' + ep).fileinput("upload");
		}).on('fileuploaded', function(event, data, previewId, index) {
			jQuery('#sub' + ep).val(data.response.initialPreview[index]);
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

//Xóa Sub
	$(document).on('click', '#remove_sub', function(e){
	    e.preventDefault();
	    $(this).closest('#sub-block').remove();
	});
//Thêm Tập
	jQuery(document).on('click', '#add-tap', function(e){

	    e.preventDefault();

	    var num = $(this).data('total');

		var ep = num + 1;

		$(this).data('total', ep);
        var contap = '<button class="nav-link" id="tap'+ep+'" data-bs-toggle="tab" data-bs-target="#ttap'+ep+'" type="button" role="tab" aria-controls="ttap'+ep+'" aria-selected="false">Tập '+ep+'</button>';
			
		var addtap = '<div class="tab-pane fade" id="ttap'+ep+'" role="tabpanel" aria-labelledby="tap'+ep+'">';
		addtap += '<input type="hidden" name="tentap" id="tentap" value="'+ep+'">';
		addtap += '<div class="form-group"><label for="recipient-name" class="col-form-label">Link Chính:</label><div class="input-group mb-3"><input type="text" class="form-control" placeholder="Link Tập '+ep+'" id="link" name="link" required="required"></div></div>';
		addtap += '<div class="form-group"><label for="recipient-name" class="col-form-label">Link 1:</label><div class="input-group mb-3"><input type="text" class="form-control" id="link1" name="link1" required="required"></div></div>';
		addtap += '<div class="form-group"><label for="recipient-name" class="col-form-label">Link 2:</label><div class="input-group mb-3"><input type="text" class="form-control" id="link2" name="link2"></div></div>';
        addtap += '<div class="form-group"><label for="message-text" class="col-form-label">link 3:</label><div class="input-group mb-3"><input type="text" class="form-control" id="link3" name="link3"></div></div>';
		addtap += '<div class="form-group"><label for="message-text" class="col-form-label">link 4:</label><div class="input-group mb-3"><input type="text" class="form-control" id="link4" name="link4"></div></div>';
		addtap += '</div></div>';
		$('#nav-tab').append(contap);
		$('#nav-tabContent').append(addtap);
	});
//Delete Tập
	$(document).on('click', '#xoatap', function(e){
	    e.preventDefault();
	    $(this).closest('.tab-pane').remove();
	});
})
