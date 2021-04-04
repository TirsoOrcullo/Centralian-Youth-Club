function addNew() {
    const addMember = document.querySelector(".add-member");
    const addnewModal = document.querySelector(".addNew-modal");
    const closeAddnew = document.querySelector(".close-addnew");

    addMember.addEventListener("click", function() {
        addnewModal.classList.add("active");
    });

    closeAddnew.addEventListener("click", function() {
        addnewModal.classList.remove("active");
    });
}

function relateUs() {
    const relateDropdown = document.querySelector(".relate-dropdown");
    const relateBut = document.querySelector(".relatebut");

        relateBut.addEventListener("click", function(){
            relateDropdown.classList.toggle("active-dropdown");
        });
}

addNew();
relateUs();


