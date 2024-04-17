(function($) {
    "use strict";
    var fullHeight = function() {
        $('.js-fullheight').css('height', $(window).height());
        $(window).resize(function() {
            $('.js-fullheight').css('height', $(window).height());
        });
    };
    fullHeight();
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
    });
})(jQuery);


//Fonction zoom image
$('.zoomable-image').click(function() {
    var imageURL = $(this).attr('src');
    var modal = $('<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">\
	<div class="modal-dialog modal-dialog-centered" role="document">\
	  <div class="modal-content">\
		<div class="modal-body">\
		<img src="' + imageURL + '" class="img-fluid" alt="">\
		</div>\
	  </div>\
	</div>\
  </div>');
    $('body').append(modal);
    modal.modal('show');
    modal.on('hidden.bs.modal', function(e) {
        modal.remove();
    });
});

//Validation de form de contact
// function validerContact() {
//     var emailPattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//     if ($("#input-nom").val().trim() == "") {
//         $("#error-nom").html("Veuillez entrer un nom!");
//         $("#input-nom").addClass("is-invalid");
//     }else{
//         $("#error-nom").html("");
//         $("#input-nom").removeClass("is-invalid");
//     }

//     if ($("#input-prenom").val().trim() == "") {
//         $("#error-prenom").html("Veuillez entrer un prénom!");
//         $("#input-prenom").addClass("is-invalid");
//     }else{
//         $("#error-prenom").html("");
//         $("#input-prenom").removeClass("is-invalid");
//     }

//     if($("#input-email").val().trim() == ""){
//         $("#error-email").html("Veuillez entrer un email!");
//         $("#input-email").addClass("is-invalid");
//     }else if (!emailPattern.test($("#input-email").val().trim())){
//         $("#error-email").html("Veuillez entrer un email valide!");
//         $("#input-email").addClass("is-invalid");
//     }else{
//         $("#error-email").html("");
//         $("#input-email").removeClass("is-invalid");
//     }

//     if ($("#input-sujet").val().trim() == "") {
//         $("#error-sujet").html("Veuillez entrer un sujet!");
//         $("#input-sujet").addClass("is-invalid");
//     }else{
//         $("#error-sujet").html("");
//         $("#input-sujet").removeClass("is-invalid");
//     }

//     if ($("#input-message").val().trim() == "") {
//         $("#error-message").html("Veuillez entrer un message!");
//         $("#input-message").addClass("is-invalid");
//     }else{
//         $("#error-message").html("");
//         $("#input-message").removeClass("is-invalid");
//     }

//     if ($("#input-date-naissance").val().trim() == "") {
//         $("#error-date-naissance").html("Veuillez entrer une date!");
//         $("#input-date-naissance").addClass("is-invalid");
//     }else{
//         $("#error-date-naissance").html("");
//         $("#input-date-naissance").removeClass("is-invalid");
//     }

//     if ($("#select-metier").val().trim() == "Sélectionner") {
//         $("#error-metier").html("Veuillez choisir un métier!");
//         $("#select-metier").addClass("is-invalid");
//     }else{
//         $("#error-metier").html("");
//         $("#select-metier").removeClass("is-invalid");
//     }
// }
function validerLogin() {
    var emailPattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if($("#input-login-email").val().trim() == ""){
        $("#error-login-email").html("Veuillez entrer un email!");
        $("#input-login-email").addClass("is-invalid");
    }else if (!emailPattern.test($("#input-login-email").val().trim())){
        $("#error-login-email").html("Veuillez entrer un email valide!");
        $("#input-login-email").addClass("is-invalid");
    }else{
        $("#error-login-email").html("");
        $("#input-login-email").removeClass("is-invalid");
    }

    if($("#input-login-password").val().trim() == ""){
        $("#error-login-password").html("Veuillez entrer un mot de passe!");
        $("#input-login-password").addClass("is-invalid");
    }else{
        $("#error-login-password").html("");
        $("#input-login-password").removeClass("is-invalid");
    }
}

//Cacher Stock
$("#btn-cacher-stock").click(function() {
    if ($(this).text() === "Cacher stock") {
        $(".table-stock").attr("hidden", true);
        $(this).text("Afficher stock");
    } else {
        $(".table-stock").removeAttr("hidden");
        $(this).text("Cacher stock");
    }
});

