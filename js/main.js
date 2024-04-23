(function($) {
    "use strict";
    // Fonction pour ajuster la hauteur des éléments à la taille de la fenêtre
    var fullHeight = function() {
        $('.js-fullheight').css('height', $(window).height());
        $(window).resize(function() {
            $('.js-fullheight').css('height', $(window).height());
        });
    };
    fullHeight();
    // Gestion du clic sur l'icône de basculement du volet latéral
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
    });
})(jQuery);

// Fonction de zoom sur les images
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

$(document).ready(function() {
    // Gestion du clic sur le bouton de basculement du menu
    $('.toggle').on("click", function() {
        $('nav').toggleClass("close");
    });
});

// Gestion du déclenchement de l'importation d'un fichier CSV
$(document).ready(function() {
    // Déclenche le clic sur le bouton de sélection de fichier lorsqu'un bouton est cliqué
    $('#button-products-csv').click(function() {
        $('#input-products-csv').trigger('click');
    });

    // Soumet le formulaire lorsqu'un fichier est sélectionné
    $('#input-products-csv').change(function() {
        // Vérifie si un fichier est sélectionné
        if ($(this).val() !== '') {
            // Soumet le formulaire
            $('#input-products-csv-form').submit();
        }
    });
});

// Édition des images de produit
$(document).ready(function() {
    $('.edit-image').click(function() {
        $(this).siblings('.edit-image-input').trigger('click');
    });

    $('.edit-image-input').change(function() {
        $(this).closest('.edit-image-form').submit();
    });
});

// Édition de l'image de profil
$(document).ready(function() {
    $('#edit-image').click(function() {
        $('#edit-image-input').trigger('click');
    });

    $('#edit-image-input').change(function() {
        $('#edit-image-form').submit();
    });
});

// Afficher et masquer l'ajout de produit
$('#btn-ajouter-produit').click(function() {
    $('#tr-ajouter-produit').removeAttr('hidden');
});
$('#btn-hide-produit').click(function() {
    $('#tr-ajouter-produit').attr('hidden', true);
    $('#form-ajouter-produit').reset();
});

// Afficher et masquer l'ajout de catégorie
$('#btn-ajouter-categorie').click(function() {
    $('#tr-ajouter-categorie').removeAttr('hidden');
});
$('#btn-hide-categorie').click(function() {
    $('#tr-ajouter-categorie').attr('hidden', true);
    $('#form-ajouter-categorie').reset();
});

// Cacher ou afficher le stock
$("#btn-cacher-stock").click(function() {
    if ($(this).text() === "Cacher stock") {
        $(".table-stock").attr("hidden", true);
        $(this).text("Afficher stock");
    } else {
        $(".table-stock").removeAttr("hidden");
        $(this).text("Cacher stock");
    }
});

// Désactivation des boutons "-" et "+" si nécessaire en fonction du stock disponible
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

    // Fonction pour mettre à jour l'état des boutons
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

// Recherche dans un tableau
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

// Pagination d'un tableau de produits
function showRows(tableId, pageNumber, rowsPerPage) {
    var table = document.getElementById(tableId);
    var rows = table.getElementsByTagName("tbody")[0].rows;
    var startIndex = (pageNumber - 1) * rowsPerPage;
    var endIndex = Math.min(startIndex + rowsPerPage, rows.length);
    for (var i = 0; i < rows.length; i++) {
        rows[i].style.display = "none";
    }
    for (var j = startIndex; j < endIndex; j++) {
        rows[j].style.display = "";
    }
}

