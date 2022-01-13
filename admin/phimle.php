<div class="alert alert-success text-center message" role="alert"></div>
<!-- add/edit form modal -->
<div class="modal fade" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add/Edit Movies</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="post" id="imdbInfoForm">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label for="title"><b>IMDB/TMDB Data </b><span class="badge badge-info"> Optional ! </span></label>
								<div class="input-group">
									<select class="form-control" id="tmdbData">
										<option value="Movie">Movies</option>
										<option value="Series">TV Series</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<label for="link"><b>IMDB/TMDB ID </b><span class="badge badge-info"> Optional ! </span></label>
								<div class="input-group">
									<input type="text" class="form-control" name="url" id="imdbUrl" placeholder="Ex: tt0145487 or 557" required />
									<button type="submit" id="click_submit" class="btn btn-primary igen"><span id="fa_load"><span class="igen"> <i class="fa fa-cog"></i> Generate</span></span>
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<form id="addform" method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="recipient-name" class="col-form-label">Name Movie:</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="tenphim" name="tenphim" required="required"> </div>
							</div>
							<div class="form-group">
								<label for="recipient-name" class="col-form-label">Imdb Id:</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="imdb" name="imdb" required="required"> </div>
							</div>
							<div class="form-group">
								<label for="recipient-name" class="col-form-label">Tmdb Id:</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="tmdb" name="tmdb" required="required"> </div>
							</div>
							<div class="form-group">
								<label for="message-text" class="col-form-label">Category:</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="theloai" name="theloai" required="required"> </div>
							</div>
							<div class="form-group">
								<label for="message-text" class="col-form-label">Images:</label>
								<div class="input-group mb-3">
									<input type="url" class="form-control" id="anh" name="anh" required="required"> </div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="recipient-name" class="col-form-label">Link Main <small style="color:red">(Only .MP4)</small></label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="link" name="link" required="required"> </div>
							</div>
							<div class="form-group">
								<label for="recipient-name" class="col-form-label">Link 1 <small style="color:red">(Accepting Embedded Pages)</small></label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="link1" name="link1" required="required"> </div>
							</div>
							<div class="form-group">
								<label for="recipient-name" class="col-form-label">Link 2 <small style="color:red">(Accepting Embedded Pages)</small></label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="link2" name="link2"> </div>
							</div>
							<div class="form-group">
								<label for="message-text" class="col-form-label">link 3 <small style="color:red">(Accepting Embedded Pages)</small></label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="link3" name="link3"> </div>
							</div>
							<div class="form-group">
								<label for="message-text" class="col-form-label">link 4 <small style="color:red">(Accepting Embedded Pages)</small></label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="link4" name="link4"> </div>
							</div>
							<div class="form-group">
								<label for="message-text" class="col-form-label">Background:</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="anhnen" name="anhnen" required="required"> </div>
							</div>
						</div>
						<div class="col-md-12">
							<div id="sub" class="mb-3">
								<div id="sub-block">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group m-0">
												<label class="font-weight-500"><b>Closed Captions</b></label>
												<select data-placeholder="Choose a Language..." name="caption[]" class="form-control">
													<option value="Afrikaans">Afrikaans</option>
													<option value="Albanian">Albanian</option>
													<option value="Arabic">Arabic</option>
													<option value="Armenian">Armenian</option>
													<option value="Basque">Basque</option>
													<option value="Bengali">Bengali</option>
													<option value="Bulgarian">Bulgarian</option>
													<option value="Catalan">Catalan</option>
													<option value="Cambodian">Cambodian</option>
													<option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
													<option value="Croatian">Croatian</option>
													<option value="Czech">Czech</option>
													<option value="Danish">Danish</option>
													<option value="Dutch">Dutch</option>
													<option value="English" selected>English</option>
													<option value="Estonian">Estonian</option>
													<option value="Fiji">Fiji</option>
													<option value="Finnish">Finnish</option>
													<option value="French">French</option>
													<option value="Georgian">Georgian</option>
													<option value="German">German</option>
													<option value="Greek">Greek</option>
													<option value="Gujarati">Gujarati</option>
													<option value="Hebrew">Hebrew</option>
													<option value="Hindi">Hindi</option>
													<option value="Hungarian">Hungarian</option>
													<option value="Icelandic">Icelandic</option>
													<option value="Indonesian">Indonesian</option>
													<option value="Irish">Irish</option>
													<option value="Italian">Italian</option>
													<option value="Japanese">Japanese</option>
													<option value="Javanese">Javanese</option>
													<option value="Korean">Korean</option>
													<option value="Latin">Latin</option>
													<option value="Latvian">Latvian</option>
													<option value="Lithuanian">Lithuanian</option>
													<option value="Macedonian">Macedonian</option>
													<option value="Malay">Malay</option>
													<option value="Malayalam">Malayalam</option>
													<option value="Maltese">Maltese</option>
													<option value="Maori">Maori</option>
													<option value="Marathi">Marathi</option>
													<option value="Mongolian">Mongolian</option>
													<option value="Nepali">Nepali</option>
													<option value="Norwegian">Norwegian</option>
													<option value="Persian">Persian</option>
													<option value="Polish">Polish</option>
													<option value="Portuguese">Portuguese</option>
													<option value="Punjabi">Punjabi</option>
													<option value="Quechua">Quechua</option>
													<option value="Romanian">Romanian</option>
													<option value="Russian">Russian</option>
													<option value="Samoan">Samoan</option>
													<option value="Serbian">Serbian</option>
													<option value="Slovak">Slovak</option>
													<option value="Slovenian">Slovenian</option>
													<option value="Spanish">Spanish</option>
													<option value="Swahili">Swahili</option>
													<option value="Swedish ">Swedish </option>
													<option value="Tamil">Tamil</option>
													<option value="Tatar">Tatar</option>
													<option value="Telugu">Telugu</option>
													<option value="Thai">Thai</option>
													<option value="Tibetan">Tibetan</option>
													<option value="Tonga">Tonga</option>
													<option value="Turkish">Turkish</option>
													<option value="Ukrainian">Ukrainian</option>
													<option value="Urdu">Urdu</option>
													<option value="Uzbek">Uzbek</option>
													<option value="Vietnamese">Vietnamese</option>
													<option value="Welsh">Welsh</option>
													<option value="Xhosa">Xhosa</option>
												</select>
											</div>
										</div>
										<div class="col-md-7">
											<div class="form-group m-0">
												<label class="font-weight-500"><b>Subtitle</b></label>
												<input type="text" class="form-control" id="sub" name="sub[]" value="" placeholder="Ex: https://hadpro.dev/the.boss.baby.srt (optional)" onclick="this.select()"> </div>
										</div>
										<div class="col-md-1">
											<div class="form-group m-0">
												<label class="font-weight-500"><b>Upload</b></label>
												<input id="subFile" name="subFile[]" type="file" accept=".srt, .vtt" class="btn btn-info btn-block" data-show-preview="false"> </div>
										</div>
										<div class="col-md-1" style="margin-top: 24px">
											<button type="button" id="add_new_sub" data-total="1" class="btn btn-success btn-block"><i class="fas fa-plus"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success" id="addButton">Submit</button>
				<input type="hidden" name="action" value="addphim">
				<input type="hidden" name="id" id="id" value=""> </div>
			</form>
		</div>
	</div>
</div>
<!-- add/edit form modal end -->
<div class="modal fade" id="userViewModal" tabindex="-1" role="dialog" aria-labelledby="userViewModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Embed Code </h5>
				</div>
			<div class="modal-body">
				<div class="container" id="manhung"> </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- Hết Mã Nhúng -->
<div class="row mb-3">
	<div class="col-3">
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" id="addnewbtn">Add Movies <i class="fa fa-user-circle-o"></i></button>
	</div>
	<div class="col-9">
		<input type="text" class="form-control" placeholder="Search Movies..." aria-label="Sizing example input" id="searchinput" aria-describedby="inputGroup-sizing-lg"> </div>
</div>
<table class="table" id="userstable">
	<thead>
		<tr>
			<th scope="col">Images</th>
			<th scope="col">Name Movies</th>
			<th scope="col">IMDB ID</th>
			<th scope="col">TMDB ID</th>
			<th scope="col">Direct Links</th>
			<th scope="col">Embed Code</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody> </tbody>
</table>
<nav id="pagination"> </nav>
<input type="hidden" name="currentpage" id="currentpage" value="1"> </div>
<div>