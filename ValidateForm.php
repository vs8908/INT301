<?php
    $errorMSGName = '';
    $errorMSGEmail = '';
    $errorMSGMobile = '';
    $errorMSGUsername = '';
    $errorMSGPassword = '';
    $errorMSGDOB = '';
    $errorMSGForCheck = '';
    $errorMSGForGender = '';
    $errorMSGForCountry = '';

    include 'db-create-connection.php';
    include 'db-destroy-connection.php';

    if(isset($_REQUEST['RegisterBtn']))
    {
        $valid = 0;
        if($_REQUEST['FullName'] != "")
        {
            $FullName = $_REQUEST['FullName'];
            if (!preg_match('/^[a-zA-Z]([A-Za-z ]{1,100})*$/', $FullName) )
            {
                $errorMSGName = "<small class='text-danger' id='fn'>name is not valid</small>";
            }
            else
            {
                $valid++;
            }
        }
        else
        { 
            $errorMSGName = "<small class='text-danger' id='fn'>name can't be null</small>";
        }
        if($_REQUEST['Email']  != "")
        {
            $Email = $_REQUEST['Email'];
            if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $Email) )
            {
                $errorMSGEmail = "<small class='text-danger' id='em'>email is not valid</small>";
            }
            else
            {
                $valid++;
            }
        } 
        else
        {
            $errorMSGEmail = "<small class='text-danger' id='em'>email can't be null</small>";
        }

        
        if($_REQUEST['Username']  != "")
        {	
            $Username = $_REQUEST['Username'];
        if(!preg_match('/^[a-zA-Z]([._-]?[a-zA-Z0-9]+)*$/', $Username) )
            {
                $errorMSGUsername = "<small class='text-danger' id='un'>Re-Enter Your Name! Format Inccorrect! (only alpha, numbers, @_ are allowed)</small>";
            }
            else
            {
                $valid++;
            }
        }
        else
        {
            $errorMSGUsername = "<small class='text-danger' id='un'>user name can't be null</small>";
        }
        if($_REQUEST['Password']  != "")
        {
            $Password = $_REQUEST['Password'];
            if (!preg_match('/^[a-zA-Z0-9]{5,10}$/', $Password) )
            { 
                $errorMSGPassword = "<small class='text-danger' id='pw'>password is not valid</small>";
            } 
            else
            {
                $valid++;
            }
        }
        else
        {
            $errorMSGPassword = "<small class='text-danger' id='pw'>password can't be null</small>";
        }
        if($_REQUEST['birthDate']  != "")
        {
            $BirthDate = $_REQUEST['birthDate'];
            
            if($BirthDate >= date("Y-m-d")){
                $errorMSGDOB = "<small class='text-danger' id='bd'>birth date is not valid</small>";
            }
            else
            {
                $valid++;
            }
        }
        else
        {
            $errorMSGDOB = "<small class='text-danger' id='bd'>please select birth date</small>";
        }
        if($_REQUEST['country']  != "Select Country")
        {
            $Country = $_REQUEST['country'];
                $valid++;
        }
        else
        {
            $errorMSGForCountry = "<small class='text-danger' id='ct'>please select country</small>";
        }
        if($_REQUEST['Mobile']  != "")
        {
            $Mobile = $_REQUEST['CCode'] + $_REQUEST['Mobile'];
            
            if($_REQUEST['country']  != "India")
            {
                if (preg_match('/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/', $Mobile))
                {
                    $errorMSGMobile = "<small class='text-danger' id='mb'>mobile number is not valid</small>";
                }
                else
                {
                    $valid++;
                }
            }
            else
            {
                if (!preg_match('/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/', $Mobile))
                {
                    $errorMSGMobile = "<small class='text-danger' id='mb'>mobile number is not valid</small>";
                }
                else
                {
                    $valid++;
                }

            }
        }
        else
        {
            $errorMSGMobile = "<small class='text-danger' id='mb'>mobile number can't be null</small>";
        }
        if(isset($_REQUEST['Gender']))
        {
            $Gender = $_REQUEST['Gender'];
                $valid++;
        }
        else
        {
            $errorMSGForGender = "<small class='text-danger' id='gd'>please choose gender </small>"; 
        }
        if(isset($_REQUEST['CheckTerms']))
        {
            $Accept = $_REQUEST['CheckTerms'];
                $valid++;
        }
        else
        {
        $errorMSGForCheck = "<small class='text-danger' id='tm'>please check terms and conditions</small>";
        }
        if($valid == 9)
        {
            $connect = CreateConnection();
            $sql = "INSERT INTO registeredusers (FullName, Email, Mobile, Username, Password, DateOfBirth, Country, Gender)
                VALUES ('$FullName', '$Email', '$Mobile', '$Username', '$Password','$BirthDate', '$Country', '$Gender')";
            if ($connect->query($sql) === TRUE) {
               header("Location:testb.php");
            } else {
                        echo "<script type='text/javascript'>alert('Unknown error')</script>";
            }

            DestroyConnection($connect);
        }
        
    }

