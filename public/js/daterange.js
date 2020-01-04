$(document).ready(function() {
    $(".input-daterange").datepicker({
        todayBtn: "linked",
        format: "yyyy-mm-dd",
        autoclose: true
    });

    // CLEANS OBJECT IF VALUES ARE EMPTY
    function clean(o) {
        for (var propName in o) {
            console.log("is it");
            if (o[propName] === "") {
                delete o[propName];
            }
        }
    }
    // TO DISPLAY TODAY's DATE
    var d = new Date();
    var strDate =
        d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + d.getDate();
    $("#to_date").val(strDate);

    // LOAD DATA FUNCTION

    function load_data(
        from_date = "",
        to_date = "",
        name = "",
        surname = "",
        country = "",
        activity = "",
        id = "",
        i = ""
    ) {
        let ajaxUrl = window.location.href;
        var table = $("#order_table").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                //  {
                //  {--url: '{{ route("daterange.index") }}', -- }
                //  }
                url: ajaxUrl,
                data: {
                    from_date: from_date,
                    to_date: to_date,
                    name: name,
                    surname: surname,
                    country: country,
                    activity: activity,
                    id: id,
                    i: 1
                }
            },

            columns: [{
                    render: function(data, type, row) {
                            // return "<a href='"+ window.location.href +"?leadID=" + row.id + "'  >" + row.name  + "</a>"}
                            return `<a data-id='${row.id}'>${row.name}</a>`;
                        }
                        // { return "<a href='/pages/" + row.id + "'>" + row.name + "</a>"}
                },

                {
                    data: "surname",
                    name: "surname"
                },
                {
                    data: "email",
                    name: "email"
                },
                {
                    data: "phoneNumber",
                    name: "phoneNumber"
                },
                {
                    data: "country",
                    name: "country"
                },
                {
                    data: "created_date",
                    name: "created_date"
                }
            ],

            // SET ID ON LOAD
            drawCallback: function(settings) {
                var x;
                let anchorTags = $("tbody").find("a");
                for (x = 0; x < anchorTags.length; x++) {
                    anchorTags[x].setAttribute("id", x);
                }

                anchorTags.click(function() {
                    let url =
                        "/pages/" +
                        this.dataset.id +
                        window.location.search +
                        "&index=" +
                        this.id;
                    window.location.href = url;
                    // window.history.pushState("whatisthis", "Title", window.location.search + "?leadId" + this.id)
                });
            }
        });

        let page = 1;
        if ($(".paginate_button.active").length) {
            page = $(".paginate_button.active").children()[0].dataset.dtIdx;
        }

        let obj = {
            from_date: $("#from_date").val(),
            to_date: $("#to_date").val(),
            name: $("#name").val(),
            surname: $("#surname").val(),
            country: $("#country").val(),
            activity: $("#activity").val(),
            page: page,
            entries: $('select[name="order_table_length"]').val()
        };

        // TO NOT PRINT EMPTY FORMS
        clean(obj);

        // WRITE IT ON THE URL
        var str = "";
        for (var key in obj) {
            if (str != "") {
                str += "&";
            }
            str += key + "=" + encodeURIComponent(obj[key]);
        }
        window.history.pushState("whatisthis", "Title", "/daterange?" + str);
    }

    // LOAD DATA END

    // LOAD IT AGAIN IF REFRESHED
    let search = location.search.substring(1);
    if (!search) {
        // console.log("nothing")
    } else {
        let currentParams = JSON.parse(
            '{"' + search.replace(/&/g, '","').replace(/=/g, '":"') + '"}',
            function(key, value) {
                return key === "" ? value : decodeURIComponent(value);
            }
        );
        $("#from_date").val(currentParams.from_date);
        $("#to_date").val(currentParams.to_date);
        $("#name").val(currentParams.name);
        $("#surname").val(currentParams.surname);
        $("#country").val(currentParams.country);
        $("#activity").val(currentParams.activity);
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
        var name = $("#name").val();
        var surname = $("#surname").val();
        var country = $("#country").val();
        var activity = $("#activity").val();
        load_data(from_date, to_date, name, surname, country, activity);
        // load_data(from_date, to_date, name, surname, country);
    }

    $("#filter").click(function() {
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
        var name = $("#name").val();
        var surname = $("#surname").val();
        var country = $("#country").val();
        var activity = $("#activity").val();
        if (from_date != "" && to_date != "") {
            $("#order_table")
                .DataTable()
                .destroy();
            load_data(from_date, to_date, name, surname, country, activity);
            // load_data(from_date, to_date, name, surname, country);
        } else {
            alert("Both Dates are required");
        }
    });

    $("#refresh").click(function() {
        $("#from_date").val("");
        $("#to_date").val("");
        $("#name").val("");
        $("#surname").val("");
        $("#country").val("");
        $("#order_table")
            .DataTable()
            .destroy();
        $("tbody").empty();
    });
});

function iframePop() {
    alert(this);
}