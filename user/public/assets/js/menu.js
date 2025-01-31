document.addEventListener("DOMContentLoaded", function () {
    const originalCarousel = document.getElementById("originalCarousel");
    const filteredCarousel = document.getElementById("filteredCarousel");
    const filteredCarouselContent = document.getElementById("filteredCarouselContent");
    const utensilsIcon = document.getElementById("utensils-icon");
    const drinksIcon = document.getElementById("drinks-icon");
    const originalCards = document.querySelectorAll("#originalCarousel .col-3");
    const arcanimate = document.getElementById("arcanimate");
    const carouselCards = document.querySelectorAll(".card");
    
    const filters = {
        utensils: ["Appetizers", "Breakfast", "Lunch", "Dessert"],
        drinks: ["Hot Drinks", "Cold Drinks"]
    };

    let originalCarouselInstance = new bootstrap.Carousel(originalCarousel, { interval: false, wrap: false });
    let filteredCarouselInstance;

    function resetIcons() {
        utensilsIcon.classList.remove("icon-active");
        drinksIcon.classList.remove("icon-active");
    }

    function createCarouselItems(filteredCards) {
        filteredCarouselContent.innerHTML = "";

        if (filteredCards.length === 0) {
            filteredCarouselContent.innerHTML = "<div class='carousel-item active'><p class='text-center'>No items found.</p></div>";
            return;
        }

        const chunkSize = 4;
        let activeClassAdded = false;

        for (let i = 0; i < filteredCards.length; i += chunkSize) {
            const chunk = filteredCards.slice(i, i + chunkSize);
            const carouselItem = document.createElement("div");
            carouselItem.classList.add("carousel-item");
            if (!activeClassAdded) {
                carouselItem.classList.add("active");
                activeClassAdded = true;
            }

            const row = document.createElement("div");
            row.classList.add("row", "w-100", "justify-content-center");
            chunk.forEach(card => {
                row.appendChild(card.cloneNode(true));
            });

            carouselItem.appendChild(row);
            filteredCarouselContent.appendChild(carouselItem);
        }

        initializeFilteredCarousel();
    }

    function filterCards(filter) {
        const filteredCards = Array.from(originalCards).filter(card => {
            return filter.includes(card.getAttribute("data-prodtype"));
        });

        filteredCarousel.classList.add("active");
        originalCarousel.classList.remove("active");

        createCarouselItems(filteredCards);
    }

    function initializeFilteredCarousel() {
        if (filteredCarouselInstance) {
            filteredCarouselInstance.dispose();
        }
        filteredCarouselInstance = new bootstrap.Carousel(filteredCarousel, { interval: false, wrap: true });
    }

    function getBackgroundColorForRate(rate) {
        if (rate >= 4.7) return "rgb(194, 173, 152)";
        if (rate >= 4.5) return "rgb(165, 122, 79)";
        return "rgba(120,88,57,1)";
    }

    function updateProdDetails(card) {
        const prodType = card.getAttribute("data-prodtype");
        const prodName = card.getAttribute("data-prodname");
        const prodDesc = card.getAttribute("data-proddesc");
        const prodPrice = card.getAttribute("data-prodprice");
        const prodImage = card.getAttribute("data-prodimage");
        const chefName = card.getAttribute("data-chefname");
        const prodRate = parseFloat(card.getAttribute("data-prodrate"));
        const proddetails = document.querySelector(".proddetails");

        proddetails.innerHTML = `
            <div style="display: flex">
                <img src="/restaurant/user/public/assets/images/menu/${prodType}/${prodImage}" alt="" style="width: 400px; height: 400px;">
                <div class="product-detail-content" style="text-align: center; margin-left: 40%">
                    <div id="rateBox" style="font-size: 20px; font-weight: bold; color: black; width: 60px; margin-left: 45%; border-radius: 20px; height: 90px;">
                        <p>${prodRate}</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p>Chef ${chefName}</p>
                    <p>${prodDesc}</p>
                    <i class="fa-solid fa-dollar-sign icons"></i>
                    <p>${prodPrice}</p>
                </div>
            </div>
        `;
        
        document.getElementById("rateBox").style.backgroundColor = getBackgroundColorForRate(prodRate);
    }

    filteredCarouselContent.addEventListener("click", (e) => {
        const card = e.target.closest(".col-3");
        if (card) updateProdDetails(card);
    });

    originalCards.forEach(card => {
        card.addEventListener("click", () => updateProdDetails(card));
    });

    utensilsIcon.addEventListener("click", () => {
        resetIcons();
        utensilsIcon.classList.add("icon-active");
        filterCards(filters.utensils);
    });

    drinksIcon.addEventListener("click", () => {
        resetIcons();
        drinksIcon.classList.add("icon-active");
        filterCards(filters.drinks);
    });

    carouselCards.forEach(card => {
        card.addEventListener("click", () => {
            arcanimate.classList.add("active");
            setTimeout(() => arcanimate.classList.remove("active"), 500);
            card.classList.add("animate-in");
            setTimeout(() => {
                card.classList.remove("animate-in");
                card.classList.add("visible");
            }, 500);
        });
    });
});
