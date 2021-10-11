<?php //check config
include 'config.php';

//Validasi Karakter
function validate($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
  }
  
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form name="rsvp1" id="rsvp1" method="POST" target="rsvp.php">
                     <div class="form-group">
                        <label>Your Name</label>
                        <input name="name" id="name" type="text" class="form-control form-control-lg" value="{WEDDING_TO}" placeholder="Your name">
                     </div>
                     <div class="form-group">
                        <label>Your Section</label>
                        <input name="sesi" id="sesi" type="text" class="form-control form-control-lg" value ='{WEDDING_SECTION}' placeholder="Your Section">
                     </div>
                     <div class="form-group">
                        <label>Email Address</label>
                        <input name="email" id="email" type="text" class="form-control form-control-lg" placeholder="Your email">
                        <div class="invalid-feedback">
                           Please provide a valid email.
                         </div>
                     </div>
                     <div class="form-group">
                        <label>Your Wishes</label>
                        <input name="wish" id="wish" type="text" class="form-control form-control-lg" placeholder="Your Wishes">
                     </div>
                     <div class="row">
                        <div class="col-12">
                           <div class="form-group mb-1">
                              <label>Attending</label>
                           </div>
                        </div>
                        <div class="col">
                           <div class="form-group rounded bg-white p-2 border">
                              <div class="custom-control custom-radio">
                                 <input type="radio" id="attending-yes" name="attend" class="custom-control-input" checked>
                                 <label class="custom-control-label" for="attending-yes" value="1">Yes, I will be there</label>
                              </div>
                           </div>
                        </div>
                        <div class="col">
                           <div class="form-group rounded bg-white p-2 border">
                              <div class="custom-control custom-radio">
                                 <input type="radio" id="atttending-no" name="attend" class="custom-control-input">
                                 <label class="custom-control-label" for="atttending-no" value="0">Sorry, I can't come</label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group text-center">
                        <input type="submit" id="submit" class="btn btn-lg btn-block btn-primary" value="Confirm">
                        <small class="mt-2 text-dark-gray opacity-8">You’ll recieve a confirmation email.</small>
                     </div>
                  </form>
</body>
</html>