<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Over de App</ion-title>
        <ion-buttons slot="end">
          <ion-button @click="goHome" class="custom-button">HOME</ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>
    <ion-content>
      <ion-card class="about-card">
        <ion-card-header>
          <br> <br> <br> <br> <br> <br> <br> <br>
          <ion-card-title>Over de App</ion-card-title>
        </ion-card-header>
        <ion-card-content>
          Deze app beheert boeken, auteurs en genres en is gemaakt met Vue en Ionic. 
          Het biedt gebruikers de mogelijkheid om hun favoriete boeken te beheren en informatie over auteurs en genres te verkennen.
        </ion-card-content>
      </ion-card>
      <ion-card class="developer-card">
        <ion-img src="https://via.placeholder.com/400x200" alt="Nes"></ion-img>
        <ion-card-header>
          <br> <br> <br> <br>
          <ion-card-title>Ontwikkelaar</ion-card-title>
        </ion-card-header>
        <ion-card-content>
          Deze app is ontwikkeld door Néssim El Maghari, een enthousiaste ontwikkelaar met een passie voor Webtechnologieën en steeds meer is gaan houden van Ionic en Vue.
        </ion-card-content>
      </ion-card>
    </ion-content>
  </ion-page>
</template>

<script>
export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "About",
  methods: {
    goHome() {
      this.$router.push({ name: 'HP' }).then(() => {
        window.location.reload();
      });
    },
  },
};
</script>

<style scoped>
.about-card, .developer-card {
    margin: 16px; /* Add margin for spacing */
    --background: #f9f9f9; /* Light background color for cards */
    --border-radius: 10px; /* Rounded corners for cards */
}

ion-card-title {
    color: #FF4081; /* Flashy color for card titles */
    font-weight: bold; /* Bold titles for emphasis */
}

ion-card-content {
    font-size: 16px; /* Font size for card content */
    line-height: 1.5; /* Improved line height for readability */
}

.custom-button {
    --background: #FF4081; /* Flashy background color for the button */
    --color: white; /* Text color for the button */
    --border-radius: 8px; /* Rounded corners for the button */
    margin: 4px; /* Add margin for spacing */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Shadow effect for the button */
}
</style>
