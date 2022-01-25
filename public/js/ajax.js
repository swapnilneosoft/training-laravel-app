
// User search api
$("#userSearch").on("keypress", function () {
    var inpt = $(this).val();
    var tbody = $("#tbody");
    if (inpt != '') {
        tbody.html("");
        $.ajax(`/admin/user/search/${inpt}`, {
            type: "GET",

            success: function (data) {
                if (data != '') {
                    data.forEach((element, index) => {
                        tbody.append(`
                           <tr>
                                    <td></td>
                                    <td>${element['firstname'] + ' ' + element['lastname']}</td>
                                    <td>
                                        ${element['email']}
                                    </td>
                                    <td>
                                    <a href="/admin/status-user/${element['id']}" class="badge  ${element['status'] == 1 ? 'bg-success' : 'bg-danger'}">
                                            ${element['status'] == 1 ? 'Active' : 'Inactive'}
                                        </a>
                                    </td>
                                    <td>
                                        ${element['role']}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger delete-user" data-toggle="modal" data-target="#modal${element['id']}default">Delete</button>
                                        <a href="/admin/update-user/${element['id']}" class="btn btn-info">Update</a>

                                        <div class="modal fade" id="modal${element['id']}default">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h4 class="modal-title">Default Modal</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                <p class="text-danger">If you are going to delete yourself then you will loose all data !!!</p>
                                                <p>Are You confirm to delete ?</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <a href="/admin/delete-user/${element['id']}" class="btn btn-danger">Confirm Delete</a>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </td>
                            </tr>
                           `);

                    });
                } else {
                    tbody.append(
                        `
                                    <tr class="text-secondary">
                                        <td style="width:100%;text-align:center;">No Data Found</td>
                                    </tr>
                                `
                    );
                }
            }
        });
    } else {
        tbody.html("");
    }
});
// Category search api
$("#categorySearch").on("keypress", function () {
    var inpt = $(this).val();
    var tbody = $("#tbody");
    if (inpt != '') {
        tbody.html("");
        $.ajax(`/admin/category/search/${inpt}`, {
            type: "GET",

            success: function (data) {
                if (data != '') {
                    data.forEach((element, index) => {
                        tbody.append(`
                           <tr>
                                    <td></td>
                                    <td>${element['name']}</td>


                                    <td>
                                        <button type="button" class="btn btn-danger delete-user" data-toggle="modal" data-target="#modal${element['id']}default">Delete</button>
                                        <a href="/admin/update-category/${element['id']}" class="btn btn-info">Update</a>

                                        <div class="modal fade" id="modal${element['id']}default">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h4 class="modal-title">Default Modal</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                <p class="text-danger">If you are going to delete yourself then you will loose all data !!!</p>
                                                <p>Are You confirm to delete ?</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <a href="/admin/delete-category/${element['id']}" class="btn btn-danger">Confirm Delete</a>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </td>
                            </tr>
                           `);

                    });
                } else {
                    tbody.append(
                        `
                                    <tr class="text-secondary">
                                        <td style="width:100%;text-align:center;">No Data Found</td>
                                    </tr>
                                `
                    );
                }
            }
        });
    } else {
        tbody.html("");
    }
});
// get sub category api
$("#categpry").on("change", function () {
    var category_id = $(this).val();
    $.ajax(`/admin/get-subcategory/${category_id}`, {
        type: "GET",
        success: function (data) {
            var subCatDrop = $('#subCatDrop');
            subCatDrop.html(``);
            data.forEach(element => {
                subCatDrop.append(`
                       <input type="checkbox" value="${element['id']}" name="sub_category_id[]" id="xyq${element['name']}hfsd">
                       <label for="xyq${element['name']}hfsd" >${element['name']}</label>
                       `);
            });
        }
    });
});
