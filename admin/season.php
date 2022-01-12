 <?php require('head.php'); ?> 
  <div class="alert alert-success text-center message" role="alert"></div>
      <!-- add/edit form modal -->
  <div class="modal fade" id="modalseason" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add/Edit Season</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <div class="modal-body">
      <form id="addseason" method="POST" enctype="multipart/form-data">
	  		<div class="row">
		<div class="col-md-12">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="tenphim" name="tenphim" required="required">
            </div>
          </div>
		  <div class="form-group">
            <label for="message-text" class="col-form-label">Images:</label>
            <div class="input-group mb-3">
              <input type="url" class="form-control" id="anh" name="anh" required="required">
            </div>
          </div>
		  <div class="form-group">
            <label for="message-text" class="col-form-label">Season:</label>
            <div class="input-group mb-3">
              <input type="number" class="form-control" id="idphan" name="idphan" required="required">
            </div>
          </div>
		  </div>
         </div>
         </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id="addButton">Add</button>
          <input type="hidden" name="action" value="addseason">
          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="tmdb" id="tmdb" value="">
        </div>
      </form>
    </div>
    </div>
  </div>
    <div class="row mb-3">
      <div class="col-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalseason" id="addseasonbtn">Add Seanson <i
            class="fa fa-user-circle-o"></i></button>
      </div>
    </div>
<table class="table" id="dsseason">
  <thead>
    <tr>
      <th scope="col">Images</th>
      <th scope="col">Name Movies</th>
      <th scope="col">Season</th>
      <th scope="col">TMDB ID</th>
	  <th scope="col">Manager</th>
	  <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>
  </div>
  <div>
  
   <?php 
  echo '<script src="'.$domain.'assets/js/season.js"></script>';
   require('footer.php'); ?> 