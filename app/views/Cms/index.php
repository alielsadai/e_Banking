<?php require_once 'app/views/template/beforeContent.php';?>
<?php require_once 'app/views/template/mainMenu.php';?>

<div class="container">
    <h3 class="text-center">Manage Users</h3>
    <br />
    <!--RESPONSIVE DIV WHICH HOLDS ADD BUTTON AND TABLE WITH USERS--> 
    <div class="table-responsive">
         <div class="pull-right">
              <!--ADD BUTTON FOR OPENING MODAL WINDOW WHEN WE WANT TO INSERT A NEW RECORD TO DATABASE.-->
            <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_modal" class="btn btn-warning">Add</button>
         </div>
         <br />
         <div id="user_table">  
              <table class="table table-bordered">
                   <tr>  
                        <th class="col-xs-8">Name</th>
                        <th class="col-xs-2">View</th>
                        <th class="col-xs-2">Edit</th>
                   </tr> 
                    <!--PHP SCRIPT WHICH GENERATES A ROW IN HTML TABLE FOR EVERY ROW FROM DATABASE-->
                   <?php foreach($DATA['users'] as $user) : ?>
                   <tr>
                        <td><?php echo $user->first_name . ' ' . $user->last_name?></td>
                        <td><input type="button" name="view" value="View" onclick="openViewModal(<?php echo $user->user_id?>);" class="btn btn-info btn-xs view_data" data-toggle="modal" data-target="#view_data_modal"/></td> 
                        <td><input type="button" name="edit" value="Edit" onclick="openEditModal(<?php echo $user->user_id?>);" class="btn btn-info btn-xs edit_data" data-toggle="modal" data-target="#edit_data_modal"/></td>  
                   </tr>
                   <?php endforeach;?>
              </table>
         </div>
    </div>
</div>

<!-- A MODEL WITH A FORM FOR ADDING NEW USERS -->
<div id="add_data_modal" class="modal fade">
     
</div>

<!-- A MODAL DISPLAYS PARTICULAR USER DETAILS -->
<div id="view_data_modal" class="modal fade">  
  
</div>

<!-- A MODAL WITH A FORM FOR EDITING USERS DETAILS -->
<div id="edit_data_modal" class="modal fade">  
  
</div>

<script>
    function openViewModal(userId) {
        $('#view_data_modal').load('<?php echo Configuration::BASE . 'admin/view/'; ?>' + userId); 
    }

    function openEditModal(userId) {
        $('#edit_data_modal').load('<?php echo Configuration::BASE . 'admin/edit/'; ?>' + userId); 
    }

    $( function() {
        $('#add_data_modal').load('<?php echo Configuration::BASE . 'templates/admin/add/'; ?>');
        
        // $('#view_data_modal').load('<?php echo Configuration::BASE . 'admin/view/'; ?>');
        
        // $('#edit_data_modal').load('<?php echo Configuration::BASE . 'templates/admin/edit/'; ?>');

       $( "#gender", "#status", "#user_type", "account_type").selectmenu();
     } );

    window.addEventListener('load', e => {
        setTimeout(function(){
            var hashCall = window.location.hash.replace('#', '');

            if (hashCall.length === 0) {
                return;
            }

            if (hashCall.match(/^view-/)) {
                var id = hashCall.split('-')[1];
                openViewModal(id);
                $('#view_data_modal').modal('show');
            }    
        }, 500);
    });
 
</script>

<?php require_once 'app/views/template/afterContent.php';?>