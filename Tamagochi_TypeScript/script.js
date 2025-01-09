var _a, _b, _c, _d;
console.log("Le script est chargé !");
// Récupération des éléments HTML avec des types explicites
//la fonction document.getElementById est utilisée pour
//récupérer un élément HTML dans le DOM en utilisant son id
//Elle retourne un objet de type HTMLElement | null 
//ce qui signifie qu'elle renvoie une élément HTML si l'élément
//existe dans le DOM ou null si l'élélement n'existe pas dans le DOM
//HTMLElement est un type générique en TS. Il représente un
//élément HTML de base
var hungerBar = document.getElementById("hunger");
var thirstBar = document.getElementById("thirst");
var happinessBar = document.getElementById("happiness");
var energyBar = document.getElementById("energy");
var messageBox = document.getElementById("message");
var animal = document.getElementById("animal");
// Variable de contrôle pour le sommeil de l'animal
//ici ajout du type boolean
var isSleeping = false;
// Fonction pour mettre à jour les statistiques
//ici ajout de void pour indiquer le type de sortie
function updateStats() {
    if (!isSleeping) {
        hungerBar.value = Math.max(0, hungerBar.value - 5);
        thirstBar.value = Math.max(0, thirstBar.value - 5);
        happinessBar.value = Math.max(0, happinessBar.value - 5);
        energyBar.value = Math.max(0, energyBar.value - 5);
        checkStatus();
    }
}
// Vérifie les conditions critiques
//ici ajout de void pour indiquer le type de sortie
function checkStatus() {
    //si une des 3 barres est à 20 ou moins, 
    //afficher un message d'alerte dans messageBox 
    if (hungerBar.value <= 20)
        messageBox.textContent = "L'animal a faim !";
    if (thirstBar.value <= 20)
        messageBox.textContent = "L'animal a soif";
    if (happinessBar.value <= 20)
        messageBox.textContent = "L'animal est triste !";
    if (energyBar.value <= 20)
        messageBox.textContent = "L'animal est fatigué !";
    if (hungerBar.value > 20 && happinessBar.value > 20 && energyBar.value > 20 && thirstBar.value > 20) {
        messageBox.textContent = "L'animal va bien !";
    }
}
// Actions des boutons
//FEED
//si l'animal ne dort pas, 
//augmente la barre de faim de 30, max 100
//diminue l'énergie de 10
//lance une animation visuelle jump-animation 
//qui s'arrête après 300ms grâce à setTimeout
//utilisation de l'opérateur ? est optionnelle
//pour gérer les cas où l'élément n'est pas trouvé
(_a = document.getElementById("feed")) === null || _a === void 0 ? void 0 : _a.addEventListener("click", function () {
    if (!isSleeping) {
        //augmente la faim, max 100
        hungerBar.value = Math.min(100, hungerBar.value + 30);
        //diminue l'éneergie de 10, minimum 0
        energyBar.value = Math.max(0, energyBar.value - 10);
        //ajouter une classe pour l'animation
        animal.classList.add("jump-animation");
        //supprimer l'animation après 300ms
        setTimeout(function () { return animal.classList.remove("jump-animation"); }, 300);
    }
    else {
        messageBox.textContent = "L'animal dort, impossible de nourrir !";
    }
});
(_b = document.getElementById("drink")) === null || _b === void 0 ? void 0 : _b.addEventListener("click", function () {
    if (!isSleeping) {
        hungerBar.value = Math.min(100, hungerBar.value + 30);
        thirstBar.value = Math.min(100, thirstBar.value + 30);
        animal.classList.add("drink-animation");
        setTimeout(function () { return animal.classList.remove("drink-animation"); }, 300);
    }
    else {
        messageBox.textContent = "L'animal dort, impossible de boire !";
    }
});
(_c = document.getElementById("play")) === null || _c === void 0 ? void 0 : _c.addEventListener("click", function () {
    if (!isSleeping && energyBar.value >= 20) {
        happinessBar.value = Math.min(100, happinessBar.value + 30);
        energyBar.value = Math.max(0, energyBar.value - 20);
        hungerBar.value = Math.max(0, hungerBar.value - 20);
        thirstBar.value = Math.max(0, thirstBar.value - 20);
        animal.classList.add("shake-animation");
        setTimeout(function () { return animal.classList.remove("shake-animation"); }, 500);
    }
    else {
        messageBox.textContent = "L'animal dort ou est trop fatigué pour jouer !";
    }
});
(_d = document.getElementById("sleep")) === null || _d === void 0 ? void 0 : _d.addEventListener("click", function () {
    if (!isSleeping) {
        isSleeping = true;
        messageBox.textContent = "L'animal dort... Z Z Z";
        animal.classList.add("sleep-animation");
        setTimeout(function () {
            isSleeping = false;
            energyBar.value = Math.min(100, energyBar.value + 50);
            animal.classList.remove("sleep-animation");
            messageBox.textContent = "L'animal est reposé !";
        }, 5000);
    }
});
// Mettre à jour les statistiques toutes les 5 secondes
setInterval(updateStats, 5000);