function Locations() {
    var table;
    this.init = function () {
        table = this.table();
        $("#new").click(this.save);
        $("#edit").click(this.edit);
        $("#btnNew").click(function () {
            $(".input-locations").cleanFields();
            $("#courses").val(0).trigger('change');
            $("#modalNew").modal("show");
        });

        $('#courses').select2();

        $('.hours').datetimepicker({
            datepicker: false,
            format: 'H:i'
        });

    }

    this.save = function () {
        toastr.remove();
        var frm = $("#frm");
        var data = frm.serialize();
        var url = "", method = "";
        var id = $("#frm #id").val();
        var msg = '';

        var validate = $(".input-locations").validate();

        if (validate.length == 0) {
            if (id == '') {
                method = 'POST';
                url = "locations";
                msg = "Created Record";
            } else {
                method = 'PUT';
                url = "locations/" + id;
                msg = "Edited Record";
            }


            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'JSON',
                success: function (data) {
                    if (data.success == true) {
                        $("#modalNew").modal("hide");
                        $(".input-locations").setFields({data: data});
                        table.ajax.reload();
                        toastr.success(msg);
                    }
                }
            })
        } else {
            toastr.error("Fields Required!");
        }
    }

    this.show = function (id) {
        var frm = $("#frmEdit");
        var data = frm.serialize();
        var url = "/locations/" + id + "/edit";
        
        $.ajax({
            url: url,
            method: "GET",
            data: data,
            dataType: 'JSON',
            success: function (data) {
                $("#modalNew").modal("show");
                $(".input-locations").cleanFields();
                $(".input-locations").setFields({data: data});
                $("#courses").val(data.courses).trigger('change');
                $.each(data.days, function (i, val) {
                    $(".hours").each(function () {
                       
                        if ($(this).attr("id") == "init_" + val.day) {
                            $($(this).val(val.init));
                        }
                        if ($(this).attr("id") == "end_" + val.day) {
                            $($(this).val(val.init));
                        }
                    });
                })

            }
        })
    }

    this.delete = function (id) {
        toastr.remove();
        if (confirm("Deseas eliminar")) {
            var token = $("input[name=_token]").val();
            var url = "/locations/" + id;
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': token},
                method: "DELETE",
                dataType: 'JSON',
                success: function (data) {
                    if (data.success == true) {
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
        return $('#tbl').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/api/listLocations",
            columns: [
                {data: "id"},
                {data: "description"},
                {data: "phone"},
                {data: "address"},
                {data: "latitude"},
                {data: "longitude"},
                {data: "order"},
                {data: "status_id"}
            ],
            order: [[1, 'ASC']],
            aoColumnDefs: [
                {
                    aTargets: [0, 1, 2, 3],
                    mRender: function (data, type, full) {
                        return '<a href="#" onclick="obj.show(' + full.id + ')">' + data + '</a>';
                    }
                },
                {
                    targets: [8],
                    searchable: false,
                    mData: null,
                    mRender: function (data, type, full) {
                        return '<button class="btn btn-danger btn-xs" onclick="obj.delete(' + data.id + ')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
                    }
                }
            ],
        });
    }

}

var obj = new Locations();
obj.init();