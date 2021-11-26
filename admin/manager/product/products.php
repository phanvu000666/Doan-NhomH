<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
    <a href="#add-new-product" class="btn btn-primary btn-icon-split ms-auto
    d-flex justify-content-between align-items-center">
      <svg width="20" height="20" fill="currentColor" class="bi bi-plus-circle ml-1" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
      </svg>
      <span class="text" data-toggle="modal" data-target="#editProductModal">Thêm sản phẩm mới.</span>
    </a>
  </div>

  <table id="project-table">
    <?= $phonecontrol->display_products() ?>
  </table>

</div>