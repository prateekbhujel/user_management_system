<?php
require_once 'assets/php/admin-header.php';
?>

    <div class="row">
    <div class="col-lg-12">
            <div class="card my-2 border-danger">
                <div class="card-header bg-danger text-white">
                    <h4 class="m-0">Total Deleted Users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="showAllDeletedUsers">
                        <p class="text-center align-self-center lead">Please Wait . . . 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Area -->
        </div>
    </div>
</div>
<!-- Sweet Altert JS CDN -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<!-- DataTable JS CDN -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.13.1/datatables.min.js"></script>


<Script type="text/javascript">
    $(document).ready(function(){
        //Fetch All Deleted User Ajax Request
        fetchAllDeletedUsers();
        function fetchAllDeletedUsers(){
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: { action: 'fetchAllDeletedUsers' },
                success:function(response){
                    $("#showAllDeletedUsers").html(response);
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }
        // Check Notification
        checkNotification();
        function checkNotification(){
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: { action: 'checkNotification' },
                success:function(response){
                    // console.log(response);
                    $("#checkNotification").html(response)
                }
            });
        }
        //Delete An User In Details Ajax Request
        $("body").on("click",".restoreUserIcon", function(e){
            e.preventDefault();
            res_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure, you want to restored this user?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Restore The User.'
                        }).then((result) => 
                    {
                        if (result.value) 
                        {
                            $.ajax({
                                url: 'assets/php/admin-action.php',
                                method: 'post',
                                data: { res_id: res_id},
                                success: function(response){
                                    Swal.fire(
                                        'Restored!',
                                        'Note: User has been Restored.',
                                        'success'
                                        )
                                        fetchAllDeletedUsers();
                                    }
                            });    
                }
    });
});
});
</Script>
</body>
</html>