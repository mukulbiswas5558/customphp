<!-- main.php -->
<div class="container register" style="font-family: 'IBM Plex Sans', sans-serif; margin-top: 100px;">
    <div class="row">
        <div class="col-md-3 register-left" style="margin-top: 10%; right: 5%;">
            <img src="public/images/web_logo.png" alt=""/>
            <h3>Welcome</h3>
        </div>
        <div class="col-md-9 register-right" style="margin-top: 40px; left: 80px;">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist" style="width: 40%;">
                <li class="nav-item">
                    <a class="nav-link active" id="patient-tab" data-toggle="tab" href="#patient" role="tab" aria-controls="patient" aria-selected="true">Patient</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="doctor-tab" data-toggle="tab" href="#doctor" role="tab" aria-controls="doctor" aria-selected="false">Doctor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Admin</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="patient" role="tabpanel" aria-labelledby="patient-tab">
                    <h3 class="register-heading">Register as Patient</h3>
                    <form method="post" action="Registration">
                        <!-- Patient Registration Form Fields -->
                        <div class="form-group">
                            <label for="patientName">Name:</label>
                            <input type="text" class="form-control" id="patientName" name="patientName" required>
                        </div>
                        <div class="form-group">
                            <label for="patientEmail">Email:</label>
                            <input type="email" class="form-control" id="patientEmail" name="patientEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="patientPassword">Password:</label>
                            <input type="password" class="form-control" id="patientPassword" name="patientPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="doctor" role="tabpanel" aria-labelledby="doctor-tab">
                    <h3 class="register-heading">Login as Doctor</h3>
                    <form method="post" action="verifylogin">
                        <!-- Doctor Login Form Fields -->
                        <div class="form-group">
                            <label for="doctorEmail">Email:</label>
                            <input type="email" class="form-control" id="doctorEmail" name="doctorEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="doctorPassword">Password:</label>
                            <input type="password" class="form-control" id="doctorPassword" name="doctorPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                    <h3 class="register-heading">Login as Admin</h3>
                    <form method="post" action="verifylogin">
                        <!-- Admin Login Form Fields -->
                        <div class="form-group">
                            <label for="adminEmail">Email:</label>
                            <input type="email" class="form-control" id="adminEmail" name="adminEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="adminPassword">Password:</label>
                            <input type="password" class="form-control" id="adminPassword" name="adminPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
