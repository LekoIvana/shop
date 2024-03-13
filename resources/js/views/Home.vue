<script setup>
import Navigation from "../components/Navigation.vue";
import Footer from "../components/Footer.vue";

</script>



<template>
    <Navigation />
    <div>
        <div class="container" style="margin-top: 35px;left: 50%;right: 50%; ">
  

  <div class="row justify-content-center align-items-center">
    <!-- card1 -->
     <div class="card card-circle">
        <div class="card-icon">
         <i class="bi bi-cart4"></i>
        </div>
        <div class="card-body">
           <h5 class="card-title">Žene</h5>
           <p class="card-text">Otkrijte modu za žene.</p>
           <router-link class="btn btn-primary" style="color:#ffffff;" to="/womens">Više </router-link>
        </div>
     </div>
     <!-- card2 -->
     <div class="card card-circle">
        <div class="card-icon">
           <i class="bi bi-cart4"></i>
        </div>
        <div class="card-body">
           <h5 class="card-title">Djeca</h5>
           <p class="card-text">Otkrijte modu za djecu.</p>
           <router-link class="btn btn-primary" style="color:#ffffff;" to="/kids">Više </router-link>
        </div>
     </div>
     <!-- card3 -->
     <div class="card card-circle ">
        <div class="card-icon">
           <i class="bi bi-cart4"></i>
        </div>
        <div class="card-body">
           <h5 class="card-title">Muškarci</h5>
           <p class="card-text">Otkrijte modu za muškarce.</p>
           <router-link class="btn btn-primary" style="color:#ffffff;" to="/mens">Više </router-link>
        </div>
     </div>
  </div>
  
</div>
    </div>
    
    <Footer />
</template>


<style  scoped>

.container{
    margin-bottom: 150px;
}
/* ----------------*/

.card-circle{
    text-align:center;
     margin-top:50px;
     background: #E4D9D9 ;
     border:10px solid transparent;
     color:#fff;
     Font-family: Montserrat;
     padding:50px;
     border-radius:50%;
}
 .card-circle .card-title{
    font-weight:600;
     font-size:26px;
}
 .card-circle .card-text{
    font-weight:400;
}
 .card-circle .card-icon i{
     font-size:60px;
     display:block;
}
 .card-circle:nth-child(2){
    background-image: url('https://static.kidscasting.com/articles/default/0001/05/3de428e1628e31085c295b4e4feeb8dbde026054.jpg')
}
.card-circle:nth-child(1){
    background-image: url('https://i0.wp.com/joannarahier.com/wp-content/uploads/2022/09/winter-outfit.jpeg?resize=683%2C1024&ssl=1')
}
.card-circle:nth-child(3){
    background-image: url('https://i.pinimg.com/550x/43/49/ec/4349ec5ac09c9ad747acc9b78b1b4c45.jpg')
}
 .card-circle .btn{
    Font-family: Montserrat;
    background:transparent;
     border:1px solid #fff;
     text-transform:uppercase;
     padding:5px 30px;    
     border-radius:0px;
     Font-weight:600;
}
.card-circle .btn,.card-circle .card-icon i,.card-circle{
   transition: all ease-in-out 0.2s;
}
 .card-circle:hover .btn{
    background:#E4D9D9;
     color:#fff;
   border: 1px solid transparent;
}
 .card-circle .btn:hover{
    transform: scale(1.1);
}
 .card-circle:hover{
    border:10px solid #E4D9D9;
}
 .card-circle:hover i {
   text-shadow: 0px -1px 10px #E4D9D9;
    transform:scale(1.2)rotate(20deg);
}
 @media only screen and (min-width: 1200px) {
     .card-circle:nth-child(3){
         margin-left:-40px;
         z-index:0;
    }
     .card-circle{
         width:400px;
         height:400px;
    }
     .card-circle:nth-child(2){
         margin-left:-20px;
         box-shadow: 1px 2px 20px 8px rgba(241, 235, 235, 0.12);
         transform: scale(1.2);
         z-index:1;
    }
   .card-circle .card-icon i{
      margin-top: 20px;
     }
}
@media only screen and (min-width: 991px) and (max-width: 1200px) {
   .card-circle{
         width:340px;
         height:340px;
    }
  .card-circle .card-icon i{
     font-size:50px;
   }
  .card-circle .card-icon i{
      margin-top: -25px;
     }
   .card-circle:nth-child(3){
         margin-left:-50px;
         z-index:0;
    }
   .card-circle:nth-child(2){
         margin-left:-20px;
         z-index:1;
    }
}



</style>