// Formater les entrées dans les champs de formulaire
$(document).ready(function() {
    $('.input-only-numbers').on('input', function() {
        $(this).val($(this).val().replace(/\D/g, ''));
    });
    $('.input-card-number').on('input', function() {
        $(this).val($(this).val().replace(/\D/g, ''));
        var cardNumber = $(this).val().replace(/-/g, '');
        var formattedCardNumber = '';
        for (var i = 0; i < cardNumber.length; i++) {
            if (i > 0 && i % 4 === 0) {
                formattedCardNumber += '-';
            }
            formattedCardNumber += cardNumber[i];
        }
        $(this).val(formattedCardNumber);
    });
    $('.input-only-text').on('input', function() {
        $(this).val($(this).val().replace(/[^a-zA-Z\s]/g, ''));
    });
});

// Sélection du mode de paiement
$(document).ready(function(){
    $('#btn-card').click(function(){
        $('#mode_paiement').attr('value', 'card');
    });
    $('#btn-paypal').click(function(){
        $('#mode_paiement').attr('value', 'paypal');
    });
});

// Configuration de la pagination d'un tableau
function setupPagination(tableId, paginationId, currentPage, rowsPerPage) {
    var table = document.getElementById(tableId);
    var totalRows = table.getElementsByTagName("tbody")[0].rows.length;
    var totalPages = Math.ceil(totalRows / rowsPerPage);
    var pagination = document.getElementById(paginationId).getElementsByTagName("ul")[0];
    pagination.innerHTML = "";
    var prevButton = document.createElement("li");
    prevButton.className = "page-item";
    if (currentPage === 1) {
        prevButton.classList.add("disabled");
    }
    prevButton.innerHTML = '<a class="page-link" href="#" tabindex="-1" aria-disabled="true" onclick="prevPage(\'' + tableId + '\', \'' + paginationId + '\', ' + rowsPerPage + ')">Précédent</a>';
    pagination.appendChild(prevButton);
    for (var i = 1; i <= totalPages; i++) {
        var pageButton = document.createElement("li");
        pageButton.className = "page-item";
        if (i === currentPage) {
            pageButton.classList.add("active");
        }
        pageButton.innerHTML = '<a class="page-link" href="#" onclick="changePage(\'' + tableId + '\', \'' + paginationId + '\', ' + i + ', ' + rowsPerPage + ')">' + i + '</a>';
        pagination.appendChild(pageButton);
    }
    var nextButton = document.createElement("li");
    nextButton.className = "page-item";
    if (currentPage === totalPages) {
        nextButton.classList.add("disabled");
    }
    nextButton.innerHTML = '<a class="page-link" href="#" onclick="nextPage(\'' + tableId + '\', \'' + paginationId + '\', ' + rowsPerPage + ')">Suivant</a>';
    pagination.appendChild(nextButton);
}

// Fonctions pour gérer la pagination précédente, suivante et la modification de page
function prevPage(tableId, paginationId, rowsPerPage) {
    var currentPage = parseInt(document.querySelector('#' + paginationId + ' .page-item.active .page-link').textContent);
    if (currentPage > 1) {
        currentPage--;
        showRows(tableId, currentPage, rowsPerPage);
        setupPagination(tableId, paginationId, currentPage, rowsPerPage);
    }
}

function nextPage(tableId, paginationId, rowsPerPage) {
    var table = document.getElementById(tableId);
    var currentPage = parseInt(document.querySelector('#' + paginationId + ' .page-item.active .page-link').textContent);
    var totalRows = table.getElementsByTagName("tbody")[0].rows.length;
    var totalPages = Math.ceil(totalRows / rowsPerPage);
    if (currentPage < totalPages) {
        currentPage++;
        showRows(tableId, currentPage, rowsPerPage);
        setupPagination(tableId, paginationId, currentPage, rowsPerPage);
    }
}

function changePage(tableId, paginationId, pageNumber, rowsPerPage) {
    showRows(tableId, pageNumber, rowsPerPage);
    setupPagination(tableId, paginationId, pageNumber, rowsPerPage);
}

changePage("productsTable", "pagination_productsTable", 1, 4);
changePage("commandeTable", "pagination_commandeTable", 1, 5);

// Initialisation des tooltips
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
});
