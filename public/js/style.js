function getData(status = "active") {

    let date = "";
    if ($("#dateValue").text() === "") {
        const d = new Date();
        const month = d.getMonth() + 1;
        const day = d.getDate();

        date = d.getFullYear() + '-' +
            (month < 10 ? '0' : '') + month + '-' +
            (day < 10 ? '0' : '') + day;
    } else {
        date = $("#dateValue").text();
    }
    $.ajax({
        url: "/getActiveTask",
        type: "get",
        data: {
            status: status,
            date: date,
        },
        success: function (dataResult) {
            dataResult = renderObjectToHTML(dataResult);
            $("#cardMainDiv").html(dataResult);
        }
    });
}

function renderObjectToHTML(dataResult) {
    let data = "";
    let btn = "";
    if (dataResult.length > 0) {
        for (let i = 0; i < dataResult.length; i++) {

            if (dataResult[i]["status"] === "active") {
                btn = " <div class='card-footer m-0 p-0 '>" +
                    " <button type='button' class='text-white btn btn-warning btn-lg btn-block rounded-0 fw-bold' name='btnFinish'" +
                    "    id='btnFinish' value='" + dataResult[i]['id'] + "' onclick='updateStatus(this.value)'>FINISH" +
                    "   </button>" +
                    "     </div>";
            } else {
                btn = '';
            }

            data += " <div class='card my-2'>" +
                "            <div class='card-header text-center fw-bold'>" +
                "                Date : " + new Date(dataResult[i]["date"]).toDateString() + " " +
                "            </div>" +
                "            <div class='card-body'>" +
                "                <h5 class='card-text'> " + dataResult[i]["task_note"] + "</h5>" +
                "            </div>" + btn +
                "        </div>"
        }
    } else {
        data += " <div class='card my-2'>\n" +
            "            <div class='card-body'>\n" +
            "                <h5 class='card-text text-center'>No Data Found</h5>\n" +
            "            </div>\n" +
            "        </div>"
    }
    return data;
}

function validate(email = null, name = null, contact = null, password = null, confirmPassword = null) {

    const regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    let chk = true;
    if (email != null) {
        if (email === "") {
            $("#errEmail").text("enter email address");
            $("#errEmail").show();
            chk = false;
        } else if (!regex.test(email)) {
            $("#errEmail").text("enter valid email address");
            $("#errEmail").show();
            chk = false;
        } else {
            $("#errEmail").text("");
            $("#errEmail").hide();
            chk = true;
        }
    }

    if (name != null) {
        if (name === "") {
            $("#errName").text("enter name");
            $("#errName").show();
            chk = false;
        } else if ($.isNumeric(name) || /^[a-zA-Z0-9- ]*$/.test(name) == false) {
            $("#errName").text("enter only characters");
            $("#errName").show();
            chk = false;
        } else {
            $("#errName").text("");
            $("#errName").hide();
            chk = true;
        }
    }

    if (contact != null) {
        if (contact == "") {
            $("#errContact").text("enter contact number");
            $("#errContact").show();
            chk = false;
        } else if (!$.isNumeric(contact)) {
            $("#errContact").text("enter contact in digits");
            $("#errContact").show();
            chk = false;
        } else if (contact.length > 10 || contact.length < 10) {
            $("#errContact").text("enter contact in 10 digits");
            $("#errContact").show();
            chk = false;
        } else {
            $("#errContact").text("");
            $("#errContact").hide();
            chk = true;
        }
    }

    if (password != null) {
        if (password === "") {
            $("#errPassword").text("enter password");
            $("#errPassword").show();
            chk = false;
        } else if (password.length > 16 || password.length < 8) {
            $("#errPassword").text("password length must be 8 to 16 characters");
            $("#errPassword").show();
            chk = false;
        } else {
            $("#errPassword").text("");
            $("#errPassword").hide();
            chk = true;
        }
    }

    if (confirmPassword != null) {
        if (confirmPassword === "") {
            $("#errConfirmPassword").text("enter password");
            $("#errConfirmPassword").show();
            chk = false;
        } else if (confirmPassword.length > 16 || confirmPassword.length < 8) {
            $("#errConfirmPassword").text("password length must be 8 to 16 characters");
            $("#errConfirmPassword").show();
            chk = false;
        } else if (confirmPassword !== password) {
            $("#errConfirmPassword").text("password is not match");
            $("#errConfirmPassword").show();
            chk = false;
        } else {
            $("#errConfirmPassword").text("");
            $("#errConfirmPassword").hide();
            chk = true;
        }
    }

    return chk;
}

