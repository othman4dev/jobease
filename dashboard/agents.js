const modal = document.querySelector('.modal');
const edit = document.querySelectorAll('.edit');
for (let j = 0; j < edit.length; j++) {
    edit[j].addEventListener('click', () => {
        modal.style.display = 'flex'
        editFreelacerData(j);
    })
}
function editFreelacerData(j) {

    const form = document.getElementById("forms");
    const save = document.querySelector('.save')
    const annuler = document.querySelector('.annuler')
    const error = document.querySelector('.error')
    // 
    const errorMessages = document.querySelectorAll('input');
    errorMessages.forEach((element) => {
        element.classList.remove('error');
    });
    // 
    form.addEventListener("submit", function (event) {
        event.preventDefault();
        const email = document.querySelector('.email').value;
        const first_name = document.querySelector('.first_name').value;
        const last_name = document.querySelector('.last_name').value;
        const title_user = document.querySelector('.title_user').value;
        const status = document.querySelector('.status').value;
        const position = document.querySelector('.position').value;
        
        if (first_name.trim() === "" || email.trim() === "" || last_name.trim() === "" || title_user.trim() === "" || status.trim() === "" || position.trim() === "" || !validateEmail(email)) {
            error.textContent = 'Please fill in all fields correctly'
        } else {
            console.log('5')
            error.textContent = ''
            saveEdit(j);

            function saveEdit(i) {
                const f_email = document.querySelectorAll('.f_email')[i];
                const f_name = document.querySelectorAll('.f_name')[i];
                const f_title = document.querySelectorAll('.f_title')[i];
                const f_status = document.querySelectorAll('.f_status')[i];
                const f_position = document.querySelectorAll('.f_position')[i];
                f_name.textContent = first_name + last_name;
                f_email.textContent = email;
                f_position.textContent = position;
                f_status.textContent = status;
                f_title.textContent = title_user;
            }
            Swal.fire(
                'Changes have been saved'
            )
            modal.style.display = 'none'
            first_name = "";
            last_name = "";
            email = "";
            position = "";
            status = "";
            title_user = "";
            
            //     
        }
    });
    annuler.addEventListener('click', () => {
        modal.style.display = 'none'
    })

    function validateEmail(email) {
        const emailRegex = /^[A-Z]+$/i;
        return emailRegex.test(email);

    }

};
// edit end