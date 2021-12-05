<!-- Modal form-->
<div class="modal fade" id="editManuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">MANUFACTURE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="fmanu" enctype="multipart/form-data">
                    <input type="text" name="ManufacturerID" id="ManufacturerID" hidden>
                    <input type="text" name="Version" id="Version" hidden>
                    <p>
                        <label for="ManufacturerName">
                            Manufacture name
                        </label><br>
                        <input type="text" name="ManufacturerName" id="ManufacturerName">
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
    // chỉ khởi chạy khi toàn bộ html trang web được tải hết. tính cả dữ liệu lấy từ databse rồi hiểN thị leê.
$(document).ready(function() {

    // trỏ tới giao diệN
    const formSaveButton = document.getElementById('save');
    const manuForm = document.getElementById('fmanu');

    // thực hiệN khi submit form. (dành cho lưu hoặc update)
    formSaveButton.addEventListener('click', function(e) {
        e.preventDefault();
        // khởi tạo dữ lieệ để gửi đi.
        const formData = new FormData();
        const ManufacturerIDElem = document.getElementById(
            'ManufacturerID');
        const VersionElem = document.getElementById('Version');
        const ManufacturerNameElem = document.getElementById(
            'ManufacturerName');
        formData.set("ManufacturerID", ManufacturerIDElem.value);
        formData.set("Version", VersionElem.value);
        formData.set("ManufacturerName", ManufacturerNameElem.value);

        // dùng jquery ajax để gửi dữ lieệ đã chuẩn bị trới trang manufacture.php
        $.ajax({
            url: 'manufacture.php',
            contentType: false,
            processData: false,
            type: 'post',
            data: formData,
            success: function(reponse) {
                // nếu thành công thì kết quả.
                console.log(reponse);
                location.reload();
            },
            error: function(e) {
                // nếu thật bại .
                alert("that bai");
                console.log(e.message);
            }
        });
    });

    // lấy dữ liệU từ đối tượng người dùng click vào.
    function getDataSetManuID(target) {
        // lấy danh sách class dđói tượng người dùng click vào.
        const classList = target?.classList ? target.classList : [];

        // kiểm tra nếu tồn tại class thlì yấ dataset.
        // pảentNode nghiawx là cha của dđói tượng hiện tại đjươc click.
        if (classList.contains('edit-manu')) {
            return target.dataset.manufacturerid;
        } else if (classList.contains('edit-manu-btn')) {
            return target.parentNode.dataset.manufacturerid;
        } else if (classList.contains('edit-manu-i')) {
            return target.parentNode.parentNode.dataset.manufacturerid;
        } else {
            return -1;
        }
    }

    // lấy tất cả class editManuButtons để khi click mình sẽ ladấ dược dataset.
    const editManuButtons = document.querySelectorAll('.edit-manu');

    // khởi tạo sự kiệN click sẽ lâys giá trị dataset.
    editManuButtons.forEach(editButton => {
        editButton.addEventListener('click', function({
            target
        }) {
            const ManufacturerID = getDataSetManuID(target);

            // khởi tạo dữ liệu để thực hieệ lấy dữ liệu từ database.
            const formData = new FormData();
            formData.set('ManufacturerID', ManufacturerID);
            formData.set('GetManuData', 'GetManuData');
            $.ajax({
                url: 'manufacture.php',
                contentType: false,
                processData: false,
                type: 'post',
                data: formData,
                success: function(reponse) {
                    // destruct trong javascript. tách dđói tượng tách dữ liuệ trong javascript ES6
                    const {
                        ManufacturerID,
                        ManufacturerName,
                        Version
                    } = JSON.parse(reponse);

                    // trỏ tới dđói tuượg trên form.
                    const ManufacturerIDElem = document.getElementById(
                        'ManufacturerID');
                    const VersionElem = document.getElementById('Version');
                    const ManufacturerNameElem = document.getElementById(
                        'ManufacturerName');

                        // gán cho giá trị trên form.
                    ManufacturerIDElem.value = ManufacturerID;
                    VersionElem.value = Version;
                    ManufacturerNameElem.value = ManufacturerName;

                },
                error: function(e) {
                    alert("that bai");
                    console.log(e.message);
                }
            });
            console.log(ManufacturerID);
        });
    });

    const addManuBtn = document.getElementById('add-manu-btn');
    // click vào nút add thì load lại form, tránh lỗi dữ lieệ cũ khi click vào nút update bất kỳ.
    addManuBtn.addEventListener('click', function(e) {
        e.preventDefault();
        while (manuForm.firstChild) {
            manuForm.removeChild(manuForm.firstChild);
      }
      manuForm.innerHTML = `
            <input type="text" name="ManufacturerID" id="ManufacturerID" hidden>
                    <input type="text" name="Version" id="Version" hidden>
                    <p>
                        <label for="ManufacturerName">
                            Manufacture name
                        </label><br>
                        <input type="text" name="ManufacturerName" id="ManufacturerName">
                    </p>
            `;
    });
})
</script>