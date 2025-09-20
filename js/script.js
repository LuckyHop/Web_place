document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll("a.link");

    links.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault(); // предотвратить стандартное поведение ссылки

            const targetUrl = this.href; // получить URL целевой страницы
            document.body.classList.add("hidden"); // добавить класс для скрытия страницы

            setTimeout(() => {
                window.location.href = targetUrl; // перейти на новую страницу
            }, 500); // время ожидания соответствует времени перехода в CSS
        });
    });
});