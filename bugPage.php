<?php
include_once "include/greetingHeader.php";
include_once "dao/BugDao.php";
include_once "dao/UserDao.php";
include_once "services/UserServices.php";
include_once "services/BugServices.php";

$user_access_object = new UserServices();
$user = $user_access_object->getUserById($_SESSION['SESS_USER_ID']);
$bug_access_object = new BugServices();
?>

<?php
if (isset($_POST['submitBug'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];

    //Input Validations
    if($title == '' || $description == '') {
        echo '<div class="ui error message" style="margin-top: 5%"><div class="header">ERROR</div> Title and/or description field(s) missing input.</div>';
    }else{
        $bug = new Bug($title, $description, $user, new Status(null, "OPEN", 1));
        $bug_access_object->insertNewBug($bug);
        echo '<div class="ui success message" style="margin-top: 5%"><div class="header">SUCCESS</div> Bug has been stored.</div>';
    }
}
?>
<div class="ui one column relaxed grid" style="margin-top: 3%;">
    <div class="column">
        <div class="ui fluid form segment">
            <div class="two fields">
                <div class="field">
                    <h4 class="ui header">Enter New Bug</h4>
                    <form id='newBug' action='' method='POST' accept-charset='UTF-8'>
                        <div class="ui form segment">
                            <div class="field">
                                <label>Title</label>
                                <input type='text' name='title' id='title' maxlength="50" placeholder="Bug title"/>
                            </div>
                            <div class="field">
                                <label>Description</label>
                                <textarea cols="30" rows="10" name='description' id='description' placeholder="Bug description"></textarea>
                            </div>
                        </div>
                        <input type='submit' name='submitBug' class="ui green submit button small" value='Save Bug'/>
                        <input type='reset' name='reset' class="ui red submit button small" value='Reset'/>
                    </form>
                </div>
                <div class="field">
                    <h4 class="ui header">Previous Bugs</h4>
                    <?php
                    $bugs = $user->getUserBugs();
                    if(!empty($bugs)){
                    ?>
                    <table class="ui small table segment">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($bugs as $bug){
                            ?>
                            <tr>
                                <td><?php echo $bug->getTitle();?></td>
                                <td><?php echo $bug->getStatus()->getName(); ?></td>
                                <td>
                                    <a href="detailBug.php?id=<?php echo $bug->getId(); ?>"><i class="edit sign icon linked" title="Edit/Details"></i></a>
                                    |
                                    <a href="deleteBug.php?id=<?php echo $bug->getId(); ?>"><i class="remove circle icon linked" title="Delete"></i></a>
                                </td>
                            <tr>
                                <?php
                                }
                                ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3"></th>
                            </tr>
                        </tfoot>
                        <table>
                            <?php
                            }else{
                                echo "<div class='ui visible message small yellow'>No submitted bugs</div>";
                            }
                            ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "footer.php";?>