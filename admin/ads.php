<?php 
require_once('head.php'); 
?>
    <div class="alert alert-success text-center message" role="alert"></div>
      <!-- add/edit form modal -->
  <div class="modal fade" id="addadsw" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add/Edit ADS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <div class="modal-body">
      <form id="addformads" method="POST" enctype="multipart/form-data">
	  		<div class="row">
		<div class="col-md-12">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">ADS Vast:</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="advast" name="advast" required="required">
            </div>
          </div>
		  <div class="form-group">
            <label for="recipient-name" class="col-form-label">ADS POPUP:</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="adpopup" name="adpopup" required="required">
            </div>
          </div>
		  	  </div>
         </div>
         </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id="addButton">Submit</button>
          <input type="hidden" name="action" value="addad">
          <input type="hidden" name="id" id="id" value="">
        </div>
      </form>
    </div>
    </div>
  </div>
<!-- List ADS -->
<div class="row mb-3">
	<div class="col-3">
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addadsw" id="addnewads">Add ADS <i class="fa fa-user-circle-o"></i></button>
	</div>
</div>
<table class="table" id="listadsb">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">advast</th>
      <th scope="col">Ads PopUp</th>
	  <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>		
<?php 
require_once('footer.php');
 ?>