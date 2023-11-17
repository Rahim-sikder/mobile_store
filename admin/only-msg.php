<?php require_once('../config.php'); ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>

<body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed sidebar-mini-md sidebar-mini-xs text-sm" data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="" style="height: auto;">
    <div class="wrapper">
        <?php require_once('inc/topBarNav.php') ?>
        <?php require_once('inc/navigation.php') ?>
        <?php
            $apple = new DBConnection();

            // getting client's email from the previous page
            $email = $_GET['email'];
            $view_sql = "SELECT * FROM `chat` WHERE client='$email'";
            $all_message = mysqli_query($apple->conn, $view_sql);
            $count3 = mysqli_num_rows($all_message);
            $view_client_sql = "SELECT * FROM `clients` WHERE email='$email'";
            $view_client = mysqli_query($apple->conn, $view_client_sql);
            $view_client_data = mysqli_fetch_assoc($view_client);

            if (isset($_POST['submit'])) {
                $ms = $_POST['ms'];
                $sql = "INSERT INTO chat(messages,send,client) VALUES('$ms',0,'$email')";
                $query = mysqli_query($apple->conn, $sql);
            }
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper  pt-3" style="min-height: 567.854px;">

            <!-- Main content -->
            <section class="content  text-dark">
                <div class="container-fluid">
                    <h4 style="display:inline-block ;"><?php echo $view_client_data['firstname'], ' ', $view_client_data['lastname'] ?> Conversation</h4> <a href="">Refresh</a>
                    <a 
                        style="float:right;" 
                        href="<?php echo base_url ?>admin/mark_as_close.php?email=<?php echo $email ?>">
                        Mark as close
                    </a>
                    <section class="msger">
                        <main id="scroll-to-bottom" class="msger-chat" style="overflow:scroll; height:450px;">
                            <?php if ($count3 < 1) { ?>
                                <div>No previews message</div>
                            <?php } else { ?>
                                <?php while ($info = mysqli_fetch_array($all_message)) { ?>
                                    <?php 
                                        $read_id = $info['id'];
                                        //echo $read_id;
                                        $read_msg = "UPDATE chat SET read_stat = 1 WHERE id='$read_id' AND send=1";
                                        mysqli_query($apple->conn,$read_msg);
                                    ?>
                                    <?php if ($info['send'] == 1) { ?>
                                        <div class="msg left-msg">
                                            <div class="msg-bubble">
                                                <div class="msg-info">
                                                    <div class="msg-info-name"><?php echo $view_client_data['firstname'] ?> <?php echo $view_client_data['lastname'] ?></div>
                                                    <div class="msg-info-time"><?php echo $info['time'] ?></div>
                                                </div>

                                                <div class="msg-text">
                                                    <?php echo $info['messages'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="msg right-msg">
                                            <div class="msg-bubble">
                                                <div class="msg-info">
                                                    <div class="msg-info-name">Admin</div>
                                                    <div class="msg-info-time"><?php echo $info['time'] ?></div>
                                                </div>

                                                <div class="msg-text">
                                                    <?php echo $info['messages'] ?>
                                                </div>
                                            </div>
                                        </div>
                            <?php }
                                }
                            } ?>
                        </main>

                        <form class="msger-inputarea" method="post" action="only-msg.php?email=<?php echo $email ?>">
                            <input name="ms" type="text" class="msger-input" placeholder="Enter your message...">
                            <button type="submit" name="submit" class="msger-send-btn">Send</button>
                        </form>
                    </section>
            <!-- /.content -->
            <div class="modal fade" id="confirm_modal" role='dialog'>
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmation</h5>
                        </div>
                        <div class="modal-body">
                            <div id="delete_content"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="uni_modal" role='dialog'>
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="uni_modal_right" role='dialog'>
                <div class="modal-dialog modal-full-height  modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="fa fa-arrow-right"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="viewer_modal" role='dialog'>
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
                        <img src="" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- /.content-wrapper -->
        <?php require_once('inc/footer.php') ?>
</body>

</html>
<style>
    :root {
        --body-bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        --msger-bg: #fff;
        --border: 2px solid #ddd;
        --left-msg-bg: #ececec;
        --right-msg-bg: rgb(216 27 96);
    }

    /* html {
        box-sizing: border-box;
    } */

    /* *,
    *:before,
    *:after {
        margin: 0;
        padding: 0;
        box-sizing: inherit;
    } */

    .msger-header {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: var(--border);
        background: #eee;
        color: #666;
    }

    .msger-chat {
        flex: 1;
        overflow-y: auto;
        padding: 10px;
    }

    .msger-chat::-webkit-scrollbar {
        width: 6px;
    }

    .msger-chat::-webkit-scrollbar-track {
        background: #ddd;
    }

    .msger-chat::-webkit-scrollbar-thumb {
        background: #bdbdbd;
    }

    .msg {
        display: flex;
        align-items: flex-end;
        margin-bottom: 10px;
    }

    .msg:last-of-type {
        margin: 0;
    }

    .msg-img {
        width: 50px;
        height: 50px;
        margin-right: 10px;
        background: #ddd;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        border-radius: 50%;
    }

    .msg-bubble {
        max-width: 450px;
        padding: 15px;
        border-radius: 15px;
        background: var(--left-msg-bg);
    }

    .msg-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .msg-info-name {
        margin-right: 10px;
        font-weight: bold;
    }

    .msg-info-time {
        font-size: 0.85em;
    }

    .left-msg .msg-bubble {
        border-bottom-left-radius: 0;
    }

    .right-msg {
        flex-direction: row-reverse;
    }

    .right-msg .msg-bubble {
        background: var(--right-msg-bg);
        color: #fff;
        border-bottom-right-radius: 0;
    }

    .right-msg .msg-img {
        margin: 0 0 0 10px;
    }

    .msger-inputarea {
        display: flex;
        padding: 10px;
        border-top: var(--border);
        background: #eee;
    }

    .msger-inputarea * {
        padding: 10px;
        border: none;
        border-radius: 3px;
        font-size: 1em;
    }

    .msger-input {
        flex: 1;
        background: #ddd;
    }

    .msger-send-btn {
        margin-left: 10px;
        background: rgb(216 27 96);
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.23s;
    }

    .msger-send-btn:hover {
        background: rgb(134, 0, 49);
    }

    .msger-chat {
        background-color: #fcfcfe;
    }
</style>

<script>
		let scroll_to_bottom = document.getElementById('scroll-to-bottom');
		scroll_to_bottom.scrollTop = scroll_to_bottom.scrollHeight;
</script>