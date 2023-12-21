<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="side">
            <div class="h-100">
                <div class="sidebar_logo d-flex align-items-end">
                   
                    <a href="#" class="nav-link text-white" style="color:white;">Admin Control Panel</a>
                  
                </div>

                <ul class="sidebar_nav">
                    <li class="sidebar_item active" style="width: 100%;">
                        <a href="dashboard.php" class="sidebar_link"> <img src="img/1. overview.svg" alt="icon">Overview</a>
                    </li>
                    <li class="sidebar_item">
                        <a href="candidat.php" class="sidebar_link"> <img src="img/agents.svg" alt="icon">Candidat</a>
                    </li>
                    <li class="sidebar_item">
                        <a href="Postules.php" class="sidebar_link"> <img src="img/task.svg" alt="icon">Postules</a>
                    </li>
                    <li class="sidebar_item">
                        <a href="Offers.php" class="sidebar_link"><img src="img/agent.svg" alt="icon">Offers</a>
                    </li>
                    <li class="sidebar_item">
                        <a href="archives.php" class="sidebar_link"><img src="img/articles.svg" alt="icon">Archives</a>
                    </li>

                </ul>
                <div class="line"></div>
                <a href="#" class="sidebar_link"><img src="img/settings.svg" alt="">Settings</a>


            </div>
        </aside>
        <div class="main">
            <nav class="navbar justify-content-space-between pe-4 ps-2">
                <button class="btn open">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar  gap-4">
                    <div class="">
                        <input type="search" class="search " placeholder="Search">
                        <img class="search_icon" src="img/search.svg" alt="iconicon">
                    </div>
                    <!-- <img src="img/search.svg" alt="icon"> -->
                    <img class="notification" src="img/new.svg" alt="icon">
                    <div class="card new w-auto">
                        <div class="list-group list-group-light">
                            <div class="list-group-item px-3 d-flex justify-content-between align-items-center ">
                                <p class="mt-auto">Notification</p><a href="#"><img src="img/settingsno.svg" alt="icon"></a>
                            </div>
                            <div class="list-group-item px-3 d-flex"><img src="img/notif.svg" alt="iconimage">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text mb-3">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <small class="card-text">1  day ago</small>
                                </div>
                            </div>
                            <div class="list-group-item px-3 d-flex"><img src="img/notif.svg" alt="iconimage">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text mb-3">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <small class="card-text">1  day ago</small>
                                </div>
                            </div>
                            <div class="list-group-item px-3 text-center"><a href="#">View all notifications</a></div>
                        </div>
                    </div>
                    <div class="inline"></div>
                    <div class="name"><?php echo $_SESSION['name'] ?></div>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-icon pe-md-0 position-relative" data-bs-toggle="dropdown">
                                <img src="img/pp.jpg" alt="icon" style="width:50px;height:50px;border-radius:50%;">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end position-absolute">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Account Setting</a>
                                <a class="dropdown-item" href="/PeoplePerTask/project/pages/index.html">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <section class="Agents px-4">
                <table class="agent table align-middle bg-white" style="min-width: 700px;">
                    <thead class="bg-light">
                        <tr>
                            <th>Name Candidat</th>
                            <th>description</th>
                            <th>Time</th>
                            <th>note</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        include "connection.php";
                        $sqlcode = "SELECT * FROM postules 
                                  JOIN users ON postules.user_id = users.id 
                                  JOIN offers ON postules.offer_id = offers.id 
                                  ORDER BY CASE WHEN reponse = 'No Response Yet' THEN 1
                                             WHEN reponse = 'Approved' THEN 2
                                             WHEN reponse = 'Declined' THEN 3
                                             ELSE 4
                                         END";
                        $result = mysqli_query($connection,$sqlcode);
                        while($row = mysqli_fetch_assoc($result)){
                            echo "
                            <tr class='freelancer'>
                            <td>
                                <div class='d-flex align-items-center'>
                                    <div class='ms-3'>
                                        <p class='fw-bold mb-1 f_name'>".$row['name']."</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class='fw-normal mb-1 f_title'>".$row['title']."</p>
                            </td>
                            <td>
                                <a href='#' class='f_status'>".date('Y-m-d', strtotime($row['created_at']))."</a>
                            </td>
                            <td class='f_position'>".$row['note']."</td>
                            ";
                            if ($row['reponse'] == 'Approved') {
                                echo "<td class=''>
                                <a><button class='btn btn-success edit' data-id='".$row['id']."' disabled>Approved</button></a>
                                </td>
                            </tr>";
                            } else if ($row['reponse'] == 'Declined') {
                                echo "<td class=''>
                                <a><button class='btn btn-danger edit' data-id='".$row['id']."' disabled>Declined</button></a>
                                </td>";
                            } else {
                                echo "<td class=''>
                                <a href='approve.php?id=".$row['id']."&user=".$row['user_id']."'><button class='btn btn-success edit' data-id='".$row['id']."'>Approve</button></a>
                                <a href='decline.php?id=".$row['id']."&user=".$row['user_id']."'><button class='btn btn-danger delete' data-id='".$row['id']."'>Decline</button></a>
                                </td>
                            </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </section>
            
        </div>
    </div>
    <div class="modal">
        <div class="modal-content" >
            <form action="AddOffer.php" method="post">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="mb-4">
                      <label class="form-label" >Postules description</label>
                      <input type="text" class="form-control task-desc" name="description">
                </div>
                <div class="mb-4">
                      <label class="form-label" >Postules title</label>
                      <input type="text" class="form-control task-desc" name="title">
                    
                </div>
                <div class="mb-4">
                      <label class="form-label" >Postules salary</label>
                      <input type="text" class="form-control task-desc" name="salary">
                </div>
                <div class="mb-4">
                      <label class="form-label" >Postules company</label>
                      <input type="text" class="form-control task-desc" name="company">
                    
                </div>
                <div class="mb-4">
                      <label class="form-label" >Postules Location</label>
                      <input type="text" class="form-control task-desc" name="location">
                </div>
              
                <!-- select input -->
                <div class="mb-4">
                    <label class="form-label">Status</label>
                        <select class="form-control" name="task status" id="status">
                            <option value="img/default.svg">Default</option>
                            <option value="img/successnew.svg">Active</option>
                            <option value="img/warning.svg">Inactive</option>
                        </select>
                </div>
                <div class="d-flex w-100 justify-content-center">
                <input type="submit" class="btn btn-success btn-block mb-4 me-4 save" name="submit" value="Save Edit">
                <div class="btn btn-danger btn-block mb-4 annuler" onclick="document.querySelector('.modal').style.display ='none';">Annuler</div>
                </div>
              </form>
                
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
    <script src="script.js"></script>
</body>

</html>
<script>
    function activeSeter() {
        document.querySelectorAll('.active').forEach((element) => {
            element.classList.remove('active');
        });
        let url = window.location.href;
        url = url.replace('http://localhost/jobease-php-oop/dashboard/','');
        let elements = document.querySelectorAll(`a[href="${url}"]`);
        console.log(elements);
        console.log(url);
        elements.forEach((element) => {
            element.parentNode.classList.add('active');
        });
    }
    activeSeter();
</script>