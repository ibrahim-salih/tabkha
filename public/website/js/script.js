$(document).ready(function () {
    $("#country").on("change", function () {
        var countryId = this.value;
        $("#state").html("");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
            },
            // url: '{{ route("dashboard.lowyers.getStates") }}?country=' + countryId,
            url: "/getStates",
            data: {
                country: countryId,
            },
            type: "post",
            success: function (res) {
                // return res;
                $("#state").html('<option value=""> المدينة</option>');
                $.each(res, function (key, value) {
                    $("#state").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.name +
                            "</option>"
                    );
                });
            },
        });
    });
    $("#state").on("change", function () {
        var countryId = this.value;
        $("#state").html("");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
            },
            // url: '{{ route("dashboard.lowyers.getStates") }}?country=' + countryId,
            url: "/getCities",
            data: {
                country: countryId,
            },
            type: "post",
            success: function (res) {
                // return res;
                $("#city").html('<option value=""> الحى</option>');
                $.each(res, function (key, value) {
                    $("#city").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.name +
                            "</option>"
                    );
                });
            },
        });
    });
    //////////ENDS///////////////////
});
