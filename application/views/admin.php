<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<style>
    .edit-modal-overlay,.add-modal-overlay,.delete-modal-overlay {
	background: rgba(0, 0, 0, 0.7);
	width: 100%;
	height: 100%;
	position: fixed;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
}

.modal-wrapper {
	width: 300px;
	height: 300px;
	background: ghostwhite;
	position: fixed;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}

.open-modal-btn-wrapper {
	position: fixed;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}

.close-modal-btn,
.open-modal-btn
.edit-modal-btn,
.delete-modal-btn {
	padding: 8px;
	background: slateblue;
	font-family: Verdana, Geneva, Tahoma, sans-serif;
	font-size: 15px;
	color: ghostwhite;
	font-weight: 5px;
	margin-left: auto;
	margin-top: 10px;
	margin-right: 10px;
	cursor: pointer;
}

.close-btn-wrapper {
	display: flex;
}

.modal-content {
	margin: 20px auto;
	max-width: 210px;
	width: 100%;
}

.hide {
	display: none;
}

h1 {
	text-align: center;
}
.modal-wrapper {
    max-width: 90%;
    max-height: 90%;
    overflow-y: auto; /* Enable vertical scrollbar if content exceeds modal height */
    background: ghostwhite;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.profile-image {
      max-width: 100px; 
      height: auto; 
    }
</style>
    <title>Document</title>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/admin">Users</a>
  <a class="navbar-brand" href="/admin/transaction">Transactions</a>
  <a class="navbar-brand" href="/users">Profile</a>
</nav>

<button class="add-open-modal-btn">
        Add User
        </button>
<table class="table table-striped table-centered mb-0">
    <thead>
        <tr>
            <th>id</th>
            <th>image</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th>Role</th>
            <th>Bilanci</th>
            <th>Limiti Borxhit</th>
            <th>InActive</th>

            <th>Action</th>
        </tr>
    </thead>
    <tbody id="usersTableBody">
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user->id; ?></td>
                <td class="table-user">
                    <img src="<?php echo ('profile/' . $user->image); ?>" width="100" height="100" alt="table-user" class="me-2 rounded-circle" />
                </td>
                <td><?php echo $user->Full_Name; ?></td>
                <td><?php echo $user->username; ?></td>
                <td><?php echo $user->password; ?></td>
                <td><?php echo $user->email; ?></td>
                <td><?php echo $user->role; ?></td>
                <td><?php echo $user->bilanci; ?></td>

                <td><?php echo $user->limiti_borxhit; ?></td>
                <td><?php echo $user->inActive; ?></td>
                <td class="table-action">
                <div>
        <button class="edit-open-modal-btn"id=<?php echo $user->id?>>
            Edit
        </button>
        
        <button class="delete-open-modal-btn" id=<?php echo $user->id ?>>
        Delete
        </button></div>
                    </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

 
   
        <div class="edit-modal-overlay hide">
        <div class="modal-wrapper">
            <div class="close-btn-wrapper">
                <button class="edit-close-modal-btn">
                    Close
                </button>
            </div>
            <h1>Edit User</h1>
            <div class="modal-content">
                <form action="" id="editUser" >
                <div class="mb-5">
    <label class="form-label" for="role">Role:</label>
    <select class="form-select" name="role" id="role">
        <option value="">Select Role</option>
        <option value="admin">Admin</option>
        <option value="superadmin">Superadmin</option>
        <option value="user">User</option>
    </select>
    <div class="mb-5">
    <label class="form-label" for="limiti_borxhi">Limiti Borxhit:</label>
    <input type="number" class="form-control" name="limit_borxhi" id="limiti_borxhi" placeholder="Your limit debt" >
</div>
<p class="state"></p>
    <button type="submit">Edit</button>
</div>
                </form>
            </div>
        </div>
        </div>	
        <div class="delete-modal-overlay hide">
        <div class="modal-wrapper">
            <div class="close-btn-wrapper">
                <button class="delete-close-modal-btn">
                    Close
                </button>
            </div>
            <h1>Delete User</h1>
            <div class="modal-content">
                <form id="deleteUser">
                    <button type="submit">Delete User</button>
                </form>
                <p class="state"></p>
            </div>
        </div>	
        </div>	



        <div class="add-modal-overlay hide">
        <div class="modal-wrapper">
            <div class="close-btn-wrapper">
                <button class="add-close-modal-btn">
                    Close
                </button>
            </div>
            <h1>Add User</h1>
            <div class="modal-content">
                <form action="/user" method="POST">

                <div class="mb-5">
    <label class="form-label" for="username">Username:</label>
    <input type="text" class="form-control" name="username" id="username" placeholder="Your email address" required>
</div>
<div class="mb-5">
    <label class="form-label" for="FullName">FullName:</label>
    <input type="text" class="form-control" name="FullName" id="FullName" placeholder="Your Full Name" required>
</div>
<div class="mb-5">
    <label class="form-label" for="FullName">Email:</label>
    <input type="text" class="form-control" name="Email" id="Email" placeholder="Your Email" required>
</div>
<div class="mb-5">
    <label class="form-label" for="role">Role:</label>
    <select class="form-select" name="role" id="role" required>
        <option value="">Select Role</option>
        <option value="admin">Admin</option>
        <option value="superadmin">Superadmin</option>
        <option value="user">User</option>
    </select>
</div>

<div class="mb-5">
    <label class="form-label" for="limiti_borxhi">Limiti Borxhit:</label>
    <input type="number" class="form-control" name="limit_borxhi" id="limiti_borxhi" placeholder="Your limit debt" required>
</div>

<div class="mb-5">
    <label class="form-label" for="phone_number">Phone number:</label>
    <input type="text" class="form-control" name="Phone" id="phone_number" placeholder="Your Phone Number" required>
</div>

<div class="mb-5">
    <label class="form-label" for="password">Password:</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Your Password" required>
</div>

<button type="submit"class="btn btn-primary w-full">Add User</button>                </form>
            </div>
        </div>
        </div>		
<script>
    const openBtn = document.querySelectorAll(".edit-open-modal-btn");
const modal = document.querySelector(".edit-modal-overlay");
const closeBtn = document.querySelector(".edit-close-modal-btn");
const openBtn2 = document.querySelectorAll(".delete-open-modal-btn");
const modal2 = document.querySelector(".delete-modal-overlay");
const closeBtn2 = document.querySelector(".delete-close-modal-btn");
const openBtn3 = document.querySelector(".add-open-modal-btn");
const modal3 = document.querySelector(".add-modal-overlay");
const closeBtn3 = document.querySelector(".add-close-modal-btn");
let userId=null;
console.log("openBtn",openBtn)
function openModal() {
    modal.classList.remove("hide");
    console.log(userId)
}
 
function closeModal(e, clickedOutside) {
    if (clickedOutside) {
        if (e.target.classList.contains("edit-modal-overlay"))
            modal.classList.add("hide");
    } else modal.classList.add("hide");
}
Array.from(openBtn).forEach(el=>{
    el.addEventListener("click", ()=>{
        userId=el.id;
       openModal()});
    
    
}) 
modal.addEventListener("click", (e) => closeModal(e, true));
closeBtn.addEventListener("click", closeModal);
 
function openModal2() {
    modal2.classList.remove("hide");
    console.log(userId)
}
 
function closeModal2(e, clickedOutside) {
    if (clickedOutside) {
        if (e.target.classList.contains("delete-modal-overlay"))
            modal2.classList.add("hide");
    } else modal2.classList.add("hide");
}

Array.from(openBtn2).forEach(el=>{
    el.addEventListener("click", ()=>{
        userId=el.id;
       openModal2()});


}) 
console.log("userId:",userId)
modal2.addEventListener("click", (e) => closeModal2(e, true));
closeBtn2.addEventListener("click", closeModal2);



function openModal3() {
    modal3.classList.remove("hide");
}
 
function closeModal3(e, clickedOutside) {
    if (clickedOutside) {
        if (e.target.classList.contains("add-modal-overlay"))
            modal3.classList.add("hide");
    } else modal3.classList.add("hide");
}
openBtn3.addEventListener("click", openModal3);
modal3.addEventListener("click", (e) => closeModal3(e, true));
closeBtn3.addEventListener("click", closeModal3);
const editUserForm=document.querySelector('#editUser');
const deleteUserForm=document.querySelector('#deleteUser')

if(editUserForm){
   
   
    editUserForm.addEventListener('submit', (event) => {
    const formData = new FormData(editUserForm);
    event.preventDefault();
    const role = formData.get('role');
    const limitBorxhit = formData.get('limit_borxhi');
   const state=document.querySelector('.state');
    const data = {  };
    if(role){
        data.role=role;
    }
    if(limitBorxhit){
        data.limiti_borxhit=limitBorxhit;
    }
    const jsonData = JSON.stringify(data); 

    $.ajax('/users/' + userId, {
        type: 'PATCH', 
        data: jsonData, 
        contentType: 'application/json', 
        success: function (data, status, xhr) {
            window.location.reload();
            console.log(data);
        },
        error: function (jqXhr, textStatus, errorMessage) {
            state.innerText='something has gone wrong '+errorMessage;
            console.log(errorMessage);
        }
    });
});
}
if(deleteUserForm){
deleteUserForm.addEventListener('submit',()=>{
    const state=document.querySelector('.state');
    $.ajax('/users/' + userId, {
        type: 'DELETE',
        
        contentType: 'application/json',
        success: function (data, status, xhr) {
            window.location.reload();
            
            console.log(data);
        },
        error: function (jqXhr, textStatus, errorMessage) {
            state.innerText='something has gone wrong '+errorMessage;
            console.log(errorMessage);
        }
    });
});
}
</script>
</body>
</html>
