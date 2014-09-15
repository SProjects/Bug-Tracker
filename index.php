<?php
include_once "include/greetingHeader.php";
include_once "include/functions.php";
include_once "dao/UserDao.php";
include_once "services/UserServices.php";


if (isset($_POST['Submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    //Input Validations
    if($username == ''|| $password == '') {
        echo '<div class="ui error message" style="margin-top: 5%"><div class="header">ERROR</div> Please enter your username and/or password.</div>';
    }else{
        $user_access_object = new UserServices();
        $user = $user_access_object->login($username, $password);
        if($user){
            //Login Successful
            $_SESSION['SESS_USER_ID'] = $user->getId();
            $_SESSION['SESS_USER_NAME'] = $user->getName();
            $_SESSION['SESS_USER_USERNAME'] = $user->getUsername();
            $_SESSION['SESS_USER_PASSWORD'] = $user->getPassword();
            session_write_close();

            redirect_to("bugPage.php");
        }else{
            echo '<div class="ui error message" style="margin-top: 5%"><div class="header">ERROR</div> Wrong username or password combination.</div>';
        }
    }
}

?>
    <div class="ui three column relaxed grid" style="margin-top: 3%;">
        <div class="column"></div>
        <div class="column">
            <div class="ui fluid form segment">
                <h4 class="ui header">Sign In</h4>
                <form id='login' action='' method='POST' accept-charset='UTF-8'>
                    <div class="ui form segment">
                        <div class="field">
                            <label>Username</label>
                            <div class="ui left labeled icon input">
                                <input type="text" name='username' id='username' maxlength="50" placeholder="Username">
                                <i class="user icon"></i>
                                <div class="ui corner label">
                                    <i class="icon asterisk"></i>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>Password</label>
                            <div class="ui left labeled icon input">
                                <input type="password" name='password' id='password' maxlength="50">
                                <i class="lock icon"></i>
                                <div class="ui corner label">
                                    <i class="icon asterisk"></i>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="Submit" class="ui blue submit button" value="Login"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="column"></div>
    </div>

<?php include_once "footer.php"; ?>