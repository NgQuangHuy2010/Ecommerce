
document.getElementById('openModalBtn').addEventListener('click', function () {
    var modal = document.getElementById('myModal');
    modal.style.display = "block";
});

// Đóng modal khi nhấn vào nút close
var closeBtn = document.getElementsByClassName("close")[0];
closeBtn.onclick = function () {
    var modal = document.getElementById('myModal');
    modal.style.display = "none";
}

// Đóng modal khi click bên ngoài modal
window.onclick = function (event) {
    var modal = document.getElementById('myModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}