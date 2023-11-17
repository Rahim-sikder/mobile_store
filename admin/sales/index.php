<?php
  $apple = new DBConnection();

  // getting the user detail, who are related to support
  $view_client_sql = "SELECT DISTINCT client FROM `chat` ORDER BY time";
  $view_client = mysqli_query($apple->conn, $view_client_sql);
?>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- char-area -->
<section class="message-area">
  <div class="chatlist">
    <h3 style="margin-bottom:5px;color:#fff">Click to message with clients</h3>
    <hr>
    <div class="modal-dialog-scrollable">
      <div class="modal-content">
        <div class="chat-header">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="Open-tab" data-bs-toggle="tab" data-bs-target="#Open" type="button" role="tab" aria-controls="Open" aria-selected="true">Open</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="Closed-tab" data-bs-toggle="tab" data-bs-target="#Closed" type="button" role="tab" aria-controls="Closed" aria-selected="false">Closed</button>
            </li>
          </ul>
        </div>

        <div class="modal-body">
          <!-- chat-list whole -->
          <div class="chat-lists">
            <div class="tab-content" id="myTabContent">

              <div class="tab-pane fade show active" id="Open" role="tabpanel" aria-labelledby="Open-tab">
                <!-- chat-list -->

                <!-- showing people, who are taking support. Marked them open support -->
                <?php while ($info = mysqli_fetch_array($view_client)) { ?>
                  <?php
                  $client_email =  $info['client'];
                  //support status
                  $client_dl = "SELECT * FROM `clients` WHERE email='$client_email'";
                  $client_detail = mysqli_query($apple->conn, $client_dl);
                  $info2 = mysqli_fetch_array($client_detail);
                  //support status end

                  //unread message detection
                  $view_sql_read = "SELECT * FROM `chat` WHERE (client='$client_email' AND send='1') AND read_stat='0'";
                  $all_message_read = mysqli_query($apple->conn, $view_sql_read);
                  $count3 = mysqli_num_rows($all_message_read);
                  // unread message detection end
                  ?>
                  <?php if ((int)$info2['support'] == 1) { ?>
                    <div class="chat-list active">
                      <a href="<?php echo base_url ?>admin/only-msg.php?email=<?php echo $info2['email'] ?>" class="d-flex align-items-center" onclick="select_user('<?php echo $info["email"] ?>')">
                        <div class="flex-shrink-0">
                          <img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/user.png" alt="user img">
                        </div>
                        <div class="flex-grow-1 ms-3">
                          <?php if ((int)$count3 > 0) { ?>
                            <h3><?php echo $info2['firstname'], " ", $info2['lastname'], " (", $count3, ")" ?></h3>
                            <p><?php echo $info2['email'] ?></p>
                          <?php } else { ?>
                            <h3><?php echo $info2['firstname'], " ", $info2['lastname'] ?></h3>
                            <p><?php echo $info2['email'] ?></p>
                          <?php } ?>
                        </div>
                      </a>
                    </div>
                  <?php } ?>
                <?php } ?>
                <!-- chat-list -->
              </div>
              <div class="tab-pane fade" id="Closed" role="tabpanel" aria-labelledby="Closed-tab">
                <!-- showing people, who have taken support. Marked as closed support -->
                <?php $view_client = mysqli_query($apple->conn, $view_client_sql); ?>
                <?php while ($infon = mysqli_fetch_array($view_client)) { ?>
                  <?php
                  $client_email =  $infon['client'];
                  //support status
                  $client_dl = "SELECT * FROM `clients` WHERE email='$client_email'";
                  $client_detail = mysqli_query($apple->conn, $client_dl);
                  $info2 = mysqli_fetch_array($client_detail);
                  //support status end

                  //unread message detection
                  $view_sql_read = "SELECT * FROM `chat` WHERE (client='$client_email' AND send='1') AND read_stat='0'";
                  $all_message_read = mysqli_query($apple->conn, $view_sql_read);
                  $count3 = mysqli_num_rows($all_message_read);
                  // unread message detection end
                  ?>
                  <?php if ((int)$info2['support'] == 0) { ?>
                    <!-- chat-list -->
                    <div class="chat-list">
                      <a href="<?php echo base_url ?>admin/only-msg.php?email=<?php echo $info2['email'] ?>" class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                          <img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/user.png" alt="user img">
                        </div>
                        <div class="flex-grow-1 ms-3">
                          <?php if ((int)$count3 > 0) { ?>
                            <h3><?php echo $info2['firstname'], " ", $info2['lastname'], " (", $count3, ")" ?></h3>
                            <p><?php echo $info2['email'] ?></p>
                          <?php } else { ?>
                            <h3><?php echo $info2['firstname'], " ", $info2['lastname'] ?></h3>
                            <p><?php echo $info2['email'] ?></p>
                          <?php } ?>
                        </div>
                      </a>
                    </div>
                  <?php } ?>
                  <!-- chat-list -->
                <?php } ?>
              </div>
            </div>
          </div>
          <!-- chat-list whole end -->
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- chatbox -->

  </div>
  </div>
  </div> -->
