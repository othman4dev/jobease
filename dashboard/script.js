// admin task
const addTask = document.getElementById('add_admin_task');
const modal = document.querySelector('.modal');
addTask.addEventListener('click', () => {
  modal.style.display = 'flex'
  addAdminTask();
})
function addAdminTask() {
  const form = document.getElementById("forms");
  const save = document.querySelector('.save')
  const annuler = document.querySelector('.annuler')
  console.log(form)
  form.addEventListener("submit", function (event) {
    event.preventDefault();
    const taskDesc = document.querySelector('.task-desc').value;
    const status = document.getElementById('status').value;
    const Admin_task = document.querySelector('.Admin_task');
    if (taskDesc == "") {
        console.log('error')
    } else {
        Admin_task.innerHTML += `<div
        class="list-group-item px-3 text d-flex justify-content-between align-items-center p-4">
        <p>${taskDesc}</p>
        <img src="${status}" alt="icon">
    </div>`
    modal.style.display = 'none'
    Swal.fire({
        title: "Task is save",
        icon: "success"
      });
    }
  })
  annuler.addEventListener('click', () => {
    modal.style.display = 'none'
  })
}