<?php include('admin_login_logic.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign In</title>
    <link rel="icon" type="image/x-icon" href="https://64.media.tumblr.com/34d27d0e919fd4a61946def0c6659b63/tumblr_inline_mgfxr4hoqm1roozkr.gif">
    <link rel="stylesheet" href="sign_in.css" />
    <style> * {
        margin:0px;
        padding:0px;
        }</style>
</head>
<style>.illustrationClass {background-image:url(https://scontent.fkul8-1.fna.fbcdn.net/v/t39.30808-6/272663545_4902246499836344_7863237222994259357_n.jpg?_nc_cat=104&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=qkpQ1DKUIKwAX-UF7Xf&_nc_ht=scontent.fkul8-1.fna&oh=00_AT-6hmITNlMgUNGusx--QcR2QOEn_qtzplG5VRicIV8hFw&oe=62025F59);}</style>  
<body> 
    <div id="brandingWrapper" class="float">
        <div id="branding" class="illustrationClass"></div>
    </div>
    <div id="contentWrapper" class="float">
        <div id="content">
            <div id="header">
                    <img src="https://2.bp.blogspot.com/-kuBYc9S3q9c/Up0iUnKMYdI/AAAAAAAADlY/X4Asx8ad2AY/s1600/Logo+USM.png" alt="Universiti Sains Malaysia">
            </div>         
            <div id="loginArea">        
                <div id="loginMessage" class="groupMargin"><p><font size="5" face="verdana">Identity Single Sign On (Admin)</font></p></div>
                    <form method="post" action="admin_login_form.php">
                        <?php include('errors.php'); ?>
                        <div>
                            <label id="userNameInputLabel" for="userNameInput" class="hidden">User Account</label>
                            <input id="userNameInput" type="text" name="email" type="email" tabindex="1" class="text fullWidth" spellcheck="false" placeholder="*@usm.my or any *.usm.my subdomains" autocomplete="off">
                        </div>
                        <div>
                            <label id="passwordInputLabel" for="passwordInput" class="hidden">Password</label>
                            <input id="passwordInput" type="password" name="password" type="password" tabindex="2" class="text fullWidth" placeholder="Password" autocomplete="off" value="">
                        </div>
                        <div class="submitMargin">
                            <button name="login_admin" class="submit" type="submit">Sign in</button>
                        </div>
                    </form>
            </div> 
        </div>
    </div>                
</body>
</html>