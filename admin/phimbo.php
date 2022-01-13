    <div class="alert alert-success text-center message" role="alert"></div>
      <!-- add/edit form modal -->
  <div class="modal fade" id="modalpb" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add/Edit TV</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <div class="modal-body">
	  <form method="post" id="imdbInfoForm">
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label for="title">IMDB/TMDB Data <span class="badge badge-info"> Optional ! </span></label>
											<div class="input-group">
												<select class="form-control" id="tmdbData">
												    <option value="Series">TV Series</option>
													<option value="Movie">Movies</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<label for="link">IMDB/TMDB ID <span class="badge badge-info"> Optional ! </span></label>
											<div class="input-group">
												<input type="text" class="form-control" name="url" id="imdbUrl" placeholder="Ex: tt0145487 or 557" required />
												<button type="submit" id="click_submit" class="btn btn-primary igen"><span id="fa_load"><span class="igen"> <i class="fa fa-cog"></i> GENERATE</span></span>
												</button>
											</div>
										</div>
									</div>
								</div>
		</form>
      <form id="addphimbo" method="POST" enctype="multipart/form-data">
	  		<div class="row">
		<div class="col-md-12">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="tenphim" name="tenphim" required="required">
            </div>
          </div>
		  <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tmdb Id:</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="tmdb" name="tmdb" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Category:</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="theloai" name="theloai" required="required">
            </div>
          </div>
		  <div class="form-group">
            <label for="message-text" class="col-form-label">Images:</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="anh" name="anh" required="required">
            </div>
          </div>
		  <div class="form-group">
            <label for="message-text" class="col-form-label">Season:</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="sophan" name="sophan" required="required">
            </div>
          </div>
		  <div class="form-group">
            <label for="message-text" class="col-form-label">Background:</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="anhnen" name="anhnen" required="required">
            </div>
          </div>
		  </div>
         </div>
         </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id="addButton">Add</button>
          <input type="hidden" name="action" value="addphimb">
          <input type="hidden" name="id" id="id" value="">
        </div>
      </form>
    </div>
    </div>
  </div>


    <div class="row mb-3">
      <div class="col-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalpb" id="addphimbobtn">Add TV Series <i
            class="fa fa-user-circle-o"></i></button>
      </div>
      <div class="col-9">
  <input type="text" class="form-control" placeholder="Search TV Series..." aria-label="Sizing example input" id="searchinput" aria-describedby="inputGroup-sizing-lg">
      </div>
    </div>
<table class="table" id="dsphimbo">
  <thead>
    <tr>
      <th scope="col">Images</th>
      <th scope="col">Name</th>
      <th scope="col">Season</th>
      <th scope="col">TMDB ID</th>
	  <th scope="col">Direct Links</th>
	  <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>
    <nav id="pagination">
    </nav>
    <input type="hidden" name="currentpage" id="currentpage" value="1">
  </div>
  <div>