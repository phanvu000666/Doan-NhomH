 <!-- Logout Modal-->
 <div class="modal fade" id="editProductModal-test" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit product with id = ?</h5>
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
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">PRODUCT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="fproduct" enctype="multipart/form-data">
                    <input type="text" name="ProductID" id="ProductID" hidden>
                    <input type="text" name="Version" id="Version" hidden>
                    <p>
                        <label for="ProductName">
                            Name product
                        </label>
                        <input type="text" name="ProductName" id="ProductName">
                    </p>
                    <p>
                        <label for="Price">
                            Price Prodcut
                        </label>
                        <input type="number" name="Price" id="Price" min="0">
                    </p>
                    <p>
                        <label for="Quantity">`
                            Quantity product
                        </label>
                        <input type="number" name="Quantity" id="Quantity" min="0" max="10">
                    </p>
                    <p>
                        <label for="Description">
                            Description product
                        </label>
                        <textarea name="Description" id="Description"></textarea>
                    </p>
                    <p>
                        <label for="ManufacturerID">
                            Manufacture prodcut
                        </label>
                        <?= $manucontrol->display_manu(); ?>
                    </p>
                    <p>
                        <label for="CategoryID">
                            Category product
                        </label>
                        <?= $catecontrol->display_cate(); ?>
                    </p>
                    <p>
                        <input type="file" name="ImageUrl" id="ImageUrl">
                        <label for="ImageUrl">
                            Photographic
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
            var url = 'index.php';
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
        var url = 'index.php';
        $.ajax({
            url: 'index.php',
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
        $("#ProductID").val("");
        $("#ProductName").val("");
        $("#Price").val("");
        $("#Quantity").val("");
        $("#Description").val("");
        $("#CategoryID").val(0);
        $("#ManufacturerID").val(0);
        $("#Version").val(0);
    }

    function updateForm(values) {
        console.log(values);
        $("#ProductID").val(values.ProductID);
        $("#ProductName").val(values.ProductName);
        $("#Price").val(values.Price);
        $("#Quantity").val(values.Quantity);
        $("#Description").val(values.Description);
        $("#CategoryID").val(values.CategoryID);
        $("#ManufacturerID").val(values.ManufacturerID);
        $("#Version").val(values.Version);
    }

    function editProduct(ProductID) {
        console.log(ProductID);
        var url = 'index.php';
        $.ajax({
            url: url,
            method: 'post',
            data: 'ProductID=' + ProductID,
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