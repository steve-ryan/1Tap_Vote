<!DOCTYPE html>

<html>

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
            <div class="card mt-2">
                <form action="#" class="py-4">

                    <div class="form-row mx-4">
                        <div class="col-lg-8">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" >
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="emailAddress">Email</label>
                                    <input type="email" class="form-control" id="emailAddress">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="userProfile">Avatar</label>
                                    <input type="file" class="form-control" id="userProfile" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            
                            <div class="edit-user-details__avatar m-auto">
                                <img src="certificate.jpeg" width="120px" height="80px" class="btn btn-sm btn-white d-table mx-auto mt-4" alt="User Avatar">
                            </div>
                            <button type="submit" class="btn btn-sm btn-white d-table mx-auto mt-4">
                                Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>

        </main>
    </div>
    <script src="./../../assets/js/popper.min.js"></script>
</body>

</html>