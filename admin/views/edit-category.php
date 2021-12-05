<!-- Modal form-->
<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="" id="formCateInfo" enctype="multipart/form-data">
                    <input type="text" name="CategoryID" id="CategoryID" hidden>
                    <input type="text" name="Version" id="Version" hidden>
                    <p>
                        <label for="ProductName">
                            Name category
                        </label>
                        <input type="text" name="CategoryName" id="CategoryName">
                    </p>
                    <p>
                        <label for="Price">
                            Position category
                        </label>
                        <input type="number" name="Position" id="Position" min="0">
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
<script type="text/javascript">
    $(document).ready(function() {

        // +========================= new code +=========================  //
        const deletecategory = document.querySelectorAll(".deletecategory");
        const editcategory = document.querySelectorAll(".edit-category");
        const savebutton = document.querySelector("#save");
        const formcateinfo = document.querySelector("#formCateInfo");
        const addmanubutton = document.querySelector("#add-manu-btn");

        deletecategory.forEach((element) => {
            element.addEventListener('click', e => {
                // lay gia tri (tu dataset)
                const id = e.target.dataset.cateid;
                const formData = new FormData();
                formData.set('id', id);
                formData.set('action', "delete");

                // xu ly ajax gui yeu cau xoa category
                $.ajax({
                    url: "category",
                    contentType: false,
                    processData: false,
                    type: 'post',
                    data: formData,
                    success: function(reponse) {
                        const {
                            success,
                            message
                        } = JSON.parse(reponse);

                        if (success) {
                            location.reload();
                        } else {
                            console.log(message);
                        }
                    },
                    error: function(e) {
                        alert("that bai");
                        console.log(e.message);
                    }
                });
            });
        });

        editcategory.forEach((element) => {
            element.addEventListener('click', e => {
                // lay gia tri (tu dataset)
                const id = e.target.dataset.cateid;
                const formData = new FormData();
                formData.set('id', id);
                formData.set('action', "getone");

                // xu ly ajax gui yeu cau xoa category
                $.ajax({
                    url: "category",
                    contentType: false,
                    processData: false,
                    type: 'post',
                    data: formData,
                    success: function(reponse) {
                        const {
                            success,
                            message,
                            data
                        } = JSON.parse(reponse);

                        console.log(reponse);
                        // hien thi dux lieu len form.
                        if (success) {

                            // tro toi doi tuong tren form khi co du lieu
                            const InputCategoryID = document.querySelector('#CategoryID');
                            const InputCategoryName = document.querySelector('#CategoryName');
                            const InputPosition = document.querySelector('#Position');
                            const InputVersion = document.querySelector('#Version');

                            // gan du lieu tu database len form.
                            InputCategoryID.value = data.CategoryID;
                            InputCategoryName.value = data.CategoryName;
                            InputPosition.value = data.Position;
                            InputVersion.value = data.Version;
                        }
                    },
                    error: function(e) {
                        alert("that bai");
                        console.log(e.message);
                    }
                });
            });
        });

        savebutton.addEventListener('click', function() {
            const formData = new FormData();
            const InputCategoryID = document.querySelector('#CategoryID');
            const InputCategoryName = document.querySelector('#CategoryName');
            const InputPosition = document.querySelector('#Position');
            const InputVersion = document.querySelector('#Version');

            formData.set("CategoryName", InputCategoryName.value);
            formData.set("Position", InputPosition.value);

            // category id va version rỗng thi thuc hien cong viec them.
            // category id va version không rỗng thi thuc hien cong viec chinh sua.
            if (InputCategoryID.value === "" && InputVersion.value === "") {
                formData.set("action", "add");
            } else {
                formData.set("Version", InputVersion.value);
                formData.set("CategoryID", InputCategoryID.value);
                formData.set("action", "update");
            }

            // xu ly ajax gui yeu cau xoa category

            
            $.ajax({
                url: "category",
                contentType: false,
                processData: false,
                type: 'post',
                data: formData,
                success: function(reponse) {
                    const {
                        success,
                        message
                    } = JSON.parse(reponse);

                    if (success) {
                        location.reload();
                    } else {
                        console.log(message);
                    }
                },
                error: function(e) {
                    alert("that bai");
                    console.log(e.message);
                }
            });
        });

        // thuc hien tao moi lai form nhap lieu
        addmanubutton.addEventListener('click', () => {
            while (formcateinfo.firstChild) {
                formcateinfo.removeChild(formcateinfo.firstChild);
            }
            formcateinfo.innerHTML = `
                <input type="text" name="CategoryID" id="CategoryID" hidden>
                <input type="text" name="Version" id="Version" hidden>
                <p>
                    <label for="ProductName">
                        Name category
                    </label>
                    <input type="text" name="CategoryName" id="CategoryName">
                </p>
                <p>
                    <label for="Price">
                        Position category
                    </label>
                    <input type="number" name="Position" id="Position" min="0">
                </p>
            `;
        });


        // ket thuc
    });
</script>