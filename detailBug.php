<?php
include_once "include/greetingHeader.php";
include_once "services/BugServices.php";
include_once "services/UserServices.php";
include_once "services/StatusServices.php";
include_once "models/Bug.php";

$bug_id = $_REQUEST['id'];
$bug_access_object = new BugServices();
$bug = $bug_access_object->getBugById($bug_id);

$user_access_object = new UserServices();
$users = $user_access_object->getAllUsers();

$status_access_object = new StatusServices();
$statuses = $status_access_object->getAllStatus();
?>

<?php
if (isset($_POST['editBug'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $user_id = $_POST['user'];

    if($title == '')
       $title = $bug->getTitle();
    if($description == '')
       $description = $bug->getDescription();
    if($status == $bug->getStatus()->getNumber() || $status == 99)
       $status = $bug->getStatus()->getNumber();
    if($user_id == $bug->getUser()->getId() || $user_id == -1)
       $user_id = $bug->getUser()->getId();

    $user_update = $user_access_object->getUserById($user_id);
    $updated_bug = new Bug($title, $description, $user_update, $status_access_object->getStatusWhere(array('number' => $status))[0], $bug->getId());

    if($updated_bug->equals($bug)){
        echo '<div class="ui visible message blue" style="margin-top: 5%"><div class="header">NOTICE</div> No edits detected.</div>';
    }else{
        if($bug_access_object->updateBugById($updated_bug, $bug_id)){
            echo '<div class="ui success message" style="margin-top: 5%"><div class="header">SUCCESS</div> Bug has been updated.</div>';
            $bug = $updated_bug;
        }else{
            echo '<div class="ui error message" style="margin-top: 5%"><div class="header">ERROR</div> Failed to update bug.</div>';
        }
    }

}
?>

<div class="ui one column relaxed grid" style="margin-top: 1%;">
    <div class="column">
        <a href="bugPage.php" style="padding: 5px;">
            <div class="ui labeled icon button small">
                Back <i class="circle left icon"></i>
            </div>
        </a>
        <div class="ui fluid form segment">
            <form id='editBug' action='detailBug.php?id=<?php echo $bug_id;?>' method='POST' accept-charset='UTF-8'>
                <h4 class="ui header">Bug Details / Edit Page</h4>
                <div class="two fields">
                <div class="field">
                    <div class="ui form segment">
                        <div class="field">
                            <label for='username'>Title</label>
                            <div class="ui visible message small blue"><?php echo $bug->getTitle(); ?></div>
                            <input type='text' name='title' id='title' size="35" maxlength="50" placeholder="Enter title edits here"/>
                        </div>
                        <div class="field">
                            <label for='description'>Description</label>
                            <div class="ui visible message small blue"><?php echo $bug->getDescription(); ?></div>
                            <textarea cols="30" rows="10" name='description' id='description' placeholder="Enter description edits here"></textarea>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <div class="ui form segment">
                        <div class="field">
                            <label for='username'>Status</label>
                            <div class="ui visible message small blue"><b>Current Bug Status:</b> <?php echo $bug->getStatus()->getName(); ?></div>
                            <select name='status' id='status'>
                                <option value="99">- Change status -</option>
                                <?php
                                    foreach($statuses as $status){
                                       echo "<option value='".$status->getNumber()."'>".$status->getName()."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="field">
                            <label for='username'>Re-assign Bug</label>
                            <div class="ui visible message small blue"><b>Current bug owner:</b> <?php echo $bug->getUser()->getName(); ?></div>
                            <select name='user' id='user'>
                                <option value='-1'>- Select new owner -</option>
                                <?php
                                foreach($users as $user){
                                    echo "<option value='".$user->getId()."'>".$user->getName()."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input type='submit' name='editBug' class="ui green submit button small" value='Save Changes'/>
                    <input type='reset' name='reset' class="ui red submit button small" value='Reset'/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

