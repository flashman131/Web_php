$(document).ready(function(){
    $("#logout").css("display","none"); //Kilépés gomb elrejtése
    $("#upload").css("display","none"); //Feltöltés gomb elrejtése
    
    //form alapértelmezett működésének megakadályozása
    $('#login-form').on('submit', function(e){
        //console.log("Kattintottál");
        e.preventDefault();
    });
    
    //login esemény megvalósítása ajax segítségével
    $("[name=enter]").click(function(){
       let email = $("#email").val();
       let pwd = $("#pwd").val();
       $.ajax({
           method: "POST",
           url: "php/log_in.php",
           data: {email : email,
                   pwd : pwd},
           
           success: function(valasz){
               console.log(valasz);
               $("#login").css("display","none");
               $("#upload").css("display","inline");
               $("#logout").css("display","inline");
               
           },
                   
           error: function(status){console.log(valasz);}
           
       });
   }); // login esemény vége
   
   //állas felöltése
   $("[name=feltolt]").click(function(){
       console.log("Feltöltök...");
       let katid = $('[name=katid]').val();
       let munkaado = $('[name=munkaado]').val();
       let munkakor = $('[name=munkakor]').val();
       let hely = $('[name=hely]').val();
       let leiras = $('[name=leiras]').val();
       let fizetes = $('[name=fizetes]').val();
       
       $.ajax({
           method: "POST",
           url: "php/fel_tolt.php",
           data: {
               katid: katid,
               munkakado: munkaado,
               munkakor: munkakor,
               hely: hely,
               leiras: leiras,
               fizetes: fizetes},
           success: function(valasz){
               console.log(valasz);
           },
       });
   }); //állás feltöltése VÉGE
   
}); //READY vége


