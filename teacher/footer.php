      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date("Y") ?> <a href="#" target="_blank">Nirob Tpi</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Develop By Nirob <i class="mdi mdi-heart text-danger"></i></span>
          </div>
      </footer>
      <!-- partial -->
      </div>
      <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
      </div>
      <!-- container-scroller -->

      <!-- plugins:js -->
      <script src="../vendors/js/vendor.bundle.base.js"></script>
      <script src="../vendors/js/vendor.bundle.addons.js"></script>
      <!-- endinject -->
      <!-- Plugin js for this page-->
      <!-- End plugin js for this page-->
      <!-- inject:js -->
      <script src="../js/off-canvas.js"></script>
      <script src="../js/misc.js"></script>
      <!-- endinject -->
      <!-- Custom js for this page-->
      <script src="../js/dashboard.js"></script>
      <script src="//cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>

      <!-- End custom js for this page-->

      <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
      <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
      <script src=" https://cdn.datatables.net/buttons/3.0.0/js/buttons.dataTables.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
      <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
      <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>

      <script>
          //   let table = new DataTable('#myTable');
          $(document).ready(function() {
            //   let table = new DataTable('#myTable');
              $('#myTable').DataTable({
                      "pageLength": 5,
                      dom: 'Bfrtip',
                      buttons: [
                          'copyHtml5',
                          'excelHtml5',
                          'csvHtml5',
                          'pdfHtml5'
                      ]
                  }

              );
          });
      </script>
      </body>

      </html>