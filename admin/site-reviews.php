<!--Table -->

<table id="datatable-buttons" class="D-Table table table-striped dt-responsive nowrap">
    <thead>
        <tr>
            <th>Review ID</th>
            <th>User</th>
            <th>Email</th>
            <th>Product Name</th>
            <th>Model</th>
            <th>Review</th>
            <th>Quality</th>
            <th>Value</th>
            <th>Price</th>
            <th>Visibility</th>
            <!-- <th>Actions</th> -->
        </tr>
    </thead>


    <tbody id="Comment_Table_body">
    </tbody>
</table>


<!-- Tost -->
<!-- Then put toasts within -->
<div class="toast fade hide custom-toast slide-in-right" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast" style="position: fixed;bottom:30px;right:20px;z-index:99999!important">
    <div class="toast-header">
        <img src="assets/images/icons/user.png" alt="brand-logo" height="28" class="mr-2 rounded-circle">
        <strong class="mr-auto">
            <?php
            if (isset($_SESSION['A_Name'])) {
                echo ($_SESSION['A_UName']);
            }
            ?>
        </strong>
        <small>Just now</small>
        <button type="button" class="ml-2 mb-1 close custom-toast-dismiss" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="toast-body custom-toast-msg">
        Hello, world! This is a toast message.
    </div>
</div>
<!--end toast-->
<!-- end Tost -->