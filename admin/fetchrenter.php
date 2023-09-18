<?php

if (isset($_POST['userid'])) {
    $useremail = $_POST['userid'];

    session_start();
    require("config.php");
    ////code

    $sql = "SELECT * FROM renter WHERE email LIKE '%$useremail%' OR phone LIKE '%$useremail%'";
    $query = $con->query($sql);
    $output = "";
    if ($query) {
        if ($query->num_rows > 0) {
            // $row = ;
            while ($row = $query->fetch_assoc()) {
                $output .= '<section class="vh-50" style="background-color: #fff;">
                <div class="container py-5 h-50">
                  <div class="row d-flex justify-content-center align-items-center h-50">
                    <div class="col col-md-10 col-lg-8 col-xl-6">
                      <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-2">
                          <div class="d-flex text-black">
                            <div class="flex-shrink-0 p-4">
                              <img src="./user/'.$row['image'].'"
                                alt="Generic placeholder image" class="img-fluid"
                                style="width: 180px; border-radius: 10px;">
                            </div>
                            <div class="flex-grow-1 ms-6">
                              <h5 class="mb-1">'.ucfirst($row['rentertitle'])." ".ucfirst($row['fname'])." ".ucfirst($row['oname']).'</h5>
                              <p class="mb-2 pb-1" style="color: #2b2a2a;">'.$row['email'].'</p>
                              <div class="d-flex justify-content-start rounded-3 p-3 mb-1"
                                style="background-color: #efefef;">
                                <div>
                                  <p class="small text-muted mb-1">Gender</p>
                                  <p class="mb-0">'.ucfirst($row['gender']).'</p>
                                </div>
                                <div class="px-3">
                                  <p class="small text-muted mb-1">DOB</p>
                                  <p class="mb-0">'.$row['dob'].'</p>
                                </div>
                                <div>
                                  <p class="small text-muted mb-1">Phone</p>
                                  <p class="mb-0">'.$row['phone'].'</p>
                                </div>
                              </div>
                              <div class="d-flex justify-content-start rounded-3 p-1 mb-1"
                                style="background-color: #efefef;">
                                <div>
                                  <p class="small text-muted mb-1">State</p>
                                  <p class="mb-0">'.ucfirst($row['renterstate']).'</p>
                                </div>
                                <div class="px-3">
                                  <p class="small text-muted mb-1">City</p>
                                  <p class="mb-0">'.ucfirst($row['rentercity']).'</p>
                                </div>
                              </div>
                              <div class="d-flex justify-content-start rounded-3 p-1 mb-1"
                                style="background-color: #efefef;">
                                <div>
                                  <p class="small text-muted mb-1">Address</p>
                                  <p class="mb-0">'.ucfirst($row['address']).'</p>
                                </div>
                              </div>
                              <div class="d-flex pt-1">
                                <a href="./assignproperty.php?user='.$row['id'].'" class="btn btn-outline-primary me-1 flex-grow-1 allocate" data-rent-id="'.$row['id'].'">Allocate</a>
                                <button type="button" class="btn btn-danger flex-grow-1 deleterenter" data-rent-id="'.$row['id'].'">Delete Renter</button>
                              </div> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>';
            }
            echo $output;
        } else {
            $output .= "No record match your criteria";
            echo $output;
        }
    } else {
        echo $con->error;
    }
}
