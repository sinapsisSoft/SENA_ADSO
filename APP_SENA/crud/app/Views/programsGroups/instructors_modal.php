<div class="modal fade" id="instructor-modal" tabindex="-1" aria-labelledby="instructor-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="instructor-modalLabel">ADD INSTRUCTORS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--Form-->
        <form id="instructor-form" class="">
          <!--Table-->
          <div class="row">
            <div class="col-6">
            <div class="table-responsive mx-auto">
                <table class="table table-hover" id="table-no-group-instructor">
                  <thead class="table-dark">
                    <tr class="text-center">
                      <th scope="col">#</th>
                      <th scope="col">Document</th>
                      <th scope="col">First Name</th>
                      <th scope="col">Last Name</th>
                      <th scope="col">Specialty</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot class="table-dark">
                    <tr class="text-center">
                      <th scope="col">#</th>
                      <th scope="col">Document</th>
                      <th scope="col">First Name</th>
                      <th scope="col">Last Name</th>
                      <th scope="col">Specialty</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class="col-6">
            
              <div class="table-responsive mx-auto">
                <table class="table table-hover" id="table-group-instructor">
                  <thead class="table-dark">
                    <tr class="text-center">
                      <th scope="col">#</th>
                      <th scope="col">Document</th>
                      <th scope="col">First Name</th>
                      <th scope="col">Last Name</th>
                      <th scope="col">Specialty</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot class="table-dark">
                    <tr class="text-center">
                      <th scope="col">#</th>
                      <th scope="col">Document</th>
                      <th scope="col">First Name</th>
                      <th scope="col">Last Name</th>
                      <th scope="col">Specialty</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <!--End Table-->
        </form>
        <!--End Form-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="instructor-form" id="btn_instructor_form" class="btn btn-primary" disabled>Send Data</button>
      </div>
    </div>
  </div>
</div>