// login.js

function login() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Проверяем, не пустые ли поля логина и пароля
    if (email.trim() === "" || password.trim() === "") {
        document.getElementById("loginStatus").innerHTML = "Пожалуйста, заполните все поля!";
        return;
    }

    // Здесь можно добавить другие проверки логина и пароля

    // Пример: Проверяем, совпадают ли введенные логин и пароль с ожидаемыми значениями
    if (email === "example@example.com" && password === "password123") {
        window.location.href = "index.html"; // Перенаправляем на страницу с аккаунтом
    } else {
        document.getElementById("loginStatus").innerHTML = "Неверный логин или пароль!";
    }
}
