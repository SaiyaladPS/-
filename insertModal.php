
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ການບັນທືກຂໍ້ມູນ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" id="insert-form">
                <input type="hidden" name="form_id" id="form_id">
            <label for="">ຊື່</label>
                <input type="text" id="form_fname" name="form_fname" class="form-control">
            <label for="">ນາມສະກຸນ</label>
                <input type="text" id="form_lname" name="form_lname" class="form-control">
            <label for="">Email</label>
                <input type="text" id="form_email" name="form_email" class="form-control">
            <label for="">Web</label>
                <input type="text" id="form_Web" name="form_Web" class="form-control">
        
      </div>
      <div class="modal-footer">
        <button type="submit" id="btn-insert" class="btn btn-primary">ບັນທືກ</button>
      </div>
      </form>
    </div>
  </div>
</div>