function getUserData() {
    $.ajax({
        url: "/user",
        type: "get",
        success: function (dataResult) {
            $("#id").val(dataResult.id);
            $("#email").attr("disabled", true);
            $("#email").attr("placeholder", dataResult.email);
            $("#name").attr("placeholder", dataResult.name);
            $("#contact").attr("placeholder", dataResult.contact);
        }
    });
}

/* update status of task */
function updateStatus(id) {
    $.ajax({
        url: "/updateStatus",
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
        },
        cache: false,
        success: function (dataResult) {
            dataResult = JSON.parse(dataResult);
            if (dataResult.status === "success") {
                $("#dialogDiv").removeClass("alert alert-danger m-1");
                $("#dialogDiv").addClass("alert alert-success m-1");
                $("#msg").text(dataResult.message)
                $("#dialogDiv").show();
            } else {
                $("#dialogDiv").removeClass("alert alert-success m-1");
                $("#dialogDiv").addClass("alert alert-danger m-1");
                $("#msg").text(dataResult.message)
                $("#dialogDiv").show();
            }
        },
        complete: function () {
            setTimeout(function () {
                $("#msg").text("");
                $("#dialogDiv").hide();
                getData();
            }, 1000);
        }
    });
}

/* Menu Open Close Start */

$("#btnOpen").click(function () {
    $("#mySidenav").width(250);
});

$("#btnClose").click(function () {
    $("#mySidenav").width(0);
});
/* Menu Open Close End */


/* bottom tab click event start */
$("#todos").on("click", function () {
    if ($("#todos").hasClass("text-dark")) {
        $("#todos").removeClass("text-dark");
        $("#todos").addClass("text-warning");
    }
    $("#finished").removeClass("text-warning");
    $("#finished").addClass("text-dark");
    $("#todos").addClass("text-warning");
    getData();
});

$("#finished").on("click", function () {
    if ($("#finished").hasClass("text-dark")) {
        $("#finished").removeClass("text-dark");
        $("#finished").addClass("text-warning");
    }
    $("#todos").removeClass("text-warning");
    $("#todos").addClass("text-dark");
    getData("finished");
});
/* bottom tab click event end */


/* Register Code start */
$("#btnRegister").on("click", function () {
    let name = $("#name").val();
    let email = $("#email").val();
    let contact = $("#contact").val();
    let password = $("#password").val();
    let confirmPassword = $("#confirmPassword").val();

    let chk = validate(email, name, contact, password, confirmPassword);

    if (chk) {
        $.ajax({
            url: "/registerUser",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                name: name,
                email: email,
                contact: contact,
                password: password,
            },
            cache: false,
            success: function (dataResult) {
                dataResult = JSON.parse(dataResult);
                if (dataResult.status === "success") {
                    $("#dialogDiv").removeClass("alert alert-danger m-1");
                    $("#dialogDiv").addClass("alert alert-success m-1");
                    $("#msg").text(dataResult.message);
                    $("#dialogDiv").show();
                } else if (dataResult.status === "email") {
                    $("#errEmail").text(dataResult.message);
                    $("#errEmail").show();
                } else if (dataResult.status === "error") {
                    $("#dialogDiv").removeClass("alert alert-success m-1");
                    $("#dialogDiv").addClass("alert alert-danger m-1");
                    $("#msg").text(dataResult.message);
                    $("#dialogDiv").show();
                }
            },
            complete: function () {
                setTimeout(function () {
                    $("#name").val("");
                    $("#email").val("");
                    $("#contact").val("");
                    $("#password").val("");
                    $("#confirmPassword").val("");
                    $("#msg").text("");
                    $("#dialogDiv").hide();
                }, 1000);
            }
        });
    }
});
/* Register Code End  */


/* Login Code Start */
$("#btnLogin").on("click", function () {
    let email = $("#email").val();
    let password = $("#password").val();

    let chk = validate(email, password);

    if (chk) {
        $.ajax({
            url: "/loginUser",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                email: email,
                password: password,
            },
            cache: false,
            success: function (dataResult) {
                dataResult = JSON.parse(dataResult);
                if (dataResult.status === "success") {
                    $("#dialogDiv").removeClass("alert alert-danger m-1");
                    $("#dialogDiv").addClass("alert alert-success m-1");
                    $("#msg").text(dataResult.message);
                    $("#dialogDiv").show();
                } else if (dataResult.status === "email") {
                    $("#errEmail").text(dataResult.message);
                    $("#errEmail").show();
                } else if (dataResult.status === "error") {
                    $("#dialogDiv").removeClass("alert alert-success m-1");
                    $("#dialogDiv").addClass("alert alert-danger m-1");
                    $("#msg").text(dataResult.message);
                    $("#dialogDiv").show();
                }
            },
            complete: function () {
                setTimeout(function () {
                    $("#email").val("");
                    $("#password").val("");
                    $("#msg").text("");
                    $("#dialogDiv").hide();
                    location.href = "/";
                }, 1000);
            }
        });
    }
});