?>

<!DOCTYPE html>
<html>
<head>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Validation Project</title>
<script src="js/script.js"></script>
<link href="css/Style.css" rel="stylesheet">
</head>
<body style="background: #99315e; background-image:url(pexels-photo-128458.jpeg); opacity: 1; z-index:2;" ">
<div class="container">
<div class="row">
<div class="col-sm-12">
    <div class="col-sm-3"></div>
    <div class="col-sm-6" style="margin-top:40px;">
        <form class="form-horizontal" role="form" method="post" action="ValidateForm.php" novalidate>
            <h2>User Registration</h2>
            <div class="form-group">
                <label for="FullName" class="col-sm-3 control-label">Full Name</label>
                <div class="col-sm-9">
                    <input type="text" name="FullName" id="FullName" placeholder="Full Name" class="form-control" onclick="RemoveSmall('fn')" autofocus>
                    <? echo $errorMSGName ?>
                </div>
            </div>
            <div class="form-group">
                <label for="Email" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9">
                    <input type="Email" name="Email" id="Email" placeholder="Email" class="form-control" onclick="RemoveSmall('em')">
                    <? echo $errorMSGEmail ?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="Username" class="col-sm-3 control-label">Username</label>
                <div class="col-sm-9">
                    <input type="text" name="Username" id="Username" placeholder="Username" class="form-control" onclick="RemoveSmall('un')" autofocus>
                    <? echo $errorMSGUsername ?>
                </div>
            </div>
            <div class="form-group">
                <label for="Password" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                    <input type="Password" name="Password" id="Password" placeholder="Password" class="form-control" onclick="RemoveSmall('pw')">
                    <? echo $errorMSGPassword ?>
                </div>
            </div>
            <div class="form-group">
                <label for="birthDate" class="col-sm-3 control-label">Date of Birth</label>
                <div class="col-sm-9">
                    <input type="date" name="birthDate" onclick="RemoveSmall('bd')" id="birthDate" class="form-control">
                    <? echo $errorMSGDOB ?>
                </div>
            </div>
            <div class="form-group">
                <label for="country" class="col-sm-3 control-label">Country</label>
                <div class="col-sm-9">
                    <select id="country" name="country" onclick="RemoveSmall('ct')" class="form-control">
                        <option>Select Country</option>
                        <option>Australia</option>
                        <option>Afghanistan</option>
                        <option>Bahamas</option>
                        <option>Cambodia</option>
                        <option>Denmark</option>
                        <option>Fiji</option>
                        <option>India</option>
                        <option>United Sates</option>
                        <option>United Kingdom</option>
                    </select>
                    <? echo $errorMSGForCountry ?>
                </div>
            </div>
            <div class="form-group">
                <label for="Mobile" class="col-sm-3 control-label">Mobile</label>
                <div class="col-sm-9">
                            <div class="form-group">
                    <div class="col-sm-3" style="margin-left:-0px;">
                        <input type="text" name="CCode" id="CCode" placeholder="+91" class="form-control" >
                    </div>
                    <div class="col-sm-9" style="margin-right:0px;">
                        <input type="text" name="Mobile" id="Mobile" placeholder="0123456789" class="form-control" onclick="RemoveSmall('mb')">
                    </div>
                        <? echo $errorMSGMobile ?>
                
            </div>
                
            </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Gender</label>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4">
                            <label class="radio-inline">
                                <input type="radio" onclick="RemoveSmall('gd')" "id="Female" name="Gender" value="Female">Female

                            </label>
                        </div>
                        <div class="col-sm-4">
                            <label class="radio-inline">
                                <input type="radio" id="Male" onclick="RemoveSmall('gd')" name="Gender" value="Male">Male
                            </label>
                        </div>
                    </div>
                    <? echo $errorMSGForGender ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <div class="checkbox">
                        
                        <label>
                        <input type="checkbox" name="CheckTerms" onclick="RemoveSmall('tm')">
                        I accept <a href="http://localhost/phpproject/Terms.php">terms</a>
                        </label>
                        <br />
                        <? echo $errorMSGForCheck ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-3">
                    <button type="submit" name="RegisterBtn" class="btn btn-primary btn-block">Register</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-3"></div>
</div>
</div>
</div>
</body>
</html>