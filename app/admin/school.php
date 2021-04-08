<?php
include ("./../../database/config.php");
include ("./../../api/school.php");
?>
<?php
include('./../include/head.php');
?>
<?php
include('./../include/nav.php');
?>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidear -->
            <?php
             include('./../include/sidebar_admin.php')
           ?>
            <!-- Sidebar -->
        </div>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 dash-main">
            <!-- cards -->
            <?php
             include('./../include/card_admin.php')
            ?>
            <!-- cards -->
            <!-- modal button -->
            <div class="card-body mt-2">
                <button class="btn btn-light btn-sm float-right" data-toggle="modal" data-target="#schoolModal"
                    id="add_button">Add
                    School</button>
            </div>
            <br>
            <div class="table-responsive ">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">School Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          get_school($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
        <!-- School modal -->
        <div id="schoolModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form action="" method="post" id="school_form">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title"></h4>

                            <button type="button" class="close" data-dismiss="modal">
                                &times;
                            </button>

                            <div class="alert alert-success alert-dismissible text-center" id="success"
                                style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                            </div>
                            <div class="alert alert-danger alert-dismissible text-center" id="error"
                                style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                            </div>
                        </div>
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="school_name" class="control-label">School:</label>
                                    <input type="text" class="form-control" name="school_name" id="school_name"
                                        placeholder="Enter school name...">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-sm" name="update"
                                id="update">Update</button>
                            <button type="submit" class="btn btn-success btn-sm" name="add" id="add">Add</button>
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- School modal -->
    </div>
    <script>
    $(document).ready(function() {
        $("#add_button").click(function() {
            $("#school_form")[0].reset();
            $("#schoolModal").modal("show");
            $(".modal-title").text("Add school");
            $("#update").hide();
            $("#add").show();
        });


        //add school
        $(document).on("submit", "#school_form", function(event) {
            event.preventDefault();
            
            var school = $('#school_name').val().trim();
            if (school != "") {
                $.ajax({
                    url: "./../../api/school.php",
                    type: "POST",
                    data: {
                        request: 1,
                        school_name: school,
                    },
                    cache: false,
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        if (dataResult.statusCode == 200) {
                            $("#add").removeAttr("disabled");
                            $('#school_form').find('input:text').val('');
                            $("#success").show();
                            $("#success").html('School added').delay(3000).fadeOut(3000);
                            location.reload();
                        } else if (dataResult.statusCode == 201) {
                            $("#error").show();
                            $("#error").html('School exist!').delay(3000).fadeOut(3000);

                        }
                    }
                });
            } else {
                $("#error").show();
                $("#error").html('Please fill all required fields!').delay(3000).fadeOut(3000);
                $("#add").removeAttr("disabled");


            }
        });

        //update school
        $(document).on("click", ".update", function() {
            var id = $(this).data("id");

            $.ajax({
                url: "./../../api/school.php",
                type: "post",
                data: {
                    request: 3,
                    school_id: id
                },
                dataType: "json",
                success: function(dataResult) {
                    //var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        alert("crazy");
                        $("#schoolModal").modal("show");
                        $(".modal-title").text("Edit school");
                        $("#update").show();
                        $("#add").hide();
                        $("#school_name").val(dataResult.data.school_name);
                        location.reload();
                    } else {
                        alert("Invalid ID");
                    }
                }

            })
        })

        // delete school
        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");

            var deleteAction = confirm("Are you sure?");
            if (deleteAction == true) {
                $.ajax({
                    url: "./../../api/school.php",
                    type: "post",
                    cache: false,
                    data: {
                        request: 4,
                        school_id: id
                    },
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {
                            location.reload();

                        }
                    }

                });

            }
        });

    });
    </script>
    <script src="./../../assets/js/popper.min.js"></script>
</body>

</html>