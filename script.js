// script.js
$(document).ready(function(){
    $.ajax({
        url: "data.php",
        type: "GET",
        success: function(response){
            var data = JSON.parse(response);
            var packagesContainer = $("#packages-container");

            // Проходимся по каждому элементу в массиве данных
            data.forEach(function(item) {
                // Создаем элемент карточки тура
                var card = $("<div class='col-lg-4 col-md-6 mb-4'>" +
                                "<div class='package-item bg-white mb-2'>" +
                                    "<img class='img-fluid' src='" + item.photo + "' alt=''>" +
                                    "<div class='p-4'>" +
                                        "<div class='d-flex justify-content-between mb-3'>" +
                                            "<small class='m-0'><i class='fa fa-map-marker-alt text-primary mr-2'></i>" + item.city + ", " + item.country + "</small>" +
                                            "<small class='m-0'><i class='fa fa-calendar-alt text-primary mr-2'></i>" + item.departure_date + " - " + item.arrival_date + "</small>" +
                                            "<small class='m-0'><i class='fa fa-utensils text-primary mr-2'></i>" + item.food + "</small>" +
                                        "</div>" +
                                        "<a class='h5 text-decoration-none' href=''>" + item.hotel + "</a>" +
                                        "<div class='border-top mt-4 pt-4'>" +
                                            "<div class='d-flex justify-content-between'>" +
                                                "<h5 class='m-0'>$" + item.cost + "</h5>" +
                                            "</div>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>" +
                            "</div>");

                // Добавляем карточку тура в контейнер
                packagesContainer.append(card);
            });
        }
    });
});