//Le Stock choisi est le maximum - Button minus et plus desactivation
$(document).ready(function () {
    $('.quantity').on('input', function () {
        var maxStock = parseInt($(this).closest('tr').find('.table-stock').text());
        var currentValue = parseInt($(this).val());
        if (isNaN(currentValue) || currentValue < 0) {
            $(this).val(0);
        } else if (currentValue > maxStock) {
            $(this).val(maxStock);
        }
        updateButtonState($(this));
    });

    $('.btn-plus, .btn-minus').on('click', function () {
        var input = $(this).closest('.input-group-wrapper').find('.quantity');
        var maxStock = parseInt(input.closest('tr').find('.table-stock').text());
        var currentValue = parseInt(input.val());
        if ($(this).hasClass('btn-plus') && currentValue < maxStock) {
            input.val(isNaN(currentValue) ? 1 : currentValue + 1);
        } else if ($(this).hasClass('btn-minus') && currentValue > 0) {
            input.val(isNaN(currentValue) ? 0 : currentValue - 1);
        }
        input.trigger('input');
    });

    // Function to update button state
    function updateButtonState(input) {
        var currentValue = parseInt(input.val());
        var minusButton = input.closest('.input-group-wrapper').find('.btn-minus');
        var plusButton = input.closest('.input-group-wrapper').find('.btn-plus');
        var ajouterPanier = input.closest('.input-group-wrapper').find('.btn-add-to-cart');
        var maxStock = parseInt(input.closest('tr').find('.table-stock').text());

        if (currentValue <= 0) {
            minusButton.prop('disabled', true); 
            ajouterPanier.prop('disabled', true); 
        } else {
            minusButton.prop('disabled', false);
            ajouterPanier.prop('disabled', false); 
        }

        if (currentValue >= maxStock) {
            plusButton.prop('disabled', true);
        } else {
            plusButton.prop('disabled', false);
        }
    }
});

//Edit profile image
$(document).ready(function() {
    $('#edit-image').click(function() {
        $('#edit-image-input').trigger('click');
    });

    $('#edit-image-input').change(function() {
        $('#edit-image-form').submit();
    });
});

 //Recherche dans tableau
 $(document).ready(function () {
    $('#searchInput').on('input', function () {
        var searchText = $(this).val().toLowerCase();
        $('#productTable tbody tr').each(function () {
            var rowText = $(this).text().toLowerCase();
            if (rowText.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});

//Tableau de produits pagination
 var currentPage = 1;
 var rowsPerPage = 4;
 function showRows(pageNumber) {
     var rows = document.getElementById("productTable").getElementsByTagName("tbody")[0].rows;
     var startIndex = (pageNumber - 1) * rowsPerPage;
     var endIndex = Math.min(startIndex + rowsPerPage, rows.length);
     for (var i = 0; i < rows.length; i++) {
         rows[i].style.display = "none";
     }
     for (var j = startIndex; j < endIndex; j++) {
         rows[j].style.display = "";
     }
 }
 function setupPagination() {
     var totalRows = document.getElementById("productTable").getElementsByTagName("tbody")[0].rows.length;
     var totalPages = Math.ceil(totalRows / rowsPerPage);
     var pagination = document.getElementById("pagination").getElementsByTagName("ul")[0];
     pagination.innerHTML = "";
     var prevButton = document.createElement("li");
     prevButton.className = "page-item";
     if (currentPage === 1) {
         prevButton.classList.add("disabled");
     }
     prevButton.innerHTML = '<a class="page-link" href="#" tabindex="-1" aria-disabled="true" onclick="prevPage()">Précédent</a>';
     pagination.appendChild(prevButton);
     for (var i = 1; i <= totalPages; i++) {
         var pageButton = document.createElement("li");
         pageButton.className = "page-item";
         if (i === currentPage) {
             pageButton.classList.add("active");
         }
         pageButton.innerHTML = '<a class="page-link" href="#" onclick="changePage(' + i + ')">' + i + '</a>';
         pagination.appendChild(pageButton);
     }
     var nextButton = document.createElement("li");
     nextButton.className = "page-item";
     if (currentPage === totalPages) {
         nextButton.classList.add("disabled");
     }
     nextButton.innerHTML = '<a class="page-link" href="#" onclick="nextPage()">Suivant</a>';
     pagination.appendChild(nextButton);
 }
 function prevPage() {
     if (currentPage > 1) {
         currentPage--;
         showRows(currentPage);
         setupPagination();
     }
 }
 function nextPage() {
     var totalRows = document.getElementById("productTable").getElementsByTagName("tbody")[0].rows.length;
     var totalPages = Math.ceil(totalRows / rowsPerPage);
     if (currentPage < totalPages) {
         currentPage++;
         showRows(currentPage);
         setupPagination();
     }
 }
 function changePage(pageNumber) {
     currentPage = pageNumber;
     showRows(currentPage);
     setupPagination();
 }
 showRows(currentPage);
 setupPagination();

