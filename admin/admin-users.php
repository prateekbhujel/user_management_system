<?php
require_once 'assets/php/admin-header.php';
?>


    <div class="row">
        <div class="col-lg-12">
            <div class="card my-2 border-success">
                <div class="card-header bg-success text-white">
                    <h4 class="m-0">Total registered Users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="showAllUsers">
                        <p class="text-center align-self-center lead">
                            Please Wait . . . . 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Display Users in Details Model -->
    <div class="modal fade" id="showUserDetailsModal">
        <div class="modal-dialog modal-dialog-centered mw-100 w-50">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"id="getName"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="card-deck">
                        <div class="card border-primary">
                            <div class="card-body">
                                <p id="getEmail"></p>
                                <p id="getPhone"></p>
                                <p id="getDob"></p>
                                <p id="getGender"></p>
                                <p id="getCreated"></p>
                                <p id="getVerified"></p>
                            </div>
                        </div>
                        <div class="card align-self-centered" id="getImage"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
<script>
    $(document).ready(function(){
        //Fetch All Users Ajax Request
        fetchAllUsers();
        function fetchAllUsers(){
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: { action: 'fetchAllUsers' },
                success:function (response){
                    $("#showAllUsers").html(response);
                    $("table").DataTable({
                        order: [0, 'desc'],
                    });
                }
            });
        }

        //Display USer in Details Ajax Request
        $("body").on("click",".userDetailsIcon",function(e){
            e.preventDefault();

            details_id = $(this).attr("id");
            $.ajax({
                url: "assets/php/admin-action.php",
                type: 'post',
                data: { details_id: details_id },
                success:function(response){
                    data = JSON.parse(response);    // Changing The Json into JavaScipt Objects 
                    $("#getName").text(data.name+' '+'(ID:'+data.id+')');
                    $("#getEmail").text('email  : '+data.email);
                    $("#getPhone").text('Phone : '+data.phone);
                    $("#getDob").text('DOB : '+data.dob);
                    $("#getGender").text('Gender : '+data.gender);
                    $("#getCreated").text('Joined On : '+data.created);
                    $("#getVerified").text('Verified On : '+data.verified);

                    if(data.photo != ''){
                        $("#getImage").html('<img src="../assets/php/'+data.photo+'" alt="" class="img-thmbnail img-fluid align-self-center" width="280px">');
                    }
                    else{
                        $("#getImage").html('<img src="../assets/img/avatar.png" alt="" class="img-thmbnail img-fluid align-self-center" width="280px">');

                    }
                }
            });
        });
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
        $("body").on("click",".deleteUserIcon", function(e){
            e.preventDefault();
            del_id = $(this).attr('id');
            console.log(del_id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                        }).then((result) => 
                    {
                        if (result.value) 
                        {
                            $.ajax({
                                url: 'assets/php/admin-action.php',
                                method: 'post',
                                data: { del_id: del_id},
                                success: function(response){
                                    Swal.fire(
                                        'Deleted!',
                                        'Note has been deleted.',
                                        'success')
                                       fetchAllUsers();
                                    }
                            });    
                }
    });
});

});
</script>
</body>
</html>