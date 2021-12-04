 <!-- User Modal Info -->
 <div class="modal fade" id="userModalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

   <div class="modal-dialog" role="document">

     <form id="formUserModelInfo" class="modal-content" method="post" action='/admin/user-management-page'>
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit user with id = ?</h5>
         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">

         <div class="form-group">
           <input name="FullName" type="text" class="form-control" placeholder="Full name">
         </div>
         <div class="form-group">
           <input name="UserName" type="text" class="form-control" placeholder="Username" required>
         </div>
         <div class="form-group">
           <input name="PassWord" type="password" class="form-control" placeholder="PassWord" required>
         </div>
         <div class="form-group">
           <input name="Email" type="email" class="form-control" placeholder="Email" required>
         </div>

         <div class="form-group">
           <?= $usercontrol->showGroups(); ?>
         </div>

         <div class="alert" role="alert" id="alertWarningUserModelInfo"></div>
         <input name="action" type="hidden" value="add">
       </div>
       <div class="modal-footer">
         <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
         <button class="btn btn-primary" type="submit">Submit</button>
       </div>
     </form>
   </div>
 </div>