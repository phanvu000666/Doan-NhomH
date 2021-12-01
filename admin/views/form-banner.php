 <!-- Logout Modal-->
 <div class="modal fade" id="editBannerModal-test" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit banner with id = ?</h5>
         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">
         Thêm input và form trong này để thực hiện chỉnh sửa sản phẩm.
       </div>
       <div class="modal-footer">
         <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
         <a class="btn btn-primary" href="login.html">Submit</a>
       </div>
     </div>
   </div>
 </div>
 <!-- Modal form--> 
<div class="modal fade" id="editBannerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="fproduct" enctype="multipart/form-data">
                    <input type="text" name="BannerId" id="BannerId" hidden>
                    <p>
                        <label for="BannerTitle">
                            Title Banner
                        </label>
                        <input type="text" name="BannerTitle" id="BannerTitle">
                    </p>
                    <p>
                        <label for="BannerSubTitle">
                            SubTitle Banner
                        </label>
                        <input type="text" name="BannerSubTitle" id="BannerSubTitle">
                    </p>
                    <p>
                        <input type="file" name="BannerImage" id="BannerImage">
                        <label for="BannerImage">
                        Image of Banner
                        </label>
                    </p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save" data-toggle="modal">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal notification -->
<div class="modal fade" id="notification-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
 <script type="text/javascript">
    $(document).ready(function() {
        const save = document.getElementById('save');
        const form = document.getElementById('fproduct');
        $('#overlay').fadeIn().delay(2000).fadeOut();
        // event
        save.addEventListener("click", function() {
            var formData = new FormData(form);
            var url = 'slider.php';
            $.ajax({
                url: url,
                contentType: false,
                processData: false,
                type: 'post',
                data: formData,
                success: function(reponse) {
                    console.log(reponse);
                    setTimeout(function() {
                        // clearForm();
                        // callGetContentTable();
                        location.reload();
                    }, 500);

                },
                error: function(e) {
                    alert("that bai");
                    console.log(e.message);
                }
            });
        });
        // $(".edit-data").on('click', function(event) {
        //     var ProductID = this.getAttribute('id');
        //     console.log(ProductID);
        //     var url = 'index.php';
        //     $.ajax({
        //         url: url,
        //         method: 'post',
        //         data: 'ProductID=' + ProductID,
        //         success: function(reponse) {
        //             setTimeout(function() {
        //                 if (IsJsonString(reponse)) {
        //                     var obj = JSON.parse(reponse.toString());
        //                     updateForm(obj);
        //                 }
        //             }, 500);
        //         },
        //         error: function(e) {
        //             alert("that bai");
        //             console.log(e.message);
        //         }
        //     });
        // });
    })

    function callGetContentTable() {
        var url = 'slider.php';
        $.ajax({
            url: 'slider.php',
            type: 'post',
            dataType: 'text',
            data: {
                key: 'content'
            },
            success: function(reponse) {
                console.log(reponse);
                // $("#product-table > thead").remove();
                // $("#product-table > tbody").remove();
                // //add
                // $("#product-table").append(reponse);
                $("body").remove();
                $("html").append(reponse);
            },
            error: function(e) {
                alert("that bai");
                console.log(e.message);
            }
        });
    }

    function IsJsonString(str) {
        try {
            var obj = JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

    function clearForm() {
         $("#BannerId").val("");
        $("#BannerImage").val("");
        $("#BannerTitle").val("");
        $("#BannerSubTitle").val("");
    }

    function updateForm(values) {
        console.log(values);
        $("#BannerId").val(values.BannerId);
        $("#BannerTitle").val(values.BannerTitle);
        $("#BannerSubTitle").val(values.BannerSubTitle);
        $("#BannerImage").val(values.BannerImage);
    }

    function editBanner(BannerId) {
        console.log(BannerId);
        var url = 'slider.php';
        $.ajax({
            url: url,
            method: 'post',
            data: 'BannerId=' + BannerId,
            success: function(reponse) {
                setTimeout(function() {

                    if (IsJsonString(reponse)) {
                        var obj = JSON.parse(reponse.toString());
                        updateForm(obj);
                    }
                }, 500);
            },
            error: function(e) {
                alert("that bai");
                console.log(e.message);
            }
        });
    }
</script>