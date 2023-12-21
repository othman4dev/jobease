const Message = document.querySelector('#Message');
let massegeInput = document.querySelector('.massege_input');
const sendMessage = document.querySelector('.send-message');
sendMessage.addEventListener('click',()=>{
    Message.innerHTML += `
    <div class="w-50 bg-white p-2 mb-3 me-4 rounded d-flex justify-content-between align-self-end">
                            <p>${massegeInput.value}</p>
                            <img src="img/check-all.svg" alt="icon">
                        </div>
    `
    massegeInput.value = ''
});