function Services() {
    var table, services_id = 0, tableSpecial;
    this.init = function () {
        table = this.table();
        $("#btnNew").click(this.new);
        $("#btnSave").click(this.save);
        $("#tabManagement").click(function () {
            $(".input-services").val("");
            $('#myTabs a[href="#management"]').tab('show');
        });

        $("#modalImage").click(function () {
            $("#input-700").fileinput({
                uploadUrl: "services/upload", // server upload action
                uploadAsync: true,
                maxFileCount: 5,
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
                uploadExtraData: {
                    id: $("#frm #id").val()
                },
            }).on('fileuploaded', function (event, data, id, index) {
                $("#modalUpload").modal("hide");

                obj.showImages(data.extra.id);
            })

            $("#modalUpload").modal("show");
        })

        $("#tabList").click(function () {
            table.ajax.reload();
        });

        $("#tabManagement").click(function () {
            $(".input-services").cleanFields({disabled: true});
        });

        $("#tabSpecial").click(function () {
            $(".input-special").cleanFields();
            tableSpecial = obj.tableSpecial($("#frm #id").val());
        })

        $("#btnNewSpecial").click(this.newSpecial);
        $("#btnSaveSpecial").click(this.saveSpecial);

        $("#btnUpload").click(this.uploadExcel)
        $("#btnUpload_code").click(this.uploadExcelCode)
    }

    this.uploadExcel = function () {
        var formData = new FormData($("#frmFile")[0]);

        $.ajax({
            url: 'services/uploadExcel',
            method: 'POST',
            data: formData,
            dataType: 'JSON',
            processData: false,
            cache: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                obj.setDetailExcel(data.data)
            }
        })

    }
    this.uploadExcelCode = function () {
        var formData = new FormData($("#frmFileCode")[0]);

        $.ajax({
            url: 'services/uploadExcelCode',
            method: 'POST',
            data: formData,
            dataType: 'JSON',
            processData: false,
            cache: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                obj.setDetailExcel(data.data)
            }
        })

    }

    this.setDetailExcel = function (detail) {
        var html = "";
        $.each(detail, function (i, val) {
            html += "<tr><td>" + val.description + "</td></tr>";
        })
        $("#tblUpload tbody").html(html);
    }

    this.new = function () {
        $(".input-services").cleanFields();
    }
    this.newSpecial = function () {
        $(".input-special").cleanFields();
    }

    this.showImages = function (id) {
        $.ajax({
            url: 'services/getImages/' + id,
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                obj.printImages(data);
            }
        })
    }

    this.printImages = function (data) {
        var html = '';
        $.each(data, function (i, val) {

            html += '<div class="col-sm-6 col-lg-3" id="div_' + val.id + '">' +
                    '<div class="thumbnail" style="height:auto">' +
                    '<img src="/images/services/' + val.path + '" alt="Product">' +
                    '<div class="caption">' +
                    '<h4>Check Main <input type="radio" name="main[]" onclick=obj.checkMain(' + val.id + ',' + val.id + ')></h4>' +
//                    '<p><button type="button" class="btn btn-primary btn-xs" aria-label="Left Align" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>' +
                    '<p>' +
                    '<button type="button" class="btn btn-danger btn-xs" onclick=obj.deleteImage(' + val.id + ',' + val.id + ')><span class="glyphicon glyphicon-remove" aria-hidden="true" ></span></button>' +
                    '</p>' +
                    '</div></div></div>';
        })

        $("#contentImages").html(html);
    }

    this.checkMain = function (id, services_id) {
        var obj = {};
        obj.services_id = services_id;
        $.ajax({
            url: 'services/checkmain/' + id,
            method: 'PUT',
            data: obj,
            dataType: 'JSON',
            success: function (data) {
                $("#imageMain").attr("src", "/images/services/" + data.path.path);
            }
        })
    }

    this.deleteImage = function (id, services_id) {
        $("#div_" + id).remove();
        var obj = {};
        obj.services_id = services_id;
        $.ajax({
            url: 'services/deleteImage/' + id,
            method: 'DELETE',
            data: obj,
            dataType: 'JSON',
            success: function (data) {
                toastr.success("Image Deleted")
//                $("#imageMain").attr("src", "/images/services/" + data.path.path);
            }
        })
    }

    this.save = function () {
        toastr.remove();
        var frm = $("#frm"), elem;
        var data = frm.serialize();
        var url = "", method = "";
        var id = $("#frm #id").val();
        var msg = '';

        var validate = $(".input-services").validate();

        if (validate.length == 0) {
            if (id == '') {
                method = 'POST';
                url = "services";
                msg = "Registro Creado";
            } else {
                method = 'PUT';
                url = "services/" + id;
                msg = "Registro Editado";
            }

            elem = $("#frm #reference");

            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'JSON',
                beforeSend: function () {
                    $("#loading-super").removeClass("hidden");
                },
                success: function (data) {
                    if (data.success == true) {
                        table.ajax.reload();
                        $(".input-services").setFields({data: data.header});
                        $("#error_" + elem.attr("id")).remove();
                        elem.removeClass("error");
                        elem.parent().parent().removeClass("has-error")
                        toastr.success(msg);
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    if (xhr.responseJSON.reference) {
                        elem.addClass("error");
                        elem.after('<small class="help-block" id="error_' + elem.attr("id") + '" data-fv-validator="notEmpty" data-fv-for="firstName" data-fv-result="INVALID" style="">' + elem.attr("id") + ' already exists</small>')
                        elem.parent().parent().addClass("has-error")
                    }
                },
                complete: function () {
                    $("#loading-super").addClass("hidden");
                }
            })
        } else {

            toastr.error("Fields Required!");
        }
    }
    this.saveSpecial = function () {
        toastr.remove();
        var frm = $("#frmSpecial");
        $("#frmSpecial #services_id").val($("#frm #id").val());
        var data = frm.serialize();
        var url = "", method = "";
        var id = $("#frmSpecial #id").val();

        var msg = '';

        var validate = $(".input-special").validate();

        if (validate.length == 0) {
            if (id == '') {
                method = 'POST';
                url = "services/StoreSpecial";
                msg = "Created Record";
            } else {
                method = 'PUT';
                url = "services/UpdateSpecial/" + id;
                msg = "Edited Record";
            }

            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'JSON',
                success: function (data) {
                    if (data.success == 'true') {
                        tableSpecial.ajax.reload();
                        toastr.success(msg);
                    }
                }
            })
        } else {

            toastr.error("Fields Required!");
        }
    }

    this.showModal = function (id) {

        var frm = $("#frm");
        var data = frm.serialize();
        var url = "/services/" + id + "/edit";
        $.ajax({
            url: url,
            method: "GET",
            data: data,
            dataType: 'JSON',
            success: function (data) {
                $('#myTabs a[href="#management"]').tab('show');
                $(".input-services").cleanFields();
                
                if ($("#role_id").val() == 1) {
                    $(".input-services").setFields({data: data.header});
                } else {
                    
                    $(".input-services").setFields({data: data.header, disabled: true});
                }

                if (data.header.image != null) {
                    $("#imageMain").attr("src", "/images/services/" + data.header.image);
                }
                obj.printImages(data.images);
            }
        })
    }

    this.delete = function (id) {
        toastr.remove();
        if (confirm("Deseas eliminar")) {
            var token = $("input[name=_token]").val();
            var url = "/services/" + id;
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': token},
                method: "DELETE",
                dataType: 'JSON',
                success: function (data) {
                    if (data.success == 'true') {
                        table.ajax.reload();
                        toastr.warning("Ok");
                    }
                }, error: function (err) {
                    toastr.error("No se puede borrra Este registro");
                }
            })
        }
    }

    this.table = function () {
        return $('#tblProducts').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "/api/listServices",
            scrollX: true,
            columns: [
                {data: "id", sWidth: "50px"},
                {data: "reference", sWidth: "100px"},
                {data: "title", sWidth: "400px"},
                {data: "tax"},
                {data: "price_sf"},
                {data: "status"},
                {data: "id"},
            ],
            order: [[1, 'ASC']],
            aoColumnDefs: [
                {
                    aTargets: [0, 1, 2, 3, 4, 5],
                    mRender: function (data, type, full) {
                        return '<a href="#" onclick="obj.showModal(' + full.id + ');return false";>' + data + '</a>';
                    }
                },
                {
                    targets: [6],
                    searchable: false,
                    mData: null,
                    mRender: function (data, type, full) {
                        return '<button class="btn btn-danger btn-xs" onclick="obj.delete(' + full.id + ')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
                    }
                }
            ],
        });
    }
}

var obj = new Services();
obj.init();