/* Login Code End */

/* insert task data start */

$("#btnAddTask").on("click", function () {
    let date = $("#dateValue").text();
    if (date === "") {
        date = formatDate(new Date());
    }
    let task = $("#task").val();

    if (task === "") {
        $("#errTask").text("enter task details");
        $("#errTask").show();
    } else {
        $("#errTask").text("");
        $("#errTask").hide();
    }


    if (task !== "") {
        $.ajax({
            url: "/insertTask",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                date: date,
                task: task,
            },
            cache: false,
            success: function (dataResult) {
                dataResult = JSON.parse(dataResult);
                if (dataResult.status === "success") {
                    $("#dialogDiv").removeClass("alert alert-danger m-1");
                    $("#dialogDiv").addClass("alert alert-success m-1");
                    $("#msg").text(dataResult.message)
                    $("#dialogDiv").show();
                } else {
                    $("#dialogDiv").removeClass("alert alert-success m-1");
                    $("#dialogDiv").addClass("alert alert-danger m-1");
                    $("#msg").text(dataResult.message)
                    $("#dialogDiv").show();
                }
                $("#task").val("");
                $(".taskModal").modal("hide");
            },
            complete: function () {
                setTimeout(function () {
                    $("#msg").text("");
                    $("#dialogDiv").hide();
                    getData();
                }, 1000);
            }
        });
    }
});

/* insert task data end */


/* Update Profile Code start */
$("#btnUpdateProfile").on("click", function () {
    let name = $("#name").val();
    let email = $("#email").val();
    let contact = $("#contact").val();
    let toggle = $('input[type=checkbox]').prop('checked');
    let chk = null;
    let data = null;
    if (toggle === true) {
        let password = $("#password").val();
        let confirmPassword = $("#confirmPassword").val();
        chk = validate(null, name, contact, password, confirmPassword);
        data = {
            name: name,
            email: email,
            contact: contact,
            password: password,
        }
    } else {
        chk = validate(null, name, contact, null, null);
        data = {
            name: name,
            contact: contact,
        }
    }
    if (chk) {
        $.ajax({
            url: "/updateProfile",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            cache: false,
            success: function (dataResult) {
                dataResult = JSON.parse(dataResult);
                if (dataResult.status === "success") {
                    $("#dialogDiv").removeClass("alert alert-danger m-1");
                    $("#dialogDiv").addClass("alert alert-success m-1");
                    $("#msg").text(dataResult.message);
                    $("#dialogDiv").show();
                } else if (dataResult.status === "email") {
                    $("#errEmail").text(dataResult.message);
                    $("#errEmail").show();
                } else if (dataResult.status === "error") {
                    $("#dialogDiv").removeClass("alert alert-success m-1");
                    $("#dialogDiv").addClass("alert alert-danger m-1");
                    $("#msg").text(dataResult.message);
                    $("#dialogDiv").show();
                }
            },
            complete: function () {
                setTimeout(function () {
                    $("#name").val("");
                    $("#email").val("");
                    $("#contact").val("");
                    $("#password").val("");
                    $("#confirmPassword").val("");
                    $("#msg").text("");
                    $("#dialogDiv").hide();
                    location.href = "/";
                }, 1000);
            }
        });
    }
});
/* Update Profile Code End  */

$(document).on("click", function (event) {
    if ($("#mySidenav").width() === 250) {
        $("#mySidenav").width(0);
    }
});

$("#btnFloating").on("click", function () {
    let date = $("#dateValue").text();
    if (date === "") {
        date = new Date().toDateString();
    } else {
        date = new Date(date).toDateString();
    }

    $("#modalDate").text(date);
    $(".taskModal").modal("show");
});

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}

$("#dateIcon").on("click", function () {
    $('#dateModalBody').datepicker({
        format: "yyyy-mm-dd",
        weekStart: 0,
        calendarWeeks: true,
        todayHighlight: true,
        rtl: true,
        orientation: "auto",
        onSelect: function (dateText, inst) {
            let date = $(this).val();
            $("#dateValue2").text(new Date(date).toDateString());
            date = formatDate(date);
            $("#dateValue").text(date);
            setTimeout(function () {
                $("#dateModal").modal("hide");
            }, 500);
            getData();
        }
    });
    $("#dateModal").modal("show");
});



