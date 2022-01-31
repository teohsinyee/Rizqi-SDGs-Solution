<?php include('server.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="icon" type="image/x-icon" href="https://64.media.tumblr.com/34d27d0e919fd4a61946def0c6659b63/tumblr_inline_mgfxr4hoqm1roozkr.gif">
	<!-- <link rel="stylesheet" href="assets/css/login.css" /> -->
    <link rel="stylesheet" href="sign_in.css" />
    <style> * {
        margin:0px;
        padding:0px;
        }</style>
</head>
<style>.illustrationClass {background-image:url(https://som.usm.my/images/Accommodation_4.jpg);}</style>
<body>
    <!-- <form method="post" action="login_form.php" >
    

        <h1 style="text-align:center">LOG IN</h1>
        <div class="input-group">
        <label>Email</label>
            <input type="text" name="email">
        </div>

        <div class="input-group">
        <label>Password</label>
        <input type="text" name="password">
        </div>

    <div class="input-group">
    <button name="login_user" id="submitButton" type="submit">Sign in</button>
    </div>

    </form>  -->

    <div id="brandingWrapper" class="float">
                <div id="branding" class="illustrationClass"></div>
            </div>
            <div id="contentWrapper" class="float">
                <div id="content">
                    <div id="header">
                        <img src="https://2.bp.blogspot.com/-kuBYc9S3q9c/Up0iUnKMYdI/AAAAAAAADlY/X4Asx8ad2AY/s1600/Logo+USM.png" alt="Universiti Sains Malaysia">
                    </div>
                        
                    <div id="loginArea">        
                        <div id="loginMessage" class="groupMargin"><p><font size="5" face="verdana">Identity Single Sign On</font></p></div>
                            <form method="post" action="login_form.php">
                            <?php include('errors.php'); ?>
                                <div>
                                    <label id="userNameInputLabel" for="userNameInput" class="hidden">User Account</label>
                                    <input id="userNameInput" type="text" name="email" type="email" tabindex="1" class="text fullWidth" spellcheck="false" placeholder="*@usm.my or any *.usm.my subdomains" autocomplete="off">
                                </div>
                                <div>
                                    <label id="passwordInputLabel" for="passwordInput" class="hidden">Password</label>
                                    <input id="passwordInput" type="text" name="password" type="password" tabindex="2" class="text fullWidth" placeholder="Password" autocomplete="off" value="">
                                </div>
                                <!-- <div class="submitMargin">
                                    <span id="submitButton" class="submit" name="login_user" type="submit">Sign in</span>
                                </div> -->
                                <div class="submitMargin">
                                    <button name="login_user" class="submit" type="submit">Sign in</button>
                                </div>
                            </form>
                    </div>
            </div>                
    </div>

</body>
</html>