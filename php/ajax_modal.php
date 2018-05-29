<?php

require_once 'dmlFunctions.php';
session_start();

switch (key($_GET)) {
	case 'login_btn': // LOGIN FORM
		echo "
            <div id='login_form'>
                <h2>LOGIN</h2>
                <form method='POST'>
                    <input type='text' name='username' id='login_username' placeholder='Username' required>
                    <input type='password' name='pass' placeholder='Password' required>
                    <input type='submit' name='login_submit' value='Log in'>
                </form>
            </div>";
		break;
	case 'register_btn': // REGISTER FORM
		echo "
			<div id='signup_form'>
                <h2><div id='signup_title'></div></h2>
                <form method='POST'>
                    <div id='signup_fields'>
                        <div id='userSpecFields'>
                            <input type='text' name='username' id='signup_username' placeholder='Username' maxlength='25' required>
                            <input type='password' name='pass' id='signup_pass'placeholder='Password' maxlength='12' required>
                            <input type='password' name='varPass' id='signup_verPass'placeholder='Verify password' maxlength='12' required>
                            <input type='text' name='name' placeholder='Name' maxlength='25' required>
                            <input type='email' name='email' placeholder='E-mail' maxlength='30' required>
                            <select name='community' id='community_select' onchange='updateCities()'>";
                                $communities = select('distinct community', 'city');
                                while ($community = mysqli_fetch_assoc($communities)) {
                                    echo '<option>'.$community['community'].'</option>';
                                }
                      echo "</select>
                            <div id='citySelect'></div>
                        </div>
                        <div id='nonUserSpecFields'></div>
                    </div>
                    <input type='submit' name='signup_submit' id='signup_submit' value='Sign up'>
                </form>";
	        // TEST
	        echo "
                <form method='POST'>
                    <input type='number' name='quickAdd' id='quickAdd' placeholder='Quick Add (TESTING)'>
                    <input type='hidden' name='qa_usertype' id='qa_usertype'>
                    <input type='submit' value='ADD' id='quickAdd' onclick='getUserType()'>
                </form>
            </div>";
		break;
    case 'edit_pass':
        echo "
            <div id='edit_pass'>
                <h2>MODIFICAR CONTRASEÑA</h2>
                <form method='POST'>
                    <input type='password' name='pass' id='pass' placeholder='Password' required>
                    <input type='password' name='newPass' id='newPass' placeholder='New Password' required>
                    <input type='password' name='verPass' id='verPass' placeholder='Verify Password' required>
                    <input type='submit' name='edit_pass_submit' id='edit_pass_submit' value='Modificar'>
                </form>
            </div>";
        break;
    case 'check_pass':        
        echo password_verify($_GET["check_pass"], select_value("pass", "user", "WHERE id_user = ".$_SESSION["id_user"]));
        break;
	default:
}