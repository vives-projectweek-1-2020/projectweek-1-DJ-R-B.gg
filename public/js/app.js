function showPopupLogin() {
    document.getElementById('logincontainer').style.display = 'block'
}
function cancelLogin() {
    document.getElementById('logincontainer').style.display = 'none'
}

function showPopupRegister() {
    document.getElementById('registercontainer').style.display = 'block'
}
function cancelRegister() {
    document.getElementById('registercontainer').style.display = 'none'
}

function change() {
    document.getElementsByTagName('body')[0].style.backgroundColor = 'rgb(56, 130, 119)'
    cancel()
}