</section>
<!-- char-area -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
  :root {
    --body-bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    --msger-bg: #fff;
    --border: 2px solid #ddd;
    --left-msg-bg: #ececec;
    --right-msg-bg: rgb(216 27 96);
  }

  html {
    box-sizing: border-box;
  }

  *,
  *:before,
  *:after {
    margin: 0;
    padding: 0;
    box-sizing: inherit;
  }
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
<style>
  html,
  body,
  div,
  span,
  applet,
  object,
  iframe,
  h1,
  h2,
  h3,
  h4,
  h5,
  h6,
  p,
  blockquote,
  pre,
  a,
  abbr,
  acronym,
  address,
  big,
  cite,
  code,
  del,
  dfn,
  em,
  img,
  ins,
  kbd,
  q,
  s,
  samp,
  small,
  strike,
  strong,
  sub,
  sup,
  tt,
  var,
  b,
  u,
  i,
  center,
  dl,
  dt,
  dd,
  ol,
  ul,
  li,
  fieldset,
  form,
  label,
  legend,
  table,
  caption,
  tbody,
  tfoot,
  thead,
  tr,
  th,
  td,
  article,
  aside,
  canvas,
  details,
  embed,
  figure,
  figcaption,
  footer,
  header,
  hgroup,
  menu,
  nav,
  output,
  ruby,
  section,
  summary,
  time,
  mark,
  audio,
  video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
  }


  /* HTML5 display-role reset for older browsers */

  article,
  aside,
  details,
  figcaption,
  figure,
  footer,
  header,
  hgroup,
  menu,
  nav,
  section {
    display: block;
  }

  body {
    line-height: 1.5;
  }

  ol,
  ul {
    list-style: none;
  }

  blockquote,
  q {
    quotes: none;
  }

  blockquote:before,
  blockquote:after,
  q:before,
  q:after {
    content: '';
    content: none;
  }

  table {
    border-collapse: collapse;
    border-spacing: 0;
  }


  /********************************
  Typography Style
  ******************************** */

  body {
    margin: 0;
    font-family: 'Open Sans', sans-serif;
    line-height: 1.5;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }

  html {
    min-height: 100%;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }

  h1 {
    font-size: 36px;
  }

  h2 {
    font-size: 30px;
  }

  h3 {
    font-size: 26px;
  }

  h4 {
    font-size: 22px;
  }

  h5 {
    font-size: 18px;
  }

  h6 {
    font-size: 16px;
  }

  p {
    font-size: 15px;
  }

  a {
    text-decoration: none;
    font-size: 15px;
  }

  * {
    margin-bottom: 0;
  }


  /* *******************************
  message-area
  ******************************** */

  .message-area {
    height: 100vh;
    overflow: hidden;
    padding: 30px 0;
    background: rgb(216 27 96);
  }

  .chat-area {
    position: relative;
    width: 100%;
    background-color: #fff;
    border-radius: 0.3rem;
    height: 90vh;
    overflow: hidden;
    min-height: calc(100% - 1rem);
  }

  .chatlist {
    outline: 0;
    height: 100%;
    overflow: hidden;
    width: 100%;
    float: left;
    padding: 15px;
  }

  .chat-area .modal-content {
    border: none;
    border-radius: 0;
    outline: 0;
    height: 100%;
  }

  .chat-area .modal-dialog-scrollable {
    height: 100% !important;
  }

  .chatbox {
    width: auto;
    overflow: hidden;
    height: 100%;
    border-left: 1px solid #ccc;
  }

  .chatbox .modal-dialog,
  .chatlist .modal-dialog {
    max-width: 100%;
    margin: 0;
  }

  .msg-search {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .chat-area .form-control {
    display: block;
    width: 80%;
    padding: 0.375rem 0.75rem;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.5;
    color: #222;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ccc;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
  }

  .chat-area .form-control:focus {
    outline: 0;
    box-shadow: inherit;
  }

  a.add img {
    height: 36px;
  }

  .chat-area .nav-tabs {
    border-bottom: 1px solid #dee2e6;
    align-items: center;
    justify-content: space-between;
    flex-wrap: inherit;
  }

  .chat-area .nav-tabs .nav-item {
    width: 100%;
  }

  .chat-area .nav-tabs .nav-link {
    width: 100%;
    color: #180660;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.5;
    text-transform: capitalize;
    margin-top: 5px;
    margin-bottom: -1px;
    background: 0 0;
    border: 1px solid transparent;
    border-top-left-radius: 0.25rem;
    border-top-right-radius: 0.25rem;
  }

  .chat-area .nav-tabs .nav-item.show .nav-link,
  .chat-area .nav-tabs .nav-link.active {
    color: #222;
    background-color: #fff;
    border-color: transparent transparent #000;
  }

  .chat-area .nav-tabs .nav-link:focus,
  .chat-area .nav-tabs .nav-link:hover {
    border-color: transparent transparent #000;
    isolation: isolate;
  }

  .chat-list h3 {
    color: #222;
    font-size: 16px;
    font-weight: 500;
    line-height: 1.5;
    text-transform: capitalize;
    margin-bottom: 0;
  }

  .chat-list p {
    color: #343434;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.5;
    text-transform: capitalize;
    margin-bottom: 0;
  }

  .chat-list a.d-flex {
    margin-bottom: 15px;
    position: relative;
    text-decoration: none;
  }

  .chat-list .active {
    display: block;
    content: '';
    clear: both;
    position: absolute;
    bottom: 3px;
    left: 34px;
    height: 12px;
    width: 12px;
    background: #00DB75;
    border-radius: 50%;
    border: 2px solid #fff;
  }

  .msg-head h3 {
    color: #222;
    font-size: 18px;
    font-weight: 600;
    line-height: 1.5;
    margin-bottom: 0;
  }

  .msg-head p {
    color: #343434;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.5;
    text-transform: capitalize;
    margin-bottom: 0;
  }

  .msg-head {
    padding: 15px;
    border-bottom: 1px solid #ccc;
  }

  .moreoption {
    display: flex;
    align-items: center;
    justify-content: end;
  }

  .moreoption .navbar {
    padding: 0;
  }

  .moreoption li .nav-link {
    color: #222;
    font-size: 16px;
  }

  .moreoption .dropdown-toggle::after {
    display: none;
  }

  .moreoption .dropdown-menu[data-bs-popper] {
    top: 100%;
    left: auto;
    right: 0;
    margin-top: 0.125rem;
  }

  .msg-body ul {
    overflow: hidden;
  }

  .msg-body ul li {
    list-style: none;
    margin: 15px 0;
  }

  .msg-body ul li.sender {
    display: block;
    width: 100%;
    position: relative;
  }

  .msg-body ul li.sender:before {
    display: block;
    clear: both;
    content: '';
    position: absolute;
    top: -6px;
    left: -7px;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 12px 15px 12px;
    border-color: transparent transparent #f5f5f5 transparent;
    -webkit-transform: rotate(-37deg);
    -ms-transform: rotate(-37deg);
    transform: rotate(-37deg);
  }

  .msg-body ul li.sender p {
    color: #000;
    font-size: 14px;
    line-height: 1.5;
    font-weight: 400;
    padding: 15px;
    background: #f5f5f5;
    display: inline-block;
    border-bottom-left-radius: 10px;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    margin-bottom: 0;
  }

  .msg-body ul li.sender p b {
    display: block;
    color: #180660;
    font-size: 14px;
    line-height: 1.5;
    font-weight: 500;
  }

  .msg-body ul li.repaly {
    display: block;
    width: 100%;
    text-align: right;
    position: relative;
  }

  .msg-body ul li.repaly:before {
    display: block;
    clear: both;
    content: '';
    position: absolute;
    bottom: 15px;
    right: -7px;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 12px 15px 12px;
    border-color: transparent transparent rgb(216 27 96) transparent;
    -webkit-transform: rotate(37deg);
    -ms-transform: rotate(37deg);
    transform: rotate(37deg);
  }

  .msg-body ul li.repaly p {
    color: #fff;
    font-size: 14px;
    line-height: 1.5;
    font-weight: 400;
    padding: 15px;
    background: rgb(216 27 96);
    ;
    display: inline-block;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    border-bottom-left-radius: 10px;
    margin-bottom: 0;
  }

  .msg-body ul li.repaly p b {
    display: block;
    color: #061061;
    font-size: 14px;
    line-height: 1.5;
    font-weight: 500;
  }

  .msg-body ul li.repaly:after {
    display: block;
    content: '';
    clear: both;
  }

  .time {
    display: block;
    color: #000;
    font-size: 12px;
    line-height: 1.5;
    font-weight: 400;
  }

  li.repaly .time {
    margin-right: 20px;
  }

  .divider {
    position: relative;
    z-index: 1;
    text-align: center;
  }

  .msg-body h6 {
    text-align: center;
    font-weight: normal;
    font-size: 14px;
    line-height: 1.5;
    color: #222;
    background: #fff;
    display: inline-block;
    padding: 0 5px;
    margin-bottom: 0;
  }

  .divider:after {
    display: block;
    content: '';
    clear: both;
    position: absolute;
    top: 12px;
    left: 0;
    border-top: 1px solid #EBEBEB;
    width: 100%;
    height: 100%;
    z-index: -1;
  }

  .send-box {
    padding: 15px;
    border-top: 1px solid #ccc;
  }

  .send-box form {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 15px;
  }

  .send-box .form-control {
    display: block;
    width: 85%;
    padding: 0.375rem 0.75rem;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.5;
    color: #222;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ccc;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
  }

  .send-box button {
    border: none;
    background: rgb(216 27 96);
    padding: 0.375rem 5px;
    color: #fff;
    border-radius: 0.25rem;
    font-size: 14px;
    font-weight: 400;
    width: 24%;
    margin-left: 1%;
  }

  .send-box button i {
    margin-right: 5px;
  }

  .send-btns .button-wrapper {
    position: relative;
    width: 125px;
    height: auto;
    text-align: left;
    margin: 0 auto;
    display: block;
    background: #F6F7FA;
    border-radius: 3px;
    padding: 5px 15px;
    float: left;
    margin-right: 5px;
    margin-bottom: 5px;
    overflow: hidden;
  }

  .send-btns .button-wrapper span.label {
    position: relative;
    z-index: 1;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    width: 100%;
    cursor: pointer;
    color: #343945;
    font-weight: 400;
    text-transform: capitalize;
    font-size: 13px;
  }

  #upload {
    display: inline-block;
    position: absolute;
    z-index: 1;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    opacity: 0;
    cursor: pointer;
  }

  .send-btns .attach .form-control {
    display: inline-block;
    width: 120px;
    height: auto;
    padding: 5px 8px;
    font-size: 13px;
    font-weight: 400;
    line-height: 1.5;
    color: #343945;
    background-color: #F6F7FA;
    background-clip: padding-box;
    border: 1px solid #F6F7FA;
    border-radius: 3px;
    margin-bottom: 5px;
  }

  .send-btns .button-wrapper span.label img {
    margin-right: 5px;
  }

  .button-wrapper {
    position: relative;
    width: 100px;
    height: 100px;
    text-align: center;
    margin: 0 auto;
  }

  button:focus {
    outline: 0;
  }

  .add-apoint {
    display: inline-block;
    margin-left: 5px;
  }

  .add-apoint a {
    text-decoration: none;
    background: #F6F7FA;
    border-radius: 8px;
    padding: 8px 8px;
    font-size: 13px;
    font-weight: 400;
    line-height: 1.2;
    color: #343945;
  }

  .add-apoint a svg {
    margin-right: 5px;
  }

  .chat-icon {
    display: none;
  }

  .closess i {
    display: none;
  }



  @media (max-width: 767px) {
    .chat-icon {
      display: block;
      margin-right: 5px;
    }

    .chatlist {
      width: 100%;
    }

    .chatbox {
      width: 100%;
      position: absolute;
      left: 1000px;
      right: 0;
      background: #fff;
      transition: all 0.5s ease;
      border-left: none;
    }

    .showbox {
      left: 0 !important;
      transition: all 0.5s ease;
    }

    .msg-head h3 {
      font-size: 14px;
    }

    .msg-head p {
      font-size: 12px;
    }

    .msg-head .flex-shrink-0 img {
      height: 30px;
    }

    .send-box button {
      width: 28%;
    }

    .send-box .form-control {
      width: 70%;
    }

    .chat-list h3 {
      font-size: 14px;
    }

    .chat-list p {
      font-size: 12px;
    }

    .msg-body ul li.sender p {
      font-size: 13px;
      padding: 8px;
      border-bottom-left-radius: 6px;
      border-top-right-radius: 6px;
      border-bottom-right-radius: 6px;
    }

    .msg-body ul li.repaly p {
      font-size: 13px;
      padding: 8px;
      border-top-left-radius: 6px;
      border-top-right-radius: 6px;
      border-bottom-left-radius: 6px;
    }
  }
</style>