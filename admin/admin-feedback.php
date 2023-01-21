<?php
require_once 'assets/php/admin-header.php';
?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card my-2 border-warninig">
                <div class="card-header bg-warning text-white">
                    <h4 class="m-0">Total Feedback from Users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="showAllFeedback">
                        <p class="text-center align-self-center lead">
                            Please Wait . . . . 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reply Feed Back Model -->
    <div class="modal fade" id="showReplyModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Reply To This Feedback</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post"action="#" class="px-3" id="feedback-reply-form">
                        <div class="form-group">
                            <textarea name="message" id="message" class="form-control" rows="6" placeholder="Write Your Message Here . . . . " required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit"name="submit" value="Send Reply" class="btn btn-primary btn-block" id="feedbackReplyBtn">
                        </div>
                    </form>
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


<script type="text/javascript">
    $(document).ready(function(){
    
        //Fetch All Users Feedback Ajax Request
        fetchAllFeedback();
        function fetchAllFeedback(){
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: { action: 'fetchAllFeedback' },
                success:function (response){
                    $("#showAllFeedback").html(response);
                    $("table").DataTable({
                        order: [0, 'desc'],
                    });
                }
            });
        }
        // Get The Current Row User Id and Feedback ID
        var uid;
        var fid;
        $("body").on("click", ".replyFeedbackIcon", function(e){
            uid = $(this).attr('id');
            fid = $(this).attr('fid');
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

        //Send FeedBack Reply to the user Ajax Request
        $("#feedbackReplyBtn").click(function(e){
            if($("#feedback-reply-form")[0].checkValidity()){
                let message = $("#message").val();
                e.preventDefault();
                $("#feedbackReplyBtn").val('Please Wait . . . ');

                $.ajax({
                    url: "assets/php/admin-action.php",
                    type: 'post',
                    data: { uid: uid, message, fid: fid},
                    success:function(response){
                        $("#feedbackReplyBtn").val('Send Reply');
                        $("#showReplyModal").modal('hide');
                        $("#feedback-reply-form")[0].reset();
                        Swal.fire(
                            'sent!',
                            'Reply Sent Successfully to the User !',
                            'success'
                        )
                        fetchAllFeedback();

                    }
                });
            }
        });

    });
</script>

</body>
</html>