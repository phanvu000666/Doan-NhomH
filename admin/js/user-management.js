
window.addEventListener('DOMContentLoaded', () => {





  //########################  xử lý màn hình khi co giản. ######################## 

  /**
  * 
  * @param {Number} windowInnerWidth 
  * @param {Element} element 
  */
  function flexDirectionCardHeaderUserManagement(
    windowInnerWidth = 0,
    element = Element,
    FIX_WIDTH = 0
  ) {
    try {
      const FIX_DIRECTION_ROW = "row";
      const FIX_DIRECTION_COLUMN_REVERSE = "column-reverse";

      if (Number.isInteger(windowInnerWidth)) {
        window.innerWidth <= FIX_WIDTH ?
          element.style.flexDirection = FIX_DIRECTION_COLUMN_REVERSE
          : element.style.flexDirection = FIX_DIRECTION_ROW;
      } else {
        console.log(new Error('window.innerWidth is not a number'));
      }
    } catch (error) {
      console.log(error.message);
    }
  }
  const cardHeaderUserManagement =
    document.querySelector('#card_header-user_management');
  const userHandles = document.querySelectorAll('.user-handle');
  const delete_users = document.querySelectorAll('.delete_user');
  const FIX_WIDTH_1 = 543;
  const FIX_WIDTH_2 = 743;

  window.addEventListener('resize', function (e) {

    //
    flexDirectionCardHeaderUserManagement(
      Number(e.target.innerWidth),
      cardHeaderUserManagement,
      FIX_WIDTH_1
    );
    //
    userHandles.forEach(userHandle => {
      flexDirectionCardHeaderUserManagement(
        Number(e.target.innerWidth),
        userHandle,
        FIX_WIDTH_2
      );
    });
    // delete_user button width: 100%
    delete_users.forEach(delete_user => {
      if (Number(e.target.innerWidth) < FIX_WIDTH_2) {
        delete_user.style.width = '100%';
      }
    });
  });

  window.addEventListener('load', function () {
    //
    flexDirectionCardHeaderUserManagement(
      window.innerWidth,
      cardHeaderUserManagement,
      FIX_WIDTH_1
    );
    //
    userHandles.forEach(userHandle => {
      flexDirectionCardHeaderUserManagement(
        window.innerWidth,
        userHandle,
        FIX_WIDTH_2
      );
    });
    // delete_user button width: 100%
    delete_users.forEach(delete_user => {
      if (window.innerWidth < FIX_WIDTH_2) {
        delete_user.style.width = '100%';
      }
    });
  });





  // ######################## Create new User. ######################## 
  const formBodyUserModelInfo =
    document.querySelector('#formUserModelInfo .modal-body');

  const btnAddUser = document.querySelector('#btn-add-user');

  const formUserModelInfo =
    document.querySelector('#formUserModelInfo');


  btnAddUser.addEventListener('click', async function (e) {
    const data = {
      action: "get"
    }
    const response = await fetch(
      '/admin/user-management-page',
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      });
    const result = await response.json();
    if (result.success === true) {

      while (formBodyUserModelInfo.firstChild) {
        formBodyUserModelInfo.removeChild(formBodyUserModelInfo.firstChild);
      }
      formBodyUserModelInfo.innerHTML = result.data;
    }
  });


  formUserModelInfo.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);

    const FullName = formData.get('FullName');
    const UserName = formData.get('UserName')
    const PassWord = formData.get('PassWord')
    const Email = formData.get('Email')
    const GroupName = formData.get('GroupName')
    const action = formData.get('action')

    const data = {
      FullName,
      UserName,
      PassWord,
      Email,
      GroupName,
      action
    }

    if (action === 'edit') {
      data.UserID = formData.get('UserID')
      data.Version = formData.get('Version')
    }

    const response = await fetch(
      '/admin/user-management-page', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    });
    const result = await response.json();

    if (result.success === false) {
      const alertWarningUserModelInfo =
        document.querySelector('#alertWarningUserModelInfo');

      alertWarningUserModelInfo.innerHTML = result.message;
      alertWarningUserModelInfo.classList.add('alert-warning');
      setTimeout(() => {
        alertWarningUserModelInfo.classList.remove('alert-warning');
        alertWarningUserModelInfo.innerHTML = '';
      }, 3000);
    } else if (result.success === true) {
      // load dữ liệu lên giao diện không reload lại trang.

      // reload lại trang.
      window.location.reload();
    }
  });





  // ######################## Update User. ######################## 


  function getDataSetUserID(target) {
    const classList = target?.classList ? target.classList : [];
    if (classList.contains('update_user')) {
      return target.dataset.uid;
    }
    else if (classList.contains('update_user_icon')) {
      return target.parentNode.dataset.uid;
    }
    else if (classList.contains('update_user_icon_i')) {
      return target.parentNode.parentNode.dataset.uid;
    } else {
      return -1;
    }
  }

  async function getAndShowSingleUserByID(UserID) {
    const data = {
      UserID,
      action: "get"
    }
    const response = await fetch(
      '/admin/user-management-page',
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      });
    const result = await response.json();
    if (result.success === true) {

      while (formBodyUserModelInfo.firstChild) {
        formBodyUserModelInfo.removeChild(formBodyUserModelInfo.firstChild);
      }
      formBodyUserModelInfo.innerHTML = result.data;
    }
  }

  const update_user = document.querySelectorAll('.update_user');
  update_user.forEach(async (element) => {
    element.addEventListener('click', ({ target }) => {
      const userID = getDataSetUserID(target);
      if (userID !== -1) {
        getAndShowSingleUserByID(userID);
      }
    });
  });





});


