<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.1
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">CORECODE SYSTEMS</a>.</strong> All rights
    reserved.
  </footer>  

      
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Chosen-1.6.2 -->
<script src="../assets/chosen/chosen.jquery.min.js"></script>
<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/dist/js/demo.js"></script>
<!-- Bootbox -->
<script src="../assets/bootstrap/js/bootbox.min.js"></script>
<!-- bootstrap-datepicker
<script type="text/javascript" src="../assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../assets/plugins/daterangepicker/date.js"></script>
<script type="text/javascript" src="../assets/plugins/daterangepicker/daterangepicker.js"></script>-->

<script>
    $(document).ready(function() {
        
        //dataTables
        $('#content_list').DataTable();
        
        //chosen
        $('select').chosen();
        
        
        // Fill modal with content from link href
        $("#insectModal").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        
        
        //Deleting insect bootbox
        $('.delete_insect').click(function(e){
			
			e.preventDefault();
			
			var id = $(this).attr('data-id');
			var parent = $(this).parent("td").parent("tr");
			
			bootbox.dialog({
			  message: "Are you sure you want to Delete this insect record ?",
			  title: "<i class='glyphicon glyphicon-trash'></i> Confirm Delete !",
			  buttons: {
				success: {
				  label: "No",
				  className: "btn-success",
				  callback: function() {
					 $('.bootbox').modal('hide');
				  }
				},
				danger: {
				  label: "Delete!",
				  className: "btn-danger",
				  callback: function() {
					  
					  /*
					  
					  using $.ajax();
					  
					  $.ajax({
						  
						  type: 'POST',
						  url: 'delete.php',
						  data: 'delete='+pid
						  
					  })
					  .done(function(response){
						  
						  bootbox.alert(response);
						  parent.fadeOut('slow');
						  
					  })
					  .fail(function(){
						  
						  bootbox.alert('Something Went Wrog ....');
						  						  
					  })
					  */
					  
					  
					  $.post('delete_insect.php', { 'delete':id })
					  .done(function(response){
						  bootbox.alert(response);
						  parent.fadeOut('slow');
					  })
					  .fail(function(){
						  bootbox.alert('Deleting record failed!!!');
					  });
					  					  
				  }
				}
			  }
			});
			
			
		});
        
    } );
</script>

</body>
</